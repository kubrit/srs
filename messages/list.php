<?php

$conversations = get_conversations_sum();

?>
<div class="row">
	<div class="panel panel-default">
        <div class="panel-heading"><?php echo TXT_YOUR_MESSAGES; ?></div>
        <div class="panel-body">
			<div class="btn-group pull-right" role="group" aria-label="...">
				<button class="btn btn-sm btn-default" data-original-title="Message" data-toggle="tooltip" type="button" onclick="<?php echo "location.href='messages.php?messages=list&action=new'";?>" name="cmdMsg"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<?php echo TXT_NEW_MESSAGE; ?></button>
			</div>
        </div>

		<div class="table-responsive">

			<table class="table table-hover table-sm table-responsive">
				<thead>
					<tr class="info">
						<th><?php echo TBL_NUMERO; ?></th>
						<th><?php echo TBL_SENDER; ?></th>
						<th><?php echo TBL_SUBJECT; ?></th>
						<th><?php echo TBL_LAST_UPDATE; ?></th>
						<th><center><?php echo TBL_STATUS; ?></center></th>
						<th><?php echo TBL_ACTION; ?></th>
					</tr>
				</thead>
				<tbody>
	<?php
	$No=1;
	foreach ($conversations as $conversation) {
	?>
					<tr>
						<td><?php echo $No++; ?></td>
						<td>
							<?php
							$array_sender = get_conversation_author($conversation['id']);

							if ($array_sender === false) {
									$error[] = ERR_ERROR;
							} else {
								foreach ($array_sender as $sender) {
									if ($sender['sender_id'] == $user_data['user_id']) {
										echo TBL_ME;
									} else {
										echo $sender['sender'];
									}
								}
							}

							?>
						</td>
						<td><a href="messages.php?messages=list&amp;action=preview&conversation_id=<?php echo $conversation['id']; ?>"><?php echo $conversation['subject']; ?></a></td>
						<td><?php echo time_has_passed(date('Y-m-d H:i:s', $conversation['last_answer'])); ?></td>
						<td align="center">
						<?php
						if ($conversation['unread_messages']) {
						?>
							<a href="messages.php?messages=list&amp;action=preview&conversation_id=<?php echo $conversation['id']; ?>" class="btn btn-info btn-sm">&nbsp;<?php echo TBL_NEW; ?></a>
						<?php
						} else {
							echo '-';
						}
						?>
						</td>
						<td><a href="messages.php?messages=list&amp;action=delete&amp;conversation_id=<?php echo $conversation['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo TXT_ARE_YOU_SURE; ?>')"><span class="glyphicon glyphicon-trash"></span></a></td>

					</tr>
	<?php
	}
					if (empty($conversations)) {
						echo '<tr><td colspan="100%" align="center"><i>'.TXT_CHANGE_PHOTO.'</i></td></tr>';
					}
	?>
				</tbody>
			</table>
		</div>
	</div>
</div>
