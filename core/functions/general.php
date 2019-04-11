<?php
function protected_page() {
	if (logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}

function logged_in_redirect() {
	if (logged_in() === true) {
		header('Location: error.php');
		exit();
	}
}

function information_message($info) {
	return '<div class="alert alert-danger alert-dismissable"><a class="panel-close close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-info-sign"></span>&nbsp;' .implode('</div><div class="alert alert-danger alert-dismissable"><a class="panel-close close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-info-sign"></span>&nbsp;', $info). '</div>';
	
}

function error_message($error) {
	return '<div class="alert alert-danger alert-dismissable"><a class="panel-close close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;' .implode('</div><div class="alert alert-danger alert-dismissable"><a class="panel-close close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;', $error). '</div>';
	
}

function success_message($success) {
	return '<div class="alert alert-success alert-dismissable"><a class="panel-close close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-ok"></span>&nbsp;' . implode('</div><div class="alert alert-success alert-dismissable"><a class="panel-close close" data-dismiss="alert">×</a><span class="glyphicon glyphicon-ok"></span>&nbsp;', $success) . '</div>';
}

function array_sanitize(&$item) {
	global $connect;
	
	$item = htmlentities(strip_tags(mysqli_real_escape_string($connect, $item)));
}

function sanitize($data) {
	global $connect;

    return htmlentities(strip_tags(mysqli_real_escape_string($connect, $data)));
}

?>