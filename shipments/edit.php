<?php

$shipments_type_id_value = '';

	if(isset($_POST['chk']) == "" && !empty($_GET['record']) != 'true') {
		?>
    <script>
		alert('<?php echo ERR_SELECT_AT_LEAST_ONE; ?>');
		window.location.href='shipments.php?shipments=all';
		</script>
    <?php
	}
	$chk = isset($_POST['chk']) ? $_POST['chk'] : '';

	if (!empty($_GET['record']) == 'true') {
		$chkcount = 1;
	} else {
		$chkcount = count($chk);
	}
?>

<div class="row">
	<div class="table-responsive">
		<div class="panel panel-default">

			<div class="panel-body">
				<?php if (empty($_GET['shipments'] == 'all') === true) { ?>
				<a href="shipments.php?shipments=all&action=new" class="btn btn-large btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;<?php echo TXT_ADD_NEW_SHIPMENTS; ?></a>
				<?php } ?>
			</div>

			<form method="post" action="shipments.php?shipments=all&action=update">

				<table class="table table-bordered table-hover">
				<tr>
					<th><?php echo TBL_NUMERO; ?></th>
					<th><?php echo TBL_SENT_DATE; ?></th>
					<th><?php echo TBL_RECIPIENT; ?></th>
					<th><?php echo TBL_RECIPIENT_ADDRESS; ?></th>
					<th><?php echo TBL_BODY; ?></th>
					<th><?php echo TBL_SHIPMENT_TYPE; ?></th>
				</tr>
			<?php

			for($i=0; $i<$chkcount; $i++) {

				if (!empty($_GET['record']) == 'true') {
					$shipment_id = $_GET['shipment_id'];
				} else {
					$shipment_id = $chk[$i];
				}

				$res = $connect->query("SELECT * FROM ".$t_shipments." WHERE shipment_id=".$shipment_id);
				while($row = $res->fetch_array()) {
					$shipments_type_id_value = $row['shipment_type_id'];
				?>

				<tr>
					<td><?php echo $shipment_id; ?></td>
					<td>
						<input type="hidden" name="shipment_id[]" value="<?php echo $row['shipment_id'];?>" />
						<div class="input-group date">
						<input type="text" name="date_sent[]" placeholder=" <?php echo PLH_SENT_DATE; ?> " value="<?php echo $row['date_sent'];?>" class='form-control datepicker'/>
						<div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
						</div>
					</td>
					<td><input type="text" name="recipient[]" placeholder=" <?php echo PLH_RECIPIENT; ?> " value="<?php echo $row['recipient'];?>" class='form-control' /></td>
					<td><input type="text" name="recipient_address[]" placeholder=" <?php echo PLH_RECIPIENT_ADDRESS; ?> " value="<?php echo $row['recipient_address'];?>" class='form-control' /></td>
					<td><textarea type="text" name="body_sent_correspondence[]" placeholder=" <?php echo PLH_CONTENT_OF_SENT_CORRESPONDENCE; ?> " class='form-control' style="min-width: 100%;resize:vertical"/><?php echo $row['body_sent_correspondence'];?></textarea></td>
					<td>
						<select name="shipment_type_id[]" class="form-control match-content">
							<option value="" disabled selected style='display:none;'><?php echo TXT_CHOOSE; ?></option>
							<?php
							$sql = "SELECT * FROM ".$t_shipments_types."";
							$result = $connect->query($sql);
							while($rop2 = $result->fetch_assoc()) {
								echo "<option value='$rop2[shipment_type_id]' ". ($shipments_type_id_value == "$rop2[shipment_type_id]" ? 'selected="selected"' : "")." >$rop2[shipment_type_name]</option>";
							}
							?>
						</select>
					</td>
				</tr>
			<?php
				}
			}
			?>
				<tr>
					<td colspan="100%">
						<button type="submit" name="savemul" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;<?php echo BTN_UPDATE_ALL; ?></button>&nbsp;
						<a href="shipments.php?shipments=all" class="btn btn-large btn-success"> <i class="glyphicon glyphicon-fast-backward"></i>&nbsp;<?php echo BTN_CANCEL; ?></a>
					</td>
				</tr>
				</table>
			</form>
		</div>
	</div>
</div>
