<?php 
echo "</div>";

	if (logged_in() === false) {

		require_once 'inc/footer.php';
	}

echo "</body>";
echo "</html>";

ob_end_flush();
?>