<?php
require_once 'core/init.php';

include_once 'inc/overall/header.php';

	if (logged_in() === true) {
		
		include_once 'home.php';
		
	} else {
		
		include_once 'login.php';

	}

include_once 'inc/overall/footer.php';
?>