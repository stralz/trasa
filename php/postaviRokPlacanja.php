<?php
	include 'dbh.php';
	header("Content-Type: application/json");
	if (!isset($_POST['ime']) || empty($_POST['ime'])) {
		die("null");
	}
	if (!isset($_POST['rok']) || empty($_POST['rok'])) {
		die("null");
	}
	$imeNalogodavca = $_POST['ime'];
	$rok_placanja = $_POST['rok'];
	
	$sql = "UPDATE nalogodavci SET `rok_placanja`=" . $rok_placanja . " WHERE `ime`='" . $conn->escape_string($imeNalogodavca);
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		echo json_encode([
			'mesto' => $row['mesto'],
			'adresa' => $row['adresa'],
			'postanski_broj' => $row['postanski_broj'],
			'pak' => $row['PAK'],
			'pib' => $row['PIB'],
			'rok_placanja' => $row['rok_placanja']
		]);
	} else {
	    echo "null";
	}
?>