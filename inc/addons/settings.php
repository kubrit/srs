<?php
// require_once 'core/init.php';
// protected_page();
// require_once 'inc/general/header.php';

if (empty($_POST) === false) {

	$required_fields = array('first_name', 'email');

	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$error[] = ERR_FIELDS_WITH_ASTERISK_ARE_REQUIRED;
			break 1;
		}
	}

	if (empty($error) === true) {
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$error[] = ERR_VALID_EMAIL_REQUIRED;
		} else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
			$error[] = '<b>' . $_POST['email'] . '</b> ' . ERR_IS_ALREADY_TAKEN;
		}
	}
}

if (empty($_POST) === false && empty($error) === true) {
	$update_data = array(
		'first_name' => $_POST['first_name'],
		'last_name' => $_POST['last_name'],
		'email' => $_POST['email'],
		'cellphone' => $_POST['cellphone'],
		'landline_phone' => $_POST['landline_phone'],
		'company_id' => $_POST['company_id'],
		'allow_email' => ($_POST['allow_email'] == 'on') ? 1 : 0
	);
	update_user($update_data);
	setLanguage($_POST['language']);
	// refresh page after language change
	if (!empty($_POST['language'])) {
		header('Location: settings.php');
	}
	// refresh profile data after save
	$user_data = user_data(
	   $session_user_id
	, 'user_id'
	, 'login'
	, 'first_name'
	, 'last_name'
	, 'cellphone'
	, 'landline_phone'
	, 'company_id'
	, 'email'
	, 'allow_email'
	, 'picture'
	);
	$success[] = SUC_DATA_UPDATED;
}

include 'inc/addons/settings_form.php';
?>
