<head>
	<meta http-equiv="Content-Language" content="en" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="author" content="Bogumił Kraszewski" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SRS<?php if (isset($user_data['type'])) { echo ' - '.$user_data['type']; }?></title>

	<link href="Favorites.ico" rel="shortcut icon" />
	<!-- CSS -->
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="css/chat.css" rel="stylesheet" type="text/css" />
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen" />
	<link href="bootstrap/css/bootstrap-font-awesome.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-chosen.css" rel="Stylesheet"></link>
	<link href="bootstrap/css/bootstrap-datepicker.min.css" rel="stylesheet">

	<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!--<script src="bootstrap/js/jquery-1.12.4.js"></script>-->
	<!-- Include all complied plugins (below), or include indiviudal files as needed -->
	<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<!--<script src="bootstrap/js/bootstrap-typeahead.min.js" type="text/javascript"></script>-->
	<script src="bootstrap/js/bootstrap-active-menu.js"></script>
	<script src="js/table-shipments.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<script src="bootstrap/locales/bootstrap-datepicker.pl.min.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
$(function() {

	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		startDate: '-7d',
		maxViewMode: 1,
		todayBtn: "linked",
		clearBtn: true,
		language: "pl",
		autoclose: true,
		toggleActive: true,
		todayHighlight: true
	});

	$("#recipient").typeahead({
		source: function(query, process) {
			$.ajax({
				url: 'scripts/autocomplete_recipient.php',
				type: 'POST',
				data: 'query=' + query,
				dataType: 'JSON',
				async: true,
				success: function(data) {
					process(data);
				}
			});
		}
	});
});

</script>
<?php
	if (logged_in() === true) {
?>
		<script type="text/javascript">
			/* refresh every 1 sek.*/
			//var timer = 3;
			var how_many_messages = "";
			function inTime() {
				setTimeout(inTime, 3000);

				$.post("messages/count_messages.php",{ile: how_many_messages}, function(data) {
					$(".how_many_messages").html(data);
				})

				/* Refresh time */
				/*
				if (timer==0) {
					$.post("messages/count_messages.php",{ile: how_many_messages}, function(data) {
						$(".how_many_messages").html(data);
					})
					timer = 3;
					clearTimeout(inTime);
				}
				timer--;*/
			}
			inTime();
		</script>
<?php
	}
?>
</head>
