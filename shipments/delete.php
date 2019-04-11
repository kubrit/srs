<?php

require_once 'core/init.php';

	$chk = isset($_POST['chk']) ? $_POST['chk']: false;

	if (!empty($_GET['record']) == 'true') {
		$chkcount = 1;
	} else {
		$chkcount = count($chk);
	}

	if(isset($_POST['chk']) == "" && !empty($_GET['record']) != 'true') {
		?>
    <script>
			alert('<?php echo ERR_SELECT_AT_LEAST_ONE; ?>');
			window.location.href='shipments.php?shipments=all';
		</script>
    <?php
	}
	else
	{
		for($i=0; $i<$chkcount; $i++)
		{
				if (!empty($_GET['record']) == 'true') {
					$shipment_id = $_GET['shipment_id'];
				} else {
					$shipment_id = $chk[$i];
				}

			$sql=$connect->query("UPDATE shipments SET deleted = 1 WHERE shipment_id=".$shipment_id);
		}

		if($sql)
		{
			?>
			<script>
			alert('<?php echo SUC_SUCCESS . " [ ".$chkcount." ] " . SUC_RECORDS_DELETED; ?>');
			window.location.href='shipments.php?shipments=all';
			</script>
			<?php
		}
		else
		{
			?>
			<script>
			alert('<?php echo ERR_NO_RECORD_DELETED; ?>');
			window.location.href='shipments.php?shipments=all';
			</script>
			<?php
		}

	}


?>
