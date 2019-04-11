<?php
include_once 'core/init.php';

$shipment_id = $_POST['shipment_id'];
$date_sent = $_POST['date_sent'];
$recipient = $_POST['recipient'];
$recipient_address = $_POST['recipient_address'];
$body_sent_correspondence = $_POST['body_sent_correspondence'];
$shipment_type_id = $_POST['shipment_type_id'];
$chk = isset($_POST['chk']) ? $_POST['chk'] : '';
$chkcount = count($shipment_id);

	for($i=0; $i < $chkcount; $i++) {

		$sql = "UPDATE shipments SET
		date_sent = '$date_sent[$i]'
		, recipient = '$recipient[$i]'
		, recipient_address = '$recipient_address[$i]'
		, body_sent_correspondence = '$body_sent_correspondence[$i]'
		, shipment_type_id = '$shipment_type_id[$i]'
		, updated_by_id = '".(int)$user_data['user_id']."'
		WHERE shipment_id = ".$shipment_id[$i];

		$connect->query($sql);
	}
?>
<script>window.location.href='shipments.php?shipments=all';</script>
