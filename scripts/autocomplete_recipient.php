<?php
include '../core/init.php';

if (isset($_POST['query'])) {
	
	$query = $_POST['query'];
	
	$sql = mysqli_query($connect,"SELECT * FROM ".$t_shipments." WHERE recipient LIKE '%{$query}%'");
	
	$array = array();
	
	while($row = mysqli_fetch_assoc($sql)) {
		array[] = $row['recipient'];
	}
	echo json_encode($array);
}
?>