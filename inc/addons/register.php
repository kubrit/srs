<?php
if(isset($_POST['btn-register'])) {

	if (empty($_POST) === false) {
		$required_fields = array('login', 'password', 'repeat_password', 'email');

		foreach($_POST as $key=>$value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$error[] = ERR_FIELDS_WITH_ASTERISK_ARE_REQUIRED;
				break 1;
			}
		}

		if (empty($error) === true) {
			if (user_exists($_POST['login']) === true) {
				$error[] = '<b>' . $_POST['login'] . '</b> ' . ERR_IS_ALREADY_TAKEN;
			}
			if (preg_match("/\\s/", $_POST['login']) == true) {
				$error[] = ERR_SPACES_IN_LOGIN_NOT_ALLOWED;
			}
			if (strlen($_POST['password']) < 4) {
				$error[] = ERR_PASSWORD_CHAR_MINIMUM;
			}
			if ($_POST['password'] !== $_POST['repeat_password']) {
				$error[] = ERR_PASSWORD_DONT_MATCH;
			}

			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
				$error[] = ERR_VALID_EMAIL_REQUIRED;
			}

			if (email_exists($_POST['email']) === true) {
				$error[] = '<b>' . $_POST['email'] . '</b> ' . ERR_IS_ALREADY_TAKEN;
			}
		}
	}
}

if (isset($_GET['success']) && empty($_GET['success'])) {

		$success[] = SUC_REGISTERED;

} else {

	if (empty($_POST) === false && empty($error) === true) {
		$register_data = array(
			'login' => $_POST['login'],
			'password' => $_POST['password'],
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email']
		);
		register_user($register_data);
		?>
    <script>
		window.location.href='register.php?success';
		</script>
		<?php
		exit();
	}
}

require_once 'inc/addons/register_form.php';
require_once 'inc/overall/footer.php';
?>
