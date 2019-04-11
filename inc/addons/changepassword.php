<?php
require_once 'core/init.php';

protected_page();

require_once 'inc/overall/header.php';

if (empty($_POST) === false) {

	$required_fields = array('current_password', 'password', 'repeat_password');

	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$error[] = ERR_FIELDS_WITH_ASTERISK_ARE_REQUIRED;
			break 1;
		}
	}

	if (password_verify($_POST['current_password'], $user_data['password'])) {
		if (trim($_POST['password']) !== trim($_POST['repeat_password'])) {
			$error[] = ERR_PASSWORD_DONT_MATCH;
		} else if (strlen($_POST['password']) < 4) {
			$error[] = ERR_PASSWORD_CHAR_MINIMUM;
		}
	} else {
		$error[] = ERR_INCORRECT_PASSWORD;
	}
}

if (empty($_POST) === false && empty($error) === true) {
	change_password($session_user_id, $_POST['password']);
	$success[] = SUC_PASSWORD_CHANGED;
}

include 'inc/addons/changepassword_form.php';
?>
