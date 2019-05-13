<?php
	include 'dbh.php';

	if(isset($_POST['prvi']) && isset($_POST['avansna'])) {
		$prvi = $conn->escape_string($_POST['prvi']);
		$avansna = $conn->escape_string($_POST['avansna']);

		if ($avansna == "false") {
			$sql = "UPDATE brojevi SET prvi='$prvi'";
			$conn->query($sql);
		}
	}
?>
