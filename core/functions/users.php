<?php

function mysqli_result($res, $ro, $fie=0) {
    $res->data_seek($ro);
    $row = $res->fetch_array();
    return $row[$fie];
}

function get_shipments_pdf($shipments) {
	global $connect, $t_shipments, $t_shipments_types, $t_users;

	$shipments = sanitize($shipments);
	$t_shipments = sanitize($t_shipments);
	$t_shipments_types = sanitize($t_shipments_types);
	$t_users = sanitize($t_users);

	$html = '';

	$sql = "SELECT
			  p.shipment_id
			, p.date_sent
			, p.recipient
			, p.recipient_address
			, p.body_sent_correspondence
			, rp.shipment_type_name
			, CONCAT(u1.first_name,' ',u1.last_name) AS registered_by
			, CONCAT(u2.first_name,' ',u2.last_name) AS updated_by
			FROM ".$t_shipments." AS p
			LEFT JOIN ".$t_shipments_types." AS rp ON p.shipment_type_id = rp.shipment_type_id
			INNER JOIN ".$t_users." AS u1 ON p.registered_by_id = u1.user_id
			INNER JOIN ".$t_users." AS u2 ON p.updated_by_id = u2.user_id
			WHERE p.deleted = 0 ";

	$received = " AND p.received = 1";
	$sent = " AND p.sent = 1";

	if ($shipments == 'received')
	{
		$sql .= $received;
	}
	else if ($shipments == 'sent')
	{
		$sql .= $sent;
	}

	$result = mysqli_query($connect, $sql);

	$count = mysqli_num_rows($result);

	$lp = 1;

	if ($count > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$html .= '
				<tr>
					<td>'.$lp++.'.</td>
					<td>'.$row["date_sent"].'</td>
					<td>'.$row["recipient"].'</td>
					<td>'.$row["recipient_address"].'</td>
					<td>'.$row["body_sent_correspondence"].'</td>
					<td>'.$row["shipment_type_name"].'</td>
					<td>'.$row["registered_by"].'</td>
					<td>'.$row["updated_by"].'</td>
				</tr>
			';
		}
	}
	else
	{
			$html .='
				<tr>
					<td colspan="100%" align="center">No results...</td>
				</tr>
			';
	}

	if (!$result)
	{
		return false;
	}
	else
	{
		return $html;
	}
}

/*
function count_shipments($shipments) {
	global $connect;

	$shipments = sanitize($shipments);

	$sql="SELECT COUNT(`shipment_id`) FROM `shipments` WHERE `deleted` = 0 ";

	$received = " AND received = 1";
	$sent = " AND sent = 1";

	if ($shipments == 'received')
	{
		$sql .= $received;
	}
	else if ($shipments == 'sent')
	{
		$sql .= $sent;
	}

	$result = $connect->query($sql);

	if(false === $result){
		return false;
		echo mysqli_error($connect);
	}
	if ($row = mysqli_fetch_row($result)) {
		return $row[0];
	}
}
*/

function csv_from_mysql($source) {
	global $connect;

	$date = date('Y.m.d_H:i:s');
	$output = "";
	$headers = false;

	while($row = mysqli_fetch_assoc($source))
	{
		if(!$headers)
		{
			$output .= join(',', array('Id', 'Sent date', 'Recipient', 'Recipient address', 'Corespondence body', 'Shipments type', 'Registered by', 'Updated by'))."\n";
			$headers = true;
		}

		foreach ($row as &$value) {
			$value = str_replace("\r\n", "", $value);
			$value = "\"" . $value . "\"";
		}

		$output .= join(',', $row)."\n";

	}

	// set the headers
	$size_in_bytes = strlen($output);
	header("Content-type: application/vnd.ms-excel; charset=utf-8'");
	header("Content-disposition:  attachment; filename=".$date.".csv; size=$size_in_bytes");

	// send output
	print $output;
	exit();
}

function find_user($condition) {
	global $connect, $t_users;

	$condition = sanitize($condition);
	$t_users = sanitize($t_users);

	$sql = "SELECT * FROM ".$t_users." WHERE active=1 AND (login LIKE '%$condition%' OR first_name LIKE '%$condition%' OR last_name LIKE '%$condition%') LIMIT 25";

	$result = mysqli_query($connect, $sql);

	$users = array();

	while ($row = $result->fetch_assoc()) {
		$users[] = array(
			'user_id' => $row['user_id'],
			'login' => $row['login'],
			'first_name' => $row['first_name'],
			'last_name' => $row['last_name'],
		);
	}

	if (!$result) {
		return false;

	} else {
		return $users;
	}
}

function time_has_passed($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minutes',
        's' => 'seconds',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'now';
}

function count_unread_messages($user_id) {
	global $connect, $t_conversations_members, $t_conversations_messages;

	$user_id = (int)$user_id;
	$t_conversations_members = sanitize($t_conversations_members);
	$t_conversations_messages = sanitize($t_conversations_messages);

	$sql = "SELECT count(*) AS unread
    FROM ".$t_conversations_members." con_mem
	JOIN ".$t_conversations_messages." con_mes
    ON con_mem.conversation_id = con_mes.conversation_id
    AND con_mem.conversation_last_viewed < con_mes.date_sent
    WHERE con_mem.user_id = {$_SESSION['user_id']}";

	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($result === false) {
		die(mysqli_error($connect));
	} else {
		if($row = mysqli_fetch_row($result)) {
			return $row[0];
		}
	}
}

function get_conversation_author($conversation_id) {
	global $connect, $t_conversations_messages, $t_users;

	$conversation_id = (int)$conversation_id;
	$t_conversations_messages = sanitize($t_conversations_messages);
	$t_users = sanitize($t_users);

	$sql = "SELECT
				  CONCAT(u.first_name,' ',u.last_name) AS sender
				, con_mes.user_id AS sender_id
			FROM ".$t_conversations_messages." con_mes
			INNER JOIN
				(
					SELECT conversation_id, MIN(date_sent) MinDate
					FROM ".$t_conversations_messages."
					GROUP BY conversation_id
				) t ON con_mes.conversation_id = t.conversation_id AND con_mes.date_sent = t.MinDate
			INNER JOIN ".$t_users." u ON u.user_id = con_mes.user_id
			WHERE con_mes.conversation_id = {$conversation_id}";

	$result = $connect->query($sql);

	$tablica_nadawca = array();

	if ($row = $result->fetch_assoc()) {

		$tablica_nadawca[] = array(
			'sender_id' 	=> $row['sender_id'],
			'sender' 		=> $row['sender'],
		);

	}

	if (!$result) {
		return false;
	} else {
		return $tablica_nadawca;
	}
}

function get_conversation_recipients($conversation_id) {
	global $connect, $t_conversations_members;

	$conversation_id = (int)$conversation_id;
	$t_conversations_members = sanitize($t_conversations_members);

	$sql = "SELECT
				  CONCAT(u.first_name,' ',u.last_name) AS recipient
				  , u.user_id AS recipient_id
			FROM ".$t_conversations_members." AS con_mem, users AS u
			WHERE u.user_id = con_mem.user_id
			AND con_mem.conversation_id = {$conversation_id}
			AND con_mem.user_id != {$_SESSION['user_id']}";

	$result = mysqli_query($connect, $sql);

	$recipient_array = array();

	while ($row = $result->fetch_assoc()) {
		$recipient_array[] = array(
			'recipient_id' => $row['recipient_id'],
			'recipient' => $row['recipient'],
		);
	}

	if (!$result) {
		return false;
	} else {
		return $recipient_array;
	}
}

function get_conversations_sum() {
	global $connect, $t_conversations, $t_conversations_messages, $t_conversations_members;

	$t_conversations = sanitize($t_conversations);
	$t_conversations_messages = sanitize($t_conversations_messages);
	$t_conversations_members = sanitize($t_conversations_members);

	$sql = "SELECT
				  k.conversation_id
				, k.conversation_subject
				, MAX(con_mes.date_sent) AS conversation_last_answer
				, MAX(con_mes.date_sent) > (con_mem.conversation_last_viewed) AS conversation_unreaded
			FROM ".$t_conversations." AS k
			LEFT JOIN ".$t_conversations_messages." AS con_mes ON k.conversation_id = con_mes.conversation_id
			INNER JOIN ".$t_conversations_members." AS con_mem ON k.conversation_id = con_mem.conversation_id
			WHERE con_mem.user_id = {$_SESSION['user_id']}
			AND con_mem.conversation_deleted = 0
			GROUP BY k.conversation_id
			ORDER BY conversation_last_answer DESC
			";

	$result = mysqli_query($connect, $sql);
	$conversations = array();

	while ($row = $result->fetch_assoc()) {
		$conversations[] = array(
			'id' 				=> $row['conversation_id'],
			'subject' 			=> $row['conversation_subject'],
			'last_answer' 		=> $row['conversation_last_answer'],
			'unread_messages' => ($row['conversation_unreaded'] == 1)
		);
	}

	return $conversations;
}

function get_conversation_messages($conversation_id) {
	global $connect, $t_conversations_messages, $t_conversations_members, $t_users;

	$conversation_id = (int)$conversation_id;
	$t_conversations_messages = sanitize($t_conversations_messages);
	$t_conversations_members = sanitize($t_conversations_members);
	$t_users = sanitize($t_users);

	$sql = "SELECT
				  con_mes.date_sent
				, con_mes.date_sent > con_mem.conversation_last_viewed AS conversation_unreaded
				, con_mes.message_body
				, CONCAT(u1.first_name,' ',u1.last_name) AS sender
				, u1.user_id AS sender_id
				, u1.picture
			FROM ".$t_conversations_messages." AS con_mes
			INNER JOIN ".$t_conversations_members." AS con_mem ON con_mes.conversation_id = con_mem.conversation_id
			INNER JOIN ".$t_users." AS u1 ON u1.user_id = con_mes.user_id
			WHERE con_mes.conversation_id = {$conversation_id}
			AND con_mem.user_id = {$_SESSION['user_id']}
			ORDER BY con_mes.date_sent DESC";

	$result = mysqli_query($connect, $sql);

	$messages = array();

	while ($row = $result->fetch_assoc()) {
		$messages[] = array(
			'date'		=> $row['date_sent'],
			'sender'	=> $row['sender'],
			'sender_id'	=> $row['sender_id'],
			'picture'	=> $row['picture'],
			'unread' 	=> $row['conversation_unreaded'],
			'body'		=> $row['message_body'],
		);
	}

	return $messages;
}

function update_last_viewed_conversation($conversation_id) {
	global $connect, $t_conversations_members;

	$conversation_id = (int)$conversation_id;
	$t_conversations_members = sanitize($t_conversations_members);

	$sql = "UPDATE ".$t_conversations_members."
			SET conversation_last_viewed = UNIX_TIMESTAMP()
			WHERE conversation_id = {$conversation_id}
			AND user_id = {$_SESSION['user_id']}";

	mysqli_query($connect, $sql);
}

function create_conversation($login_ids, $subject, $body) {
	global $connect, $t_conversations, $t_conversations_messages, $t_conversations_members;

	$subject = mysqli_real_escape_string($connect, htmlentities($subject));
	$body = mysqli_real_escape_string($connect, htmlentities($body));
	$t_conversations = sanitize($t_conversations);
	$t_conversations_messages = sanitize($t_conversations_messages);
	$t_conversations_members = sanitize($t_conversations_members);

	mysqli_query($connect, "INSERT INTO `".$t_conversations."` (`conversation_subject`) VALUES ('{$subject}')");

	$conversation_id = mysqli_insert_id($connect);
	$timestamp = 'UNIX_TIMESTAMP()';

	$sql = "INSERT INTO `".$t_conversations_messages."` (`conversation_id`, `user_id`, `date_sent`, `message_body`)
			VALUES ({$conversation_id}, {$_SESSION['user_id']}, {$timestamp}, '{$body}')";

	mysqli_query($connect, $sql);

	$values = array("({$conversation_id}, {$_SESSION['user_id']}, {$timestamp}, 0)");

	//$login_ids[] = $_SESSION['user_id'];

	foreach ($login_ids as $user_id) {
		$user_id = (int)$user_id;

		$values[] = "({$conversation_id}, {$user_id}, 0, 0)";

	}

	$sql = "INSERT INTO `".$t_conversations_members."` (`conversation_id`, `user_id`, `conversation_last_viewed`, `conversation_deleted`)
			VALUES " . implode(", ", $values);

	mysqli_query($connect, $sql);
}

function validate_conversation_id($conversation_id) {
	global $connect, $t_conversations_members;

	$conversation_id = (int)$conversation_id;
	$t_conversations_members = sanitize($t_conversations_members);

	$sql = "SELECT COUNT(1)
			FROM `".$t_conversations_members."`
			WHERE `conversation_id` = {$conversation_id}
			AND `user_id` = {$_SESSION['user_id']}
			AND `conversation_deleted` = 0";

	$result = mysqli_query($connect, $sql);

	return (mysqli_result($result, 0) == 1);

}

function add_conversation_message($conversation_id, $body) {
	global $connect, $t_conversations_members, $t_conversations_messages;

	$conversation_id = (int)$conversation_id;
	$body = mysqli_real_escape_string($connect, htmlentities($body));
	$t_conversations_members = sanitize($t_conversations_members);
	$t_conversations_messages = sanitize($t_conversations_messages);

	$sql = "INSERT INTO ".$t_conversations_messages." (conversation_id, user_id, date_sent, message_body)
			VALUES ({$conversation_id}, {$_SESSION['user_id']}, UNIX_TIMESTAMP(), '{$body}') ";

	mysqli_query($connect, $sql);

	mysqli_query($connect, "UPDATE ".$t_conversations_members." SET conversation_deleted = 0 WHERE conversation_id = {$conversation_id}");
}

function delete_conversations($conversation_id) {
	global $connect, $t_conversations_members, $t_conversations, $t_conversations_messages;

	$conversation_id = (int)$conversation_id;
	$t_conversations_members = sanitize($t_conversations_members);
	$t_conversations = sanitize($t_conversations_members);
	$t_conversations_messages = sanitize($t_conversations_members);

	$sql = "SELECT DISTINCT `conversation_deleted`
			FROM `".$t_conversations_members."`
			WHERE `user_id` != {$_SESSION['user_id']}
			AND `conversation_id` = {$conversation_id}";

	$result = mysqli_query($connect, $sql);

	$count_row = $result->num_rows;
	$row = $result->fetch_row();

	if ($count_row === 1 && $row[0] == 1) {
		$delete1 = "DELETE FROM `".$t_conversations."` WHERE `conversation_id` = {$conversation_id}";
		$delete2 = "DELETE FROM `".$t_conversations_members."` WHERE `conversation_id` = {$conversation_id}";
		$delete3 = "DELETE FROM `".$t_conversations_messages."` WHERE `conversation_id` = {$conversation_id}";

		mysqli_query($connect, $delete1);
		mysqli_query($connect, $delete2);
		mysqli_query($connect, $delete3);

	} else {

		$sql = "UPDATE `".$t_conversations_members."`
				SET `conversation_deleted` = 1
				WHERE `conversation_id` = {$conversation_id}
				AND `user_id` = {$_SESSION['user_id']}";

		mysqli_query($connect, $sql);
	}
}

function get_users_id($logins) {
	global $connect, $t_users;

	$t_users = sanitize($t_users);

	foreach ($logins as &$login) {
		$login = mysqli_real_escape_string($connect, $login);
	}

	$sql = "SELECT `user_id`, `login` FROM `".$t_users."` WHERE `login` IN ('" . implode("', '", $logins) . "')";

	if ($result = $connect->query($sql)) {

		$logins = array();

		while ($row = $result->fetch_assoc()) {
			$logins[$row['login']] = $row['user_id'];

		}
	}

	return $logins;

}

function profile_photo_exists($user_id, $path) {
	global $connect, $t_users;

	$t_users = sanitize($t_users);

	$path = sanitize($path);
	$query = "SELECT picture FROM `".$t_users."` WHERE `user_id` = ?";
	$result = $connect->prepare($query);
	$result->bind_param('s', $path);
	$result->execute();
	$result->store_result();

	if(false === $result){
		return false;
	}
	return ($result->num_rows === 1);
}

function change_profile_photo($user_id, $file_temp, $file_ext) {
	global $connect, $t_users;

	$t_users = sanitize($t_users);

	$file_path = 'images/profile/' . substr(md5(time()), 0, 10) . '.' . $file_ext;

	move_uploaded_file($file_temp, $file_path);

	mysqli_query($connect, "UPDATE `".$t_users."` SET `picture`='" . mysqli_real_escape_string($connect, $file_path) . "' WHERE `user_id`=" .(int)$user_id) or die(mysqli_error($connect));
}

function update_user($update_data) {
	global $connect, $session_user_id, $t_users;

	$update = array();
	$t_users = sanitize($t_users);
	array_walk($update_data, 'array_sanitize');

	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	$query="UPDATE `".$t_users."` SET ". implode(', ', $update) ." WHERE `user_id` = $session_user_id";
	mysqli_query($connect, $query) or die(mysqli_error($connect));
}


function change_password($user_id, $password) {
	global $connect, $t_users;

	$user_id = (int)$user_id;
	$password = password_hash($password, PASSWORD_BCRYPT);

	$query = "UPDATE `".$t_users."` SET `password` = '$password' WHERE `user_id` = $user_id";

	mysqli_query($connect, $query) or die(mysqli_error($connect));
}

function register_user($register_data) {
	global $connect, $t_users;

	$t_users = sanitize($t_users);

	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = password_hash($register_data['password'], PASSWORD_BCRYPT);

	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';

	$query="INSERT INTO `".$t_users."` ($fields) VALUES ($data)";

	mysqli_query($connect, $query) or die(mysqli_error($connect));
}
/*
function count_users() {
	global $connect;

	$result = $connect->query("SELECT COUNT(`user_id`) FROM `users` WHERE `active`=1 ");
	if($row = $result->fetch_row()) {

		echo $row[0];
	}
}
*/
/*
function has_access($user_id, $permissions) {
	global $connect;

	$query = "SELECT 'user_id', permissions FROM `users` WHERE `user_id` = $user_id AND `permissions` = $permissions";
	$user_id 	= (int)$user_id;
	$permissions 	= (int)$permissions;
	$result = $connect->query($query);

	if($data = $result->fetch_assoc()) {
		return true;
	} else {
		return false;
	}
}
*/

function hash_password($password) {
    $password = password_hash($password, PASSWORD_BCRYPT);
    return $password;
}

function password_verification($login, $password) {
    global $connect, $t_users;

	$t_users = sanitize($t_users);

    $query = "SELECT password FROM ".$t_users." WHERE login = '$login'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                return $row['password'];
            }
        }
    } else {
        return false;
    }
}

function user_exists($login){
	global $connect, $t_users;

	$t_users = sanitize($t_users);

	$login = sanitize($login);
	$query = "SELECT user_id FROM `".$t_users."` WHERE `login` = ?";
	$result = $connect->prepare($query);
	$result->bind_param('s', $login);
	$result->execute();
	$result->store_result();

	if(false === $result){
		return false;
	}

	return ($result->num_rows === 1);
}

function user_active($login){
	global $connect, $t_users;

	$t_users = sanitize($t_users);

	$login = sanitize($login);
	$query = "SELECT user_id FROM ".$t_users." WHERE login=? AND active=1";
	$result = $connect->prepare($query);
	$result->bind_param('s', $login);
	$result->execute();
	$result->store_result();

	if(false === $result){
		return false;
	}

	return ($result->num_rows === 1);
}


function email_exists($email){
	global $connect, $t_users;

	$t_users = sanitize($t_users);

	$email = sanitize($email);
	$query = "SELECT user_id FROM `".$t_users."` WHERE `email` = ?";
	$result = $connect->prepare($query);
	$result->bind_param('s', $email);
	$result->execute();
	$result->store_result();

	if(false === $result){
		return false;
	}

	return ($result->num_rows === 1);
}

function user_data($user_id) {
	global $connect, $t_users;

	$data = array();
	$t_users = sanitize($t_users);
	$user_id = (int)$user_id;

	$func_num_args 	= func_num_args();
	$func_get_args 	= func_get_args();

	if ($func_num_args > 1 ) {
		unset($func_get_args[0]);

		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$fields = str_replace('`','',$fields);

		$query="SELECT $fields FROM `".$t_users."` WHERE `user_id` = $user_id";

		$result = mysqli_query($connect, $query) or die(mysqli_error($connect));
		if($data = $result->fetch_assoc()) {

			return $data;
		}
	}
}

function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false;
}

function user_id_from_login($login) {
	global $connect, $t_users;

	$login = sanitize($login);
	$t_users = sanitize($t_users);

	$query = "SELECT user_id, login FROM ".$t_users." WHERE `login` = '$login' ";
	if ($result = mysqli_query($connect, $query)) {
		while ($obj = mysqli_fetch_object($result)) {
			return $obj->user_id;
		}
		mysqli_free_result($result);
	}
	mysqli_close($connect);
}


function getAvailableLanguages() : array
{
	return [
    'en' => 'English',
    'pl' => 'Polski',
  ];
}

function loadLanguage()
{
  // from init.php
  global $current_file;

  $availableLanguageCodes = array_keys(getAvailableLanguages());
  if (isset($_COOKIE['language']) && in_array($_COOKIE['language'], $availableLanguageCodes)) {

    if ($current_file=='settings.php') {
      require_once($_SERVER['DOCUMENT_ROOT'] .'/core/languages/' . $_COOKIE['language'] . '.php');
      return;
    } else {
      require_once($_SERVER['DOCUMENT_ROOT'] . '/core/languages/' . $_COOKIE['language'] . '.php');
      return;
    }
  }
  // default language
  require_once($_SERVER['DOCUMENT_ROOT'] . '/core/languages/en.php');
}

function setLanguage(string $language)
{
  if (!in_array($language, array_keys(getAvailableLanguages())))
  {
    return false;
  }
  setcookie('language', $language, time() + 60*60*24*30);
}

?>
