<div class="signin-form">
	<form class="form-signin" method="post" id="login-form" action="">

		<h2 class="form-signin-heading">Login</h2><hr />

		<div class="form-group">
			 <div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="text" name="login" class="form-control" placeholder=" <?php echo PLH_ENTER_LOGIN; ?> " maxlength="32" />
				<span id="check-e"></span>
			</div>
		</div>

		<div class="form-group">
			 <div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
				<input type="password" name="password" class="form-control" placeholder=" <?php echo PLH_ENTER_PASSWORD; ?> " maxlength="32" />
			</div>
		</div>

		<hr />

		<div class="form-group">
			<a href="register.php" class="btn btn-default"><?php echo BTN_CREATE_ACCOUNT; ?></a>
			<button type="submit" class="btn btn-default" style="float:right;" name="btn-login" id="btn-login"><span class="glyphicon glyphicon-log-in"></span> &nbsp;<?php echo BTN_LOG_IN; ?></button>
		</div>

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
	</form>
</div>
