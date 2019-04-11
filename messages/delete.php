<?php

include_once './core/init.php';

$messages = $_REQUEST['messages'];
$conversation_id = $_REQUEST['conversation_id'];

if ((isset($_GET['action']) == 'delete' && isset($conversation_id)) === true) {

	if (validate_conversation_id($conversation_id) === false) {
		$error[] = ERR_INVALID_CONVERSATION_ID;
	}

	if (empty($error)) {
		delete_conversations($conversation_id);
		echo "<script>window.location.assign('messages.php?messages=list');</script>";
	}

}

?>
