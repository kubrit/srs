<?php
include_once './core/init.php';

$shipments=$_REQUEST['shipments'];

if(isset($_POST['save_many'])) {
	$total = strip_tags($_POST['total']);

	for($i=1; $i<=$total; $i++)
	{
		$ds = strip_tags($_POST["date_sent$i"]);
		$re = strip_tags($_POST["recipient$i"]);
		$rea = strip_tags($_POST["recipient_address$i"]);
		$bsc = strip_tags($_POST["body_sent_correspondence$i"]);
		$sti = isset($_POST["shipment_type_id$i"]) ? strip_tags(htmlentities($_POST["shipment_type_id$i"])) : 0;

		$sql = "INSERT INTO shipments(
		date_sent
		, sent
		, received
		, recipient
		, recipient_address
		, body_sent_correspondence
		, shipment_type_id
		, registered_by_id
		) VALUES (
		'".$ds."'
		, '".$sent."'
		, '".$received."'
		, '".$re."'
		, '".$rea."'
		, '".$bsc."'
		, '".$sti."'
		, '".(int)$user_data['user_id']."')";

		$result = $connect->query($sql);
	}

	if($result) {
		?>
        <script>
		alert('<?php echo SUC_SUCCESS." [ ".$total." ] ".SUC_RECORDS_CREATED; ?>');
		window.location.href='shipments.php?shipments=all';
		</script>
        <?php
	} else {
		?>
        <script>
		alert('<?php echo ERR_FAILED_TO_SAVE; ?>');
		window.location.href='shipments.php?shipments=all';
		</script>
        <?php
	}
}
?>

<div class="row">
	<div class="table-responsive">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo TXT_SHIPMENTS; ?></div>
			<div class="panel-body">
				<?php
				if (!empty($_GET['shipments'] == 'all') === true) {
					$error[] = ERR_CANT_ADD_SHIPMENTS_ALL;
				} elseif (!empty($_GET['shipments'] == 'received') === true) {
				?>
					<a href="shipments.php?shipments=received&action=new" class="btn btn-large btn-info"><i class="glyphicon glyphicon-pencil"></i>&nbsp;<?php echo BTN_CHANGE_SHIPMENTS_COUNT; ?></a>
				<?php
				} elseif (!empty($_GET['shipments'] == 'sent') === true) {
				?>
					<a href="shipments.php?shipments=sent&action=new" class="btn btn-large btn-info"><i class="glyphicon glyphicon-pencil"></i>&nbsp;<?php echo BTN_CHANGE_SHIPMENTS_COUNT; ?></a>
				<?php
				}
				?>
			</div>

			<?php
			if(isset($_POST['btn-create-form']))
			{
			?>
				<form method="post">

					<input type="hidden" name="total" value="<?php echo $_POST["how_many_records"]; ?>" />


					<table class='table table-bordered'>
					<tr>
						<th><?php echo TBL_NUMERO; ?></th>
						<th><?php echo TBL_SENT_DATE; ?></th>
						<th><?php echo TBL_RECIPIENT; ?></th>
						<th><?php echo TBL_RECIPIENT_ADDRESS; ?></th>
						<th><?php echo TBL_BODY; ?></th>
						<th><?php echo TBL_SHIPMENT_TYPE; ?></th>
					</tr>
					<?php
					for($i=1; $i<=$_POST["how_many_records"]; $i++)
					{
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td>
							<div class="input-group date">
								<input type="text" name="date_sent<?php echo $i; ?>" placeholder=" <?php echo TBL_SENT_DATE; ?> " class='form-control datepicker'/>
								<div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
							</div>
						</td>
						<td><input type="text" name="recipient<?php echo $i; ?>" placeholder=" <?php echo TBL_RECIPIENT; ?> " class="form-control" id="recipient" data-provide="typeahead" autocomplete="off" /></td>
						<td><input type="text" name="recipient_address<?php echo $i; ?>" placeholder=" <?php echo TBL_RECIPIENT_ADDRESS; ?> " class='form-control' id="recipient_address" data-provide="typeahead" autocomplete="off" /></td>
						<td><textarea type="text" name="body_sent_correspondence<?php echo $i; ?>" placeholder=" <?php echo PLH_CONTENT_OF_SENT_CORRESPONDENCE; ?> " class='form-control' style="min-width: 100%;resize:vertical"/></textarea></td>
						<td>
							<select name="shipment_type_id<?php echo $i; ?>" class="form-control match-content">
								<option value="0" disabled selected style='display:none;'><?php echo TXT_CHOOSE; ?></option>
								<?php
								$sql = "SELECT * FROM ".$t_shipments_types."";
								$result = $connect->query($sql);
								while($sti = $result->fetch_assoc()) {
										echo "<option value='$sti[shipment_type_id]'>$sti[shipment_type_name]</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td colspan="100%">
							<button type="submit" name="save_many" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;<?php echo BTN_SAVE; ?></button>
							<a href="shipments.php?shipments=all" class="btn btn-large btn-success"> <i class="glyphicon glyphicon-fast-backward"></i>&nbsp;<?php echo BTN_BACK; ?></a>
						</td>
					</tr>
					</table>
				</form>
			<?php
			}
			?>
		</div>
	</div>
</div>
