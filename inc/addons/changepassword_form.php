
	<h1 class="page-header"><?php echo TXT_CHANGE_PASSWORD; if (empty($user_data['login']) === false) { echo " - ".$user_data['login']; } ?></h1>

	<div class="row">

		<!-- edit form column -->
		<div class="col-md-8 col-sm-6 col-xs-12 personal-info">

			<!-- Alert -->
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

				<div class="tab-content">

					<div class="form-group">
						<label class="col-md-3 control-label" for="current_password"><?php echo TXT_CURRENT_PASSWORD; ?>*</label>
						<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-lock"></span>
							</div>
							<input class="form-control input-md" type="password" id="current_password" placeholder=" <?php echo TXT_CURRENT_PASSWORD; ?> " name="current_password"/>
						</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" for="password"><?php echo TXT_NEW_PASSWORD; ?>*</label>
						<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-lock"></span>
							</div>
							<input class="form-control input-md" type="password" id="password" placeholder=" <?php echo TXT_NEW_PASSWORD; ?> " name="password"/>
						</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" for="repeat_password"><?php echo TXT_REPEAT_PASSWORD; ?>*</label>
						<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-lock"></span>
							</div>
							<input class="form-control input-md" type="password" id="repeat_password" placeholder=" <?php echo TXT_REPEAT_PASSWORD; ?> " name="repeat_password"/>
						</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">

							<button class="btn btn-success" data-toggle="tooltip" type="submit" onclick="<?php echo $_SERVER['PHP_SELF'].'?login='.$user_data['login']; ?>" name="cmdSubmit">
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
