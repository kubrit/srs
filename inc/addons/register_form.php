	<div class="signin-form">

		<form class="form-signin" method="post" action="">

        <h2 class="form-signin-heading"><?php echo TXT_SIGN_UP; ?></h2><hr />

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>&nbsp;*</span>
				<input type="text" class="form-control" placeholder=" <?php echo PLH_LOGIN; ?> " name="login" maxlength="32" />
			</div>
		</div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="text" class="form-control" placeholder=" <?php echo PLH_FIRST_NAME; ?> " name="first_name" maxlength="55" />
			</div>
		</div>

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="text" class="form-control" placeholder=" <?php echo PLH_LAST_NAME; ?> " name="last_name" maxlength="80" />
			</div>
		</div>

        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>&nbsp;*</span>
				<input type="email" class="form-control" placeholder=" <?php echo PLH_EMAIL; ?> " name="email" maxlength="200" />
				<span id="check-e"></span>
			</div>
		</div>

        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>&nbsp;*</span>
				<input type="password" class="form-control" placeholder=" <?php echo PLH_PASSWORD; ?> " name="password" maxlength="32" />
			</div>
		</div>

        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>&nbsp;*</span>
				<input type="password" class="form-control" placeholder=" <?php echo PLH_REPEAT_PASSWORD; ?> " name="repeat_password" maxlength="32" />
			</div>
		</div>

     	<hr />

        <div class="form-group">
			<button type="submit" class="btn btn-default" name="btn-register">&nbsp;<?php echo BTN_CREATE; ?></button>
            <a href="index.php" class="btn btn-default" style="float:right;"><span class="glyphicon glyphicon-log-in"></span>&nbsp;<?php echo BTN_LOG_IN_PAGE; ?></a>
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
