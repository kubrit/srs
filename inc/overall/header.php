<!DOCTYPE html>
<html>
<?php

require_once 'inc/head.php'; //title, meta, links, scripts...

echo "<body id='".basename($_SERVER['PHP_SELF'],'.php')."'>";

	if (logged_in() === true) {
		require_once 'inc/menu.php';
		require_once 'inc/header.php';
	}
	
	echo '<div class="container">';
?>