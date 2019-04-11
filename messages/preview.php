<?php
$conversations = get_conversations_sum();

$conversation_validation = (isset($_GET['conversation_id']) && validate_conversation_id($_GET['conversation_id']));

if ($conversation_validation === false) {
	$error[] = ERR_INVALID_CONVERSATION_ID;
}

if (isset($_POST['message'])) {
	if (empty($_POST['message'])) {
		$error[] = ERR_INVALID_CONVERSATION_ID;
	}

	if (empty($error)) {
		add_conversation_message($_GET['conversation_id'], $_POST['message']);
	}
}

if ($conversation_validation) {
	if (isset($_POST['message'])) {
		update_last_viewed_conversation($_GET['conversation_id']);
		$messages = get_conversation_messages($_GET['conversation_id']);
	} else {
		$messages = get_conversation_messages($_GET['conversation_id']);
		update_last_viewed_conversation($_GET['conversation_id']);
	}
?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-comment"></span>&nbsp;<?php echo TXT_CONVERSATION_WITH; ?>
				<?php
				$recipient_array = get_conversation_recipients($_GET['conversation_id']);
				echo implode(', ', array_column($recipient_array, 'recipient'));
				?>
				</div>

                <div class="panel-body chat-panel-body">
                    <ul class="chat">
<?php
				foreach ($messages as $message) {
					if ($message['sender_id'] == $user_data['user_id']) {
?>
                        <li class="right clearfix"><span class="chat-img pull-right">
						<?php
						if(empty($user_data['picture']) ===  false) {
							echo '<img class="img-circle img-responsive img-thumbnail" style="width:50px; height: 50px;" src="', $user_data['picture'], '" alt="'.ALT_PROFILE_PHOTO.' ', $user_data['login'], '"/>';
						} else {
							echo '<img class="img-circle img-responsive img-thumbnail" style="width:50px; height: 50px;" src="images/profile/avatar.jpg" alt="'.ALT_AVATAR.'"/>';
						}
						?>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo time_has_passed(date('Y-m-d H:i:s', $message['date'])); ?>&nbsp;<?php if ($message['unread']) { echo "<b><i>".TXT_NEW."</i></b>"; } ?></small>
                                    <strong class="pull-right primary-font"><?php echo TXT_ME; ?></strong>
                                </div>
                                <p>
                                    <?php echo $message['body']; ?>
                                </p>
                            </div>
                        </li>

					<?php
					} else if ($message['sender_id'] != $user_data['user_id']) {
					?>
                        <li class="left clearfix"><span class="chat-img pull-left">
						<?php
						if(empty($message['picture']) ===  false) {
							echo '<img class="img-circle img-responsive img-thumbnail" style="width:50px; height: 50px;" src="', $message['picture'], '" alt="'.ALT_PROFILE_PHOTO.' ', $message['sender'], '"/>';
						} else {
							echo '<img class="img-circle img-responsive img-thumbnail" style="width:50px; height: 50px;" src="images/profile/avatar.jpg" alt="'.ALT_AVATAR.'"/>';
						}
						?>

                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo $message['sender']; ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span> <?php echo time_has_passed(date('Y-m-d H:i:s', $message['date'])); ?>&nbsp;<?php if ($message['unread']) { echo "<b><i>".TXT_NEW."</i></b>"; } ?></small>
                                </div>
                                <p>
                                    <?php echo $message['body']; ?>
                                </p>
                            </div>
                        </li>
						<?php
					}
				}
?>
                    </ul>
                </div>

                <div class="panel-footer">
					<form action="" method="post">
						<div class="input-group">
							<input id="btn-input" type="text" class="form-control input-sm" name="message" placeholder=" <?php echo PLH_ANSWER_HERE; ?> " />
							<span class="input-group-btn">
								<button type="submit" class="btn btn-warning btn-sm" id="btn-chat"><?php echo BTN_SEND; ?></button>
							</span>
						</div>
					</form>
                </div>

            </div>
        </div>
    </div>
<?php
}
?>
