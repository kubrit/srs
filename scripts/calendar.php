<?php
include 'core/database/connect.php';
/*
    $post_data = array();
    $post_data[] = array('title' => 'Test', 'start' => '2017-11-13');
    $post_data[] = array('title' => 'Test2', 'start' => '2017-11-14');
    echo json_encode($post_data);
*/
    
/*
	$sql = "SELECT * FROM ".$t_shipments." WHERE date_sent <= NOW()";
	if ($result = $connect->query($sql)) {
		$post_data = array();

		$result = $connect->query($sql) or die(mysqli_error($connect));

		while($row = $result->fetch_object()){
			$post_data[] = array(
				'id' => $row->shipment_id,
				'title' => $row->recipient,
				'start' => $row->date_sent
			);
		}
		$result->close();

	echo json_encode($post_data);
}
*/



$con = new PDO("mysql:host=$DB_SERVER;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // set the error mode to excptions 
	$stmt = $con->prepare("SELECT * FROM ".$t_shipments);

	$stmt->execute();

	$events = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){   //important ! $start = "2010-05-10T08:30";  iso8601 format !!

		$eventArray['id'] = $row['shipment_id'];
		$eventArray['title'] =  $row['recipient'];
		$eventArray['start'] = $row['date_sent'];

	  $events[] = $eventArray;
	  echo json_encode($events);
	}
?>