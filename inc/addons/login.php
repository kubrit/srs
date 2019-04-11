<?php
logged_in_redirect();
include_once 'inc/overall/header.php';

if (isset($_POST['btn-login'])) {
	if (empty($_POST) === false) {

		$login = strip_tags($_POST['login']);
		$password = strip_tags($_POST['password']);

		$login = mysqli_real_escape_string($connect, $login);
		$password = mysqli_real_escape_string($connect, $password);

		if (empty($login) === true || empty($password) === true) {
			$error[] = ERR_USERNAME_AND_PASSWORD_EMPTY;
		} else if (user_exists($login)=== false){
			$error[] = ERR_USERNAME_NOT_EXIST;
		} else if (user_active($login) === false) {
			$error[] = ERR_ACCOUNT_INACTIVE;
		} else if (empty($error) == true) {

			if (strlen($password) > 32) {
				$error[] = ERR_PASSWORD_TO_LONG;
			}

			$query = $connect->query("SELECT user_id, login, email, password, permissions, type FROM ".$t_users." WHERE login='$login'");
			$row = $query->fetch_array();
			$exists = $query->num_rows;

			if (password_verification($login, $password) && $exists == 1) {

				if(!isset($_SESSION)) session_start();
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['login'] = $row['login'];
				$_SESSION['permissions'] = $row['permissions'];
				$_SESSION['type'] = $row['type'];

				mysqli_query($connect, 'UPDATE `'.$t_users.'` SET `last_login` = now() WHERE `user_id`='.$_SESSION['user_id'].'');

				echo "<script> window.location.assign('home.php'); </script>";
				exit();
			} else {
				$error[] = ERR_CREATE_USER_PASSWORD_COMBINATION_INVALID;
			}
		}
		$connect->close();
	}
}

include_once 'inc/addons/login_form.php';
?>
