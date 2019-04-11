<?php
if(!isset($_SESSION)) session_start();

ob_start();

// hide all errors
//error_reporting(0);

// display all errors
ini_set('display_errors', 1);
error_reporting(-1);
error_reporting(E_ALL);

require_once 'database/connect.php';
require_once 'functions/general.php';
require_once 'functions/users.php';

loadLanguage();

if (logged_in() === true) {

	// all session data are kept in /inc/addons/login.php
	$session_user_id = $_SESSION['user_id'];

	$user_data = user_data(
	   $session_user_id
	, 'user_id'
	, 'login'
	, 'first_name'
	, 'last_name'
	, 'cellphone'
	, 'landline_phone'
	, 'company_id'
	, 'permissions'
	, 'type'
	, 'email'
	, 'allow_email'
	, 'password'
	, 'picture'
	);

	if (user_active($user_data['login']) === false) {
		session_destroy();
    header('Location: index.php');
    exit();
  }
}

$error = array();
$success = array();
$info = array();
?>
