<?php
	include 'dbh.php';
	
	if(isset($_POST['red_id']) && isset($_POST['baza'])) {
		$red_id = $conn->escape_string($_POST['red_id']);
		$baza = $conn->escape_string($_POST['baza']);
		$sql = "";
		if($baza == "pregledi_prikolice") {
			$sql = "DELETE FROM " . $baza . " WHERE fk_prikolica=" . $red_id;
			$conn->query($sql);
		} elseif ($baza == "fakture") {
			$sql = "DELETE FROM fakture_gorivo WHERE fk_fakture=" . $red_id;
			$conn->query($sql);
			$sql = "DELETE FROM fakture_troskovi WHERE fk_fakture=" . $red_id;
			$conn->query($sql);
			$sql = "DELETE FROM fakture WHERE id=" . $red_id;
			$conn->query($sql);
		} elseif ($baza == "gorivo") {
			$sql = "DELETE FROM fakture_gorivo WHERE fk_gorivo=". $red_id;
			$conn->query($sql);
			$sql = "DELETE FROM gorivo WHERE id=" . $red_id;
			$conn->query($sql);
		} else {
			$sql = "DELETE FROM " . $baza . " WHERE id=" . $red_id;
			$conn->query($sql);
		}
		echo $sql;
	}
?>