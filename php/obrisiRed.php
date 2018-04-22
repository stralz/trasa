<?php
	include 'dbh.php';
	
	if(isset($_POST['red_id']) && isset($_POST['baza'])) {
		$red_id = $conn->escape_string($_POST['red_id']);
		$baza = $conn->escape_string($_POST['baza']);
		
		$sql = "DELETE FROM " . $baza . " WHERE id=" . $red_id;
		$conn->query($sql);
	}
?>