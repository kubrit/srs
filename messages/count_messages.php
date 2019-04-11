<?php
require_once '../core/init.php';
protected_page();

$count_unread_messages = count_unread_messages($user_data['user_id']);

if ($count_unread_messages > 0) {
	echo '<span class="badge" style="background-color: green">' . $count_unread_messages . '</span>';
} else {
	echo '<span class="badge">' . $count_unread_messages . '</span>';
}
?>
