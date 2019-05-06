<?php
include '../core/init.php';

$req = "SELECT recipient FROM `" . $t_shipments . "` WHERE recipient LIKE '%".$_REQUEST['term']."%' GROUP BY recipient LIMIT 15";

$query = $connect->query($req);

if ($query->num_rows > 0){

		while($row = $query->fetch_assoc())
		{
			$results[] = array(
			'label' => $row['recipient'] ,
			'value' => $row['recipient']
			);
		}

echo json_encode($results);
}
?>
