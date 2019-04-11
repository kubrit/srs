<?php
include '../core/init.php';

$req = "SELECT recipient_address FROM ".$t_shipments." WHERE recipient_address LIKE '%".$_REQUEST['term']."%' LIMIT 15";
	
$query = $connect->query($req);

while($row = $query->fetch_assoc())
{
	
	$results[] = array(
	'label' => $row['recipient_address'] ,
	'value' => $row['recipient_address']
	);
}
echo json_encode($results);
?>