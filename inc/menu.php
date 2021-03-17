<nav class="navbar navbar-inverse navbar-static-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<span class="navbar-brand"></span>
		</div>

		<!-- Collect the nav menu_links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-left">
				<li><a href="home.php"><span class="glyphicon glyphicon-home"></span>&nbsp;<?php echo MENU_HOME; ?><span class="sr-only">(current)</span></a></li>
				<li><a href="shipments.php?shipments=all"><span class="glyphicon glyphicon-th-list"></span>&nbsp;<?php echo MENU_SHIPMENTS; ?></a></li>
				<li><a href="contact.php"><span class="glyphicon glyphicon-phone"></span>&nbsp;<?php echo MENU_CONTACT; ?></a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="messages.php?messages=list"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<?php echo MENU_MESSAGES; ?>&nbsp;<span class="how_many_messages">-</span></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $user_data['login']; ?>&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $user_data['login']; ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo MENU_PROFILE; ?></a></li>
						<li role="separator" class="divider"></li>
						<li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;<?php echo MENU_SETTINGS; ?></a></li>
						<li><a href="changepassword.php"><span class="glyphicon glyphicon-lock"></span>&nbsp;<?php echo MENU_CHANGE_PASSWORD; ?></a></li>
						<li><a href="https://github.com/gmbroker-hq/srs"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<?php echo MENU_SUPPORT; ?></a></li>
						<?php
						/*if($user_data['type'] == 'Super-Administrator') { ?>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Administrator</li>
						<li><a href="users.php" class="dropdown-item"><span class="glyphicon glyphicon-user"></span>&nbsp;Users</a></li>
						<?php }*/
						?>
						<li role="separator" class="divider"></li>
						<li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<?php echo MENU_LOGOUT; ?></a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
