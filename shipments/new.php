<?php

$shipments=htmlentities(strip_tags($_REQUEST['shipments']));

?>
<div class="row">
	<div class="table-responsive">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo TXT_SHIPMENTS; ?></div>
			<div class="panel-body">
				<a href="shipments.php?shipments=all" class="btn btn-large btn-info"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;<?php echo BTN_PREVIEW_ALL; ?></a>
			</div>

			<form method="post" action="shipments.php?shipments=<?php echo $_GET['shipments']; ?>&action=create">
				<table class='table table-bordered'>
					<tr>
						<td><?php echo TBL_HOW_MANY_TO_ADD; ?></td>
					</tr>

					<tr>
						<td><input type="text" name="how_many_records" autocomplete="off" placeholder=" <?php echo PLH_HOW_MANY_ITEMS_TO_ADD; ?> " maxlength="2" pattern="[0-9]+" class="form-control" required /></td>
					</tr>
					<tr>
						<td>
							<button type="submit" name="btn-create-form" class="btn btn-primary">&nbsp;<?php echo BTN_NEXT; ?></button>
							<a href="shipments.php?shipments=all" class="btn btn-large btn-success"> <i class="glyphicon glyphicon-fast-backward"></i>&nbsp;<?php echo BTN_BACK; ?></a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
