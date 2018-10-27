<?php
    include 'dbh.php';

    if(isset($_POST['od1']) && isset($_POST['od1Drzava'])) {
		$od1 = $conn->escape_string($_POST['od1']);
		$od1Drzava = $conn->escape_string($_POST['od1Drzava']);

		$sql = "SELECT id FROM gradovi WHERE ime='" . $od1 . "'";
		echo "ECHO ZA UBACIVANJE GRADA: $sql <br>";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {

		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $od1 . "', '" . $od1Drzava . "')";
			$conn->query($sql);
		}
	}

	if(isset($_POST['do1']) && isset($_POST['do1Drzava'])) {
		$do1 = $conn->escape_string($_POST['do1']);
		$do1Drzava = $conn->escape_string($_POST['do1Drzava']);

		$sql = "SELECT id FROM gradovi WHERE ime='" . $do1 . "'";
		echo "ECHO ZA UBACIVANJE GRADA: $sql <br>";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {

		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $do1 . "', '" . $do1Drzava . "')";
			$conn->query($sql);
		}
	}

	if(isset($_POST['od2']) && isset($_POST['od2Drzava'])) {
		$od2 = $conn->escape_string($_POST['od2']);
		$od2Drzava = $conn->escape_string($_POST['od2Drzava']);

		$sql = "SELECT id FROM gradovi WHERE ime='" . $od2 . "'";
		echo "ECHO ZA UBACIVANJE GRADA: $sql <br>";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {

		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $od2 . "', '" . $od2Drzava . "')";
			$conn->query($sql);
		}
	}

	if(isset($_POST['do2']) && isset($_POST['do2Drzava'])) {
		$do2 = $conn->escape_string($_POST['do2']);
		$do2Drzava = $conn->escape_string($_POST['do2Drzava']);

		$sql = "SELECT id FROM gradovi WHERE ime='" . $do2 . "'";
		echo "ECHO ZA UBACIVANJE GRADA: $sql <br>";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {

		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $do2 . "', '" . $do2Drzava . "')";
			$conn->query($sql);
		}
	}
?>
