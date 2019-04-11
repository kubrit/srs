<h1 class="page-header"><?php echo TXT_SETTINGS; if (empty($user_data['login']) === false) { echo " - ".$user_data['login']; } ?></h1>
<div class="row">

	<div class="col-md-4 col-sm-6 col-xs-12" style="margin: 0 auto;">
		<div class="text-center">
			<div class="col-md-7 col-lg-7" style="width: 100%;">
				<?php
				if(empty($user_data['picture']) ===  false) {
					echo '<img class="img-circle img-responsive img-thumbnail" src="', $user_data['picture'], '" alt="'.ALT_PROFILE_PHOTO.' ', $user_data['first_name'], '"/>';
				} else {
					echo '<img class="img-circle img-responsive img-thumbnail" src="images/profile/avatar.jpg" alt="'.ALT_AVATAR.'" /><h6><label for="picture">'.TXT_SEND_ANOTHER_PHOTO.'</label></h6>';
				}
				?>
				<h6><label for="picture"><?php echo TXT_CHANGE_PHOTO; ?> <a href="<?php echo $user_data['login']; ?>"><?php echo TXT_HERE; ?></a></label></h6>
			</div>
		</div>
	</div>

	<div class="col-md-8 col-sm-6 col-xs-12 personal-info">

		<div class="form-group">
			<span class="text-danger">
			<?php
			if (empty($error) === false) {
				echo error_message($error);
			} else if (empty($success) === false) {
				echo success_message($success);
			}
			?>
			</span>
		</div>

		<form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

			<div class="panel-heading"><?php echo TXT_PERSONAL_INFORMATION; ?></div>
			<div class="panel-body">

				<div class="form-group">
					<label class="col-md-3 control-label" for="login"><?php echo TXT_LOGIN; ?></label>
					<div class="col-md-9">
					<div class="input-group">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-user"></span>
						</div>
						<input class="form-control input-md" type="text" id="login" name="login" placeholder=" <?php echo TXT_LOGIN; ?> " disabled value="<?php echo $user_data['login']; ?>" />
					</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="first_name"><?php echo TXT_FIRST_NAME; ?>*</label>
					<div class="col-md-9">
					<div class="input-group">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-user"></span>
						</div>
						<input class="form-control input-md" type="text" id="first_name" name="first_name" placeholder=" <?php echo TXT_FIRST_NAME; ?> " value="<?php echo $user_data['first_name']; ?>" />
					</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="last_name"><?php echo TXT_LAST_NAME; ?></label>
					<div class="col-md-9">
					<div class="input-group">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-user"></span>
						</div>
						<input class="form-control input-md" type="text" id="last_name" name="last_name" placeholder=" <?php echo TXT_LAST_NAME; ?> " value="<?php echo $user_data['last_name']; ?>" />
					</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="email"><?php echo TXT_EMAIL; ?>*</label>
					<div class="col-md-9">
					<div class="input-group">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-envelope"></span>
						</div>
						<input class="form-control input-md" type="text" id="email" name="email" placeholder=" <?php echo TXT_EMAIL; ?> " value="<?php echo $user_data['email']; ?>" />
					</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="cellphone_number"><?php echo TXT_CELLPHONE; ?></label>
					<div class="col-md-9">
					<div class="input-group">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-phone"></span>
						</div>
						<input class="form-control input-md" type="text" id="cellphone_number" name="cellphone" placeholder=" <?php echo TXT_CELLPHONE; ?> " value="<?php echo $user_data['cellphone']; ?>"/>
					</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="landline_phone_number"><?php echo TXT_LANDLINE_PHONE; ?></label>
					<div class="col-md-9">

						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-earphone"></span>
							</div>
							<input class="form-control input-md" type="text" id="landline_phone_number" name="landline_phone"  placeholder=" <?php echo TXT_LANDLINE_PHONE; ?> " value="<?php echo $user_data['landline_phone']; ?>"/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="company_id"><?php echo TXT_COMPANY; ?></label>
					<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-briefcase"></span>
							</div>
							<?php
							$query = "SELECT company_id, company_name FROM ".$t_companies." ORDER BY company_id";
							$result = mysqli_query ($connect, $query);
							echo "<select class='form-control' id='company_id' name='company_id'>";
							echo "<option value='company_id' disabled selected style='display:none;'>".TXT_CHOOSE."</option>";
							while($row = mysqli_fetch_array($result)) {
								echo "<option value='$row[company_id]' ". ($user_data['company_id'] == "$row[company_id]" ? 'selected="selected"' : "")." >$row[company_name]</option>";
							}
							echo "</select>";
							unset($query);
							unset($result);
							?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for="language"><?php echo TXT_LANGUAGE; ?></label>
					<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-flag"></span>
							</div>
							<select class='form-control' name="language" id="language">
									<?php foreach (getAvailableLanguages() as $lang => $name): ?>
											<option value="<?= $lang; ?>"<?php if (isset($_COOKIE["language"]) && $_COOKIE["language"] == $lang) { echo " selected"; } ?>><?= $name; ?></option>-
									<?php endforeach; ?>
					    </select>
							<?php
							// $query = "SHOW COLUMNS FROM ".$t_users." WHERE FIELD='language'";
							// $result = mysqli_query ($connect, $query);
							// echo "<select class='form-control' id='language' name='language'>";
							// echo "<option value='language' disabled selected style='display:none;'>".TXT_CHOOSE."</option>";
							// while($row = mysqli_fetch_array($result)) {
							//     foreach(explode("','",substr($row[1],6,-2)) as $option) {
							//         echo "<option value='$option' ". ($user_data['language'] == "$option" ? 'selected="selected"' : "")." >$option</option>";
							//     }
							// }
							// echo "</select>";
							// unset($query);
							// unset($result);
							?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label" for=""></label>
					<div class="col-md-6">
						<div class="checkbox">
							<label for="allow_email">
								<input type="checkbox" id="allow_email" name="allow_email" <?php if ($user_data['allow_email'] == 1) { echo 'checked="checked"'; } ?> />
								&nbsp;<?php echo TXT_RECEIVE_IMPORTANT_INFORMATION; ?>
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">

						<button class="btn btn-success" data-toggle="tooltip" type="submit" onclick="<?php echo $_SERVER['PHP_SELF']; ?>" name="cmdSubmit">
							<span class="glyphicon glyphicon-save"></span>&nbsp;<?php echo BTN_SAVE; ?>
						</button>
						<span></span>
						<button class="btn btn-default" data-toggle="tooltip" type="reset" name="cmdReset">
							<span class="glyphicon glyphicon-erase"></span>&nbsp;<?php echo BTN_CANCEL; ?>
						</button>

					</div>
				</div>
			</div>
		</form>
	</div>
</div>
