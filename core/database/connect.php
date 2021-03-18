<?php
$DB_SERVER = getenv( 'MYSQL_DATABASE_HOST' ) ? getenv( 'MYSQL_DATABASE_HOST' ) : 'localhost';
$DB_DATABASE = getenv( 'MYSQL_DATABASE_NAME' ) ? getenv( 'MYSQL_DATABASE_NAME' ) : 'srs';
$DB_USERNAME = getenv( 'MYSQL_DATABASE_USER' ) ? getenv( 'MYSQL_DATABASE_USER' ) : 'srs';
$DB_PASSWORD = getenv( 'MYSQL_DATABASE_USER_PASSWORD' ) ? getenv( 'MYSQL_DATABASE_USER_PASSWORD' ) : 'my_secret_password';

$connect = new MySQLi($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);

mysqli_set_charset($connect,"utf8");

// Check connection
if (mysqli_connect_errno()) {
	$sql_error = "<br><span style='margin-left: 30px;'>Error! Failed to connect to MySQL: <b>" . mysqli_error($connect)."</b><br></span>";
	echo $sql_error;
}

if($connect->connect_errno) {
	die("ERROR : -> ".$connect->connect_error);
}

// tables
$t_users = "users";
$t_shipments = "shipments";
$t_shipments_types = "shipments_types";
$t_companies = "companies";
$t_conversations = "conversations";
$t_conversations_members = "conversations_members";
$t_conversations_messages = "conversations_messages";

?>
