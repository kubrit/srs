<?php
require_once 'core/init.php';
protected_page();
require_once 'inc/overall/header.php';

if(isset($_GET['login']) === true && empty($_GET['login']) === false) {
	$login = $_GET['login'];

	if (user_exists($login) === true) {
		$user_id = user_id_from_login($login);
		$data_profile = user_data($user_id, 'login', 'first_name', 'last_name', 'email', 'picture');
?>
	<style>
		.othertop{margin-top:10px;}
	</style>

	<h1 class="page-header"><?php echo TXT_PROFILE; if (empty($data_profile['login']) === false) { echo " - ".$data_profile['login']; } ?></h1>

	<div class="row">

		<div class="col-md-4 col-sm-6 col-xs-12 panel-default" style="margin: 0 auto;">
			<div class="text-center">
				<div class="col-md-7 col-lg-7" style="width: 100%;">
					<?php
					if (isset($_FILES['picture']) === true) {

						if (empty($_FILES['picture']['name']) === true) {

							$error[] = ERR_CHOOSE_FILE;

						} else {

							/*
							if (profile_photo_exists($session_user_id, $data_profile['picture']) === true && is_file($data_profile['picture']) == 1) {
								unlink($data_profile['picture']);
							}
							*/

							$allowed = array('jpg', 'jpeg', 'png', 'gif');
							$file_name = $_FILES['picture']['name'];
							$file_ext_temp = explode('.', $file_name);
							$file_ext = strtolower(end($file_ext_temp));
							$file_temp = $_FILES['picture']['tmp_name'];

							if (in_array($file_ext, $allowed) === true) {
								change_profile_photo($session_user_id, $file_temp, $file_ext);
								$success[] = SUC_PHOTO_UPLOADED;
							} else {
								$error[] = ERR_INVALID_TYPE.'<br>'. implode(', ', $allowed);
							}
						}
					}


					if(empty($user_data['picture']) ===  false) {
						echo '<img class="img-circle img-responsive img-thumbnail" src="', $user_data['picture'], '" alt="'.ALT_PROFILE_PHOTO.' ', $user_data['login'], '"/>';
					} else {
						echo '<img class="img-circle img-responsive img-thumbnail" src="images/profile/avatar.jpg" alt="'.ALT_AVATAR.'" /><h6><label for="picture">'.TXT_SEND_ANOTHER_PHOTO.'</label></h6>';
					}
					?>

				</div>

				<form class="form-horizontal"  action="" method="POST" enctype="multipart/form-data">
					<input type="file" class="text-center input-file center-block well well-sm" id="picture" name="picture"/>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-3 col-lg-3" style="width: 100%;">

							<button class="btn btn-success" data-toggle="tooltip" type="submit" onclick="<?php echo $_SERVER['PHP_SELF'].'?login='.$user_data['login']; ?>" name="cmdSubmit">
								<span class="glyphicon glyphicon-upload"></span>&nbsp;<?php echo BTN_SEND; ?>
							</button>
							<span></span>
							<button class="btn btn-default" data-toggle="tooltip" type="reset" name="cmdReset">
								<span class="glyphicon glyphicon-erase"></span>&nbsp;<?php echo BTN_CANCEL; ?>
							</button>
						</div>
					</div>
				</form>

			</div>

		</div>

		<div class="col-md-8 col-sm-6 col-xs-12 personal-info">
			<!--
			<div class="personal-info">
				<span class="pull-right">
					<div class="btn-group">
						<button class="btn btn-sm btn-default" data-original-title="Message" data-toggle="tooltip" type="button" onclick="<?php //echo "location.href='profile.php?action=message&user_id=".$session_user_id."' ";?>" name="cmdMsg">
							<span class="glyphicon glyphicon-envelope"></span>&nbsp;Message (in build)
						</button>
						<button class="btn btn-sm btn-default" data-original-title="Export" data-toggle="tooltip" type="button" onclick="<?php //echo "location.href='profile.php?action=export&user_id=".$session_user_id."' ";?>" name="cmdExport">
							<span class="glyphicon glyphicon-export"></span>&nbsp;Export (in build)
						</button>
					</div>
				</span>
			</div>-->

			<div class="panel-heading"><?php echo TXT_PERSONAL_INFORMATION; ?></div>
			<div class="panel-body">

				<ul class="list-group">
					<li class="list-group-item">
						<label class="col-md-3">
							<span class="pull-right glyphicon glyphicon-user"></span>
							&nbsp;<?php echo TXT_LOGIN; ?>
						</label>
						<?php
						if (empty($user_data['login']) === false) { echo $user_data['login']; } else { echo "-"; }
						?>
					</li>
					<li class="list-group-item">
						<label class="col-md-3">
							<span class="pull-right glyphicon glyphicon-user"></span>
							&nbsp;<?php echo TXT_FIRST_NAME; ?>
						</label>
						<?php
						if (empty($user_data['first_name']) === false) { echo $user_data['first_name']; } else { echo "-"; }
						?>
					</li>
					<li class="list-group-item">
						<label class="col-md-3">
							<span class="pull-right glyphicon glyphicon-user"></span>
							&nbsp;<?php echo TXT_LAST_NAME; ?>
						</label>
						<?php
						if (empty($user_data['last_name']) === false) { echo $user_data['last_name']; } else { echo "-"; }
						?>
					</li>
					<li class="list-group-item">
						<label class="col-md-3">
							<span class="pull-right glyphicon glyphicon-envelope"></span>
							&nbsp;<?php echo TXT_EMAIL; ?>
						</label>
						<?php
						if (empty($user_data['email']) === false) { echo $user_data['email']; } else { echo "-"; }
						?>
					</li>
					<li class="list-group-item">
						<label class="col-md-3">
							<span class="pull-right glyphicon glyphicon-earphone"></span>
							&nbsp;<?php echo TXT_LANDLINE_PHONE; ?>
						</label>
						<?php
						if (empty($user_data['landline_phone']) === false) { echo $user_data['landline_phone']; } else { echo "-"; }
						?>
					</li>
					<li class="list-group-item">
						<label class="col-md-3">
							<span class="pull-right glyphicon glyphicon-phone"></span>
							&nbsp;<?php echo TXT_CELLPHONE; ?>
						</label>
						<?php
						if (empty($user_data['cellphone']) === false) { echo $user_data['cellphone']; } else { echo "-"; }
						?>
					</li>
					<li class="list-group-item">
						<label class="col-md-3">
							<span class="pull-right glyphicon glyphicon-briefcase"></span>
							&nbsp;<?php echo TXT_COMPANY; ?>
						</label>
						<?php
						$query = "SELECT u.company_id, c.company_name FROM ".$t_companies." AS c
						JOIN ".$t_users." AS u ON c.company_id = u.company_id
						WHERE u.user_id = ".$user_data['user_id']."";
						$result = mysqli_query ($connect, $query);
						while($row = mysqli_fetch_array($result)) {
							if (empty($row['company_name']) === false) { echo $row['company_name']; } else { echo "-"; }
						}
						unset($query);
						unset($result);
						?>
					</li>
					<li class="list-group-item">
						<label class="col-md-3">
							<span class="pull-right glyphicon glyphicon-flag"></span>
							&nbsp;<?php echo TXT_LANGUAGE; ?>
						</label>
						<?php
						if (empty($_COOKIE['language']) === false) { echo $_COOKIE['language']; } else { echo "-"; }
						?>
					</li>
				</ul>
			</div>
		</div>
	</div>


<?php
	} else {
		$error[] = '<b>'.$_GET['login'].'</b> '.ERR_DOES_NOT_EXIST;
	}
} else {
	header('Location: index.php');
	exit();
}

	if (empty($error) === false) {
		echo error_message($error);

	} else if (empty($success) === false) {
		echo success_message($success);
	}

require_once 'inc/overall/footer.php';
?>
