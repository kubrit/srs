<?php
require_once 'core/init.php';
protected_page();
$shipments = isset($_REQUEST['shipments']) ? $_REQUEST['shipments'] : '';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

	if (empty($shipments == 'all') === false)
	{
		unset($_SESSION['received']);
		unset($_SESSION['sent']);
		$received = isset($_POST['received']) ? $_POST['received'] : '0';
		$sent = isset($_REQUEST['sent']) ? $_REQUEST['sent'] : '0';
		$_SESSION['sent'] = $sent;
		$_SESSION['received'] = $received;

		if (!empty($action))
		{
			if ($action == 'delete')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='delete';
				include 'shipments/delete.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'update')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='update';
				include 'shipments/update.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'edit')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='edit';
				include 'shipments/edit.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'new')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='new';
				include 'shipments/new.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'create')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='create';
				include 'shipments/create.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'csv')
			{
				$_SESSION['action']='csv';
				include 'shipments/export.php';
			}
			else if ($action == 'pdf')
			{
				$_SESSION['action']='pdf';
				include 'shipments/export.php';
			}
		} else {
			require_once 'inc/overall/header.php';
			$_SESSION['action']='all';
			include 'shipments/all.php';
			require_once 'inc/overall/footer.php';
		}
	}
	else if (empty($shipments == 'sent') === false)
	{
		unset($_SESSION['received']);
		$sent = isset($_REQUEST['sent']) ? $_REQUEST['sent'] : '1';
		$received = isset($_POST['received']) ? $_POST['received'] : '0';
		$_SESSION['sent'] = $sent;

		if (!empty($action))
		{
			if ($action == 'delete')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='delete';
				include 'shipments/delete.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'update')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='update';
				include 'shipments/update.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'edit')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='edit';
				include 'shipments/edit.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'new')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='new';
				include 'shipments/new.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'create')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='create';
				include 'shipments/create.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'csv')
			{
				$_SESSION['action']='csv';
				include 'shipments/export.php';
			}
			else if ($action == 'pdf')
			{
				$_SESSION['action']='pdf';
				include 'shipments/export.php';
			}
		} else {
			require_once 'inc/overall/header.php';
			$_SESSION['action']='all';
			include 'shipments/all.php';
			require_once 'inc/overall/footer.php';
		}
	}
	else if (empty($shipments == 'received') === false)
	{
		unset($_SESSION['sent']);
		$received = isset($_POST['received']) ? $_POST['received'] : '1';
		$sent = isset($_POST['sent']) ? $_POST['sent'] : '0';
		$_SESSION['received'] = $received;

		if (!empty($action))
		{
			if ($action == 'delete')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='delete';
				include 'shipments/delete.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'update')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='update';
				include 'shipments/update.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'edit')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='edit';
				include 'shipments/edit.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'new')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='new';
				include 'shipments/new.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'create')
			{
				require_once 'inc/overall/header.php';
				$_SESSION['action']='create';
				include 'shipments/create.php';
				require_once 'inc/overall/footer.php';
			}
			else if ($action == 'csv')
			{
				$_SESSION['action']='csv';
				include 'shipments/export.php';
			}
			else if ($action == 'pdf')
			{
				$_SESSION['action']='pdf';
				include 'shipments/export.php';
			}
		} else {
			require_once 'inc/overall/header.php';
			$_SESSION['action']='all';
			include 'shipments/all.php';
			require_once 'inc/overall/footer.php';
		}
	}
	/*else
	{
		$error[] = ERR_UNKNOWN_URL;
	}
	*/

	if (empty($error) === false) {
		require_once 'inc/overall/header.php';
		echo error_message($error);
		require_once 'inc/overall/footer.php';
	} else if (empty($success) === false) {
		require_once 'inc/overall/header.php';
		echo success_message($success);
		require_once 'inc/overall/footer.php';
	}

?>
