<?php
require_once 'core/init.php';
require_once 'inc/overall/header.php';

echo '<br>';

$error[] = ERR_ALREADY_REGISTERED_AND_LOGGED_IN;

	if (empty($error) === false) {
		echo error_message($error);
	}

require_once 'inc/overall/footer.php';
?>
