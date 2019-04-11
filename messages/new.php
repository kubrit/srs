<?php

include_once './core/init.php';

$messages = $_REQUEST['messages'];

			if (isset($_POST['recipient'], $_POST['body'], $_POST['subject'])) {

				if (empty($_POST['recipient'])) {
					$error[] = ERR_NO_RECIPIENT_SELECTED;
				} else if (preg_match('#^[a-z, ]+$#i', $_POST['recipient']) === 0) {
					$error[] = ERR_INVALID_LOGIN;
				} else {
					$logins = explode(',', $_POST['recipient']);

					foreach ($logins as &$login) {
						$login = trim($login);
					}

					$login_ids = get_users_id($logins);

					if (count($login_ids) !== count($logins)) {
						$error[] = ERR_USERS_NOT_FOUND . implode(', ', array_diff($logins, array_keys($login_ids)));
					}
				}

				if (empty($_POST['subject'])) {
					$error[] = ERR_SUBJECT_IS_EMPTY;
				}

				if (empty($_POST['body'])) {
					$error[] = ERR_BODY_IS_EMPTY;
				}

				if (empty($error)) {
					create_conversation(array_unique($login_ids), $_POST['subject'], $_POST['body']);
				}

				$success[] = SUC_MESSAGE_SENT;
			}
?>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><label for="recipient"><?php echo TXT_NEW_MESSAGE; ?></label></div>
				<div class="panel-body">

					<form method="POST" action="">

					<table class="table">
						<tbody>
							<tr>
								<th><label for="recipient"><?php echo TBL_RECIPIENT; ?></label></th>
								<td>
									<input type="text" class="form-control" name="recipient" id="recipient" placeholder=" <?php echo PLH_SENT_TO_FEW; ?>" value="<?php if (isset($_POST['recipient'])) { echo htmlentities($_POST['recipient']); } ?>" />
								</td>
							</tr>
							<tr>
								<th><label for="subject"><?php echo TBL_SUBJECT; ?></label></th>
								<td>
									<input type="text" class="form-control" name="subject" id="subject" value="<?php if (isset($_POST['subject'])) { echo htmlentities($_POST['subject']); } ?>" />
								</td>
							</tr>
							<tr>
								<th><label for="body"><?php echo TBL_MESSAGE; ?></label></th>
								<td>
								<textarea class="form-control" name="body" rows="10" cols="60" id="body"><?php if (isset($_POST['body'])) { echo htmlentities($_POST['body']); } ?></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<button type="submit" name="sentMessage" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>&nbsp;<?php echo BTN_SEND; ?></button>
									<a href="messages.php?messages=list" class="btn btn-large btn-success"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<?php echo BTN_BACK; ?></a>
								</td>
							</tr>
						</tbody>
					</table>

					</form>

				</div>
			</div>
		</div>

		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><label for="system-search"><?php echo TXT_FIND_USER; ?></label></div>
				<div class="panel-body">

				<form class="" name="search" action="" method="post">
					<div class="input-group col-md-6">
						<input type="text" class="form-control" name="input" id="system-search" value="<?php if (isset($_POST['input'])) { echo htmlentities($_POST['input']); } ?>" placeholder=" <?php echo PLH_SEARCH_FOR_USER; ?> " />
						<span class="input-group-btn">
							<input class="btn btn-primary" type="submit" name="search" value="<?php echo BTN_SEARCH; ?>" />
						</span>
					</div>
				</form>

				<?php

				if(!empty($_POST['search'])){

					$users = find_user(htmlspecialchars(strip_tags($_POST['input'])));

				?>

				<table class="table table-striped">
					<thead>
						<tr>
							<th><?php echo TBL_LOGIN; ?></th>
							<th><?php echo TBL_FIRST_NAME; ?></th>
							<th><?php echo TBL_LAST_NAME; ?></th>
						</tr>
					</thead>
					<tbody>

					<?php

					if (is_array($users) || is_object($users)) {
						foreach ($users as $user) {
						?>
						<tr>
							<td><?php echo $user['login']; ?></td>
							<td><?php echo $user['first_name']; ?></td>
							<td><?php echo $user['last_name']; ?></td>
						</tr>
						<?php
						}
					}
					?>

					</tbody>
				</table>
				<?php
				}
				?>
				</div>
			</div>
		</div>

	</div>
