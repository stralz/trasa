<?php
	include 'dbh.php';
	
	if (!isset($_POST['vrednost'])) {
		die("null");
	}
	if (!isset($_POST['kolona'])) {
		die("null");
	}
	if (!isset($_POST['id_entiteta'])) {
		die("null");
	}if (!isset($_POST['baza'])) {
		die("null");
	}
	
	$vrednost = $conn->escape_string($_POST['vrednost']);
	$kolona = $conn->escape_string($_POST['kolona']);
	$id_entiteta = $conn->escape_string($_POST['id_entiteta']);
	$baza = $conn->escape_string($_POST['baza']);
	
	$sql = "UPDATE " . $baza . " SET `" . $kolona .
	"`=\"" . $vrednost . "\" WHERE `id`=" . $id_entiteta . ";";
	
	$conn->query($sql);
?>