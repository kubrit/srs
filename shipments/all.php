<?php
require_once 'core/init.php';
protected_page();

require_once 'inc/overall/header.php';

	$search_condition = isset($_REQUEST['search_phrase']) ? $_REQUEST['search_phrase'] : '';

	// Pagination
	$per_page = 10;
	$sql1 = "SELECT * FROM `".$t_shipments."` ";

	$where = " WHERE deleted = 0 ";
	$received = " AND received = 1 ";
	$sent = " AND sent = 1 ";
	$orderby_asc = " ORDER BY shipment_id ASC ";
	$orderby_desc = " ORDER BY shipment_id DESC ";
	if ($_GET['shipments'] == 'received')
	{
		$set_received = isset($set_received) ? $set_received : '1';

		$sql1 .= $where;
		$sql1 .= $received;
		$sql1 .= $orderby_desc;
	}
	else if ($_GET['shipments'] == 'sent')
	{
		$set_sent = isset($set_sent) ? $set_sent : '1';
		$sql1 .= $where;
		$sql1 .= $sent;
		$sql1 .= $orderby_desc;
	}
	else if ($_GET['shipments'] == 'all')
	{
		$sql1 .= $where;
		$sql1 .= $orderby_desc;
	}

	$query_page = mysqli_query($connect, $sql1);
	$number_of_pages = mysqli_num_rows($query_page);
	$pages = ceil($number_of_pages / $per_page);
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1) * $per_page;
	$lp='';

	$sql = "SELECT
				  p.*
				, r.shipment_type_name
				, CONCAT(u1.first_name,' ',u1.last_name) AS registered_by
				, CONCAT(u2.first_name,' ',u2.last_name) AS updated_by
				FROM shipments AS p
				LEFT JOIN ".$t_shipments_types." AS r ON p.shipment_type_id = r.shipment_type_id
				INNER JOIN ".$t_users." AS u1 ON p.registered_by_id = u1.user_id
				INNER JOIN ".$t_users." AS u2 ON p.updated_by_id = u2.user_id ";

	if (isset($_GET['search_phrase']) && !empty($_GET['search_phrase'])) {
		$search_word = $_GET['search_phrase'];

        $search_condition = mysqli_real_escape_string($connect, $_GET['search_phrase']);
                $sql .= " WHERE deleted = 0 ";
                $sql .= " AND (p.recipient LIKE '%{$search_condition}%' ";
                $sql .= " OR p.recipient_address LIKE '%{$search_condition}%' ";
                $sql .= " OR CONCAT(u1.first_name,' ',u1.last_name) LIKE '%{$search_condition}%' ";
                $sql .= " OR CONCAT(u2.first_name,' ',u2.last_name) LIKE '%{$search_condition}%' ";
                $sql .= " OR r.shipment_type_name LIKE '%{$search_condition}%' ";
                $sql .= " OR p.body_sent_correspondence LIKE '%{$search_condition}%') ";
	}
	else
	{
		$where = " WHERE deleted = 0 ";
		$received = " AND received = 1 ";
		$sent = " AND sent = 1 ";
		$orderby = " ORDER BY shipment_id DESC ";
		$limit = " LIMIT $start, $per_page";

		if ($_GET['shipments'] == 'received')
		{
			$sql .= $where;
			$sql .= $received;
			$sql .= $orderby;
			$sql .= $limit;
		} else if ($_GET['shipments'] == 'sent')
		{
			$sql .= $where;
			$sql .= $sent;
			$sql .= $orderby;
			$sql .= $limit;
		} else if ($_GET['shipments'] == 'all')
		{
			$sql .= $where;
			$sql .= $orderby;
			$sql .= $limit;
		}
	}

	if($lp != 1)
	{
		$first = 1;
		$previous = $page - 1;
		$next = $page + 1;
		$last = $pages;
		$lp = ($page * $per_page) - ($per_page - 1);
		$pagination = '';

		$pagination = '<ul class="pagination">';

			if(!($page <= 1))
			{
				$pagination .= "<li class='page-item'><a class='page-link' href='".$_SERVER['PHP_SELF']."?shipments=".$_GET['shipments']."&page=$first' aria-label='First'><span aria-hidden='true'>&laquo;...</span><span class='sr-only'>First</span></a></li>";
				$pagination .= "<li class='page-item'><a class='page-link' href='".$_SERVER['PHP_SELF']."?shipments=".$_GET['shipments']."&page=$previous' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
			}

			if($pages >= 1)
			{
				for($x = 1; $x <= $pages; $x++)
				{
					$pagination .=  ($x == $page) ? '<li class="page-item active"><a href="?shipments='.$_GET['shipments'].'&page='.$x.'">'.$x.'</a></li>': '<li class="page-item"><a href="?shipments='.$_GET['shipments'].'&page='.$x.'">'.$x.'</a></li>';
				}
			}

			if(!($page >= $pages))
			{
				$pagination .=  "<li class='page-item'><a class='page-link' href='".$_SERVER['PHP_SELF']."?shipments=".$_GET['shipments']."&page=$next' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";
				$pagination .=  "<li class='page-item'><a class='page-link' href='".$_SERVER['PHP_SELF']."?shipments=".$_GET['shipments']."&page=$last' aria-label='Last'><span aria-hidden='true'>...&raquo;</span><span class='sr-only'>Last</span></a></li>";

			}

		$pagination .= '</ul>';
	}
	// Pagination STOP

?>
		<!-- export CSV -->
		<form action="shipments.php?shipments=<?php echo $_GET['shipments']; ?>&action=csv" method="post" id="FormExport1">
			<input type="hidden" name="export" />
		</form>

		<!-- export PDF -->
		<form action="shipments.php?shipments=<?php echo $_GET['shipments']; ?>&action=pdf" method="post" id="FormExport2">
			<input type="hidden" name="export" />
		</form>

<div class="row">
	<div class="panel panel-default">
        <div class="panel-heading text-center"><?php //if (isset($_SESSION['shipments']) === true) { echo ' - '.$_SESSION['shipments']; } ?>
			<div class="btn-group">
			<?php
			if (empty($_GET['shipments'] == 'all') === true) {
			?>
				<button type="button" class="btn btn-default" onclick="location.href='shipments.php?shipments=all';">&nbsp;<?php echo BTN_ALL; ?></button>
			<?php
			} else {
			?>
				<button type="button" class="btn btn-default active" onclick="location.href='shipments.php?shipments=all';">&nbsp;<?php echo BTN_ALL; ?></button>
			<?php
			}
			if (empty($_GET['shipments'] == 'received') === true) {
			?>
				<button type="button" class="btn btn-default" onclick="location.href='shipments.php?shipments=received';">&nbsp;<?php echo BTN_RECEIVED; ?></button>
			<?php
			} else {
			?>
				<button type="button" class="btn btn-default active" onclick="location.href='shipments.php?shipments=received';">&nbsp;<?php echo BTN_RECEIVED; ?></button>
			<?php
			}
			if (empty($_GET['shipments'] == 'sent') === true) {
			?>
				<button type="button" class="btn btn-default" onclick="location.href='shipments.php?shipments=sent';">&nbsp;<?php echo BTN_SENT; ?></button>
			<?php
			} else {
			?>
				<button type="button" class="btn btn-default active" onclick="location.href='shipments.php?shipments=sent';">&nbsp;<?php echo BTN_SENT; ?></button>
			<?php
			}
			?>
			</div>
		</div>

        <div class="panel-body">

			<div class="col-xs-4 pull-right">
				<form name="search_form" autocomplete="off" method="GET" action="">
					<div class="input-group">
						<input type="hidden" name="shipments" value="<?php echo $_GET['shipments']; ?>" />

						<input  class="form-control" id="search" type="search" name="search_phrase" value="<?php if(isset($_REQUEST['search_phrase']) && empty($_REQUEST['search_phrase'])=== false){ echo htmlentities($search_condition); } ?>" placeholder=" <?php echo PLH_SEARCH; ?> ">
						<span class="input-group-btn">
							<button class="btn btn-default"><?php echo BTN_SEARCH; ?></button>
						</span>
					</div><!-- /input-group -->
				</form>
			</div><!-- /.col-xs-4 -->

			<div class="col-xs-8 pull-right">
				<div class="btn-group pull-right" role="group" aria-label="...">

					<?php
					if (empty($_GET['shipments'] == 'all') === true) {
					?>
						<button type="button" class="btn btn-default" onclick="location.href='shipments.php?shipments=<?php echo $_GET['shipments']; ?>&action=new';"><span class="glyphicon glyphicon-plus"></span>&nbsp;<?php echo BTN_ADD; ?></button>
					<?php
					}
					?>

					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-export"></span>&nbsp;<?php echo BTN_EXPORT; ?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="javascript:;" onclick="document.getElementById('FormExport1').submit();"><?php echo BTN_CSV; ?></a></li>
						<li><a href="javascript:;" onclick="document.getElementById('FormExport2').submit();"><?php echo BTN_PDF; ?></a></li>
					</ul>

				</div>
			</div><!-- /.col-xs-8 -->
		</div><!-- panel-body -->

<form method="post" action="" name="frm">
	<table class="table table-hover table-sm table-responsive" style="margin-bottom: 0px;">
		<thead>
			<tr class="info">
				<th style="text-align: center;"><?php echo TBL_NUMERO; ?></th>
				<th style="text-align: center;"></th>
				<th style="text-align: center;"><?php echo TBL_SENT_DATE; ?></th>
				<th style="text-align: center;"><?php echo TBL_RECIPIENT; ?></th>
				<th style="text-align: center;"><?php echo TBL_RECIPIENT_ADDRESS; ?></th>
				<th style="text-align: center;"><?php echo TBL_BODY; ?></th>
				<th style="text-align: center;"><?php echo TBL_SHIPMENT_TYPE; ?></th>
				<th style="text-align: center;"><?php echo TBL_REGISTERED_BY; ?></th>
				<th style="text-align: center;"><?php echo TBL_UPDATED_BY; ?></th>
				<th style="text-align: center;"><?php echo TBL_ACTION; ?></th>
			</tr>
		</thead>
		<tbody>
<?php

		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

		if ($number_of_pages > 0)
		{
			while ($data = mysqli_fetch_array($result))
			{
				$shipment_type = $data['shipment_type_name'];
?>
				<tr>
					<td><center><?php echo $lp; ?></center></td>
					<td><input type="checkbox" name="chk[]" class="checkbox" value="<?php echo $data["shipment_id"]; ?>" /></td>
					<td><center><?php echo $data['date_sent']; ?></center></td>
					<td><center><?php echo $data['recipient']; ?></center></td>
					<td><center><?php echo $data['recipient_address']; ?></center></td>
					<td><center><?php echo $data['body_sent_correspondence']; ?></center></td>
					<!-- <td><center><?php //echo $data['shipment_type_name']; ?></center></td> -->
					<td><center><?php echo constant($shipment_type); ?></center></td>
					<td><center><?php echo $data['registered_by']; ?></center></td>
					<td><center><?php if ($data['updated_by_id'] != 0) { echo $data['updated_by']; } else { echo "-"; } ?></center></td>
					<td>
						<a href="shipments.php?shipments=all&action=edit&record=true&shipment_id=<?php echo $data['shipment_id']; ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;</a>
						<a href="shipments.php?shipments=all&action=delete&record=true&shipment_id=<?php echo $data['shipment_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo TXT_ARE_YOU_SURE; ?>')"><span class="glyphicon glyphicon-trash"></span>&nbsp;</a>
					</td>
				</tr>
			<?php
				$lp++;
			}

		?>
			<tr>
				<td></td>
				<td colspan="100%">
				<label><input type="checkbox" class="select-all"/>&nbsp;&nbsp;<?php echo TXT_SELECT; ?> / <?php echo TXT_DESELECT; ?></label>
				<label style="margin-left:50px;">
					<span style="word-spacing:normal;"><?php echo TXT_SELECTED; ?>:&nbsp;</span>
					<a href="javascript:void(0);" class="btn btn-warning btn-sm" onclick="edit_records();"><span class="glyphicon glyphicon-pencil"></span>&nbsp;<?php echo BTN_EDIT; ?></a>
					<a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_records();"><span class="glyphicon glyphicon-trash"></span>&nbsp;<?php echo BTN_DELETE; ?></a>
				</label>
				</td>
			</tr>
		<?php
		}
		else
		{
		?>
			<tr>
				<td colspan="100%" align="center"><?php echo TBL_NO_RESULTS; ?></td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</form>
</div>
</div>
<?php
	echo $pagination;

	if (empty($error) === false)
	{
		echo '
			<div class="form-group">
				<span class="text-danger">
				'.error_message($error).'
				</span>
			</div>';
	}
	else if (empty($success) === false)
	{
		echo '
			<div class="form-group">
				<span class="text-danger">
				'.success_message($success).'
				</span>
			</div>';
	}

require_once 'inc/overall/footer.php';
?>
