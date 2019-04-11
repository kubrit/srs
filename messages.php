<?php
require_once 'core/init.php';
protected_page();
require_once 'inc/overall/header.php';

$messages = isset($_REQUEST['messages']) ? $_REQUEST['messages'] : '';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

	if (empty($messages == 'list') === false) {
		if (!empty($action)) {
			if ($action == 'new') {
				$_SESSION['action']='new';
				include 'messages/new.php';
			}
			if ($action == 'delete') {
				$_SESSION['action']='delete';
				include 'messages/delete.php';
			}
			if ($action == 'preview') {
				$_SESSION['action']='preview';
				include 'messages/preview.php';
			}
		} else {
			$_SESSION['action']='list';
			include 'messages/list.php';
		}
	} else {
		echo "<script> window.location.assign('messages.php?messages=list'); </script>";
		exit();
	}

	if (empty($error) === false) {
		echo error_message($error);
	} else if (empty($success) === false) {
		echo success_message($success);
	}

require_once 'inc/overall/footer.php';
?>