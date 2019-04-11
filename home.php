<?php
require_once 'core/init.php';

if (logged_in() === false) {
	header("Location:index.php");
}

include_once 'inc/overall/header.php';
?>

<h3><?php echo TXT_WELCOME; ?></h3><br /><br />
<span style="font-size:22px;">
<?php echo TXT_ABOUT; ?>
</span>
<br>

<?php
include_once 'inc/overall/footer.php';
?>
