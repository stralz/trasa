<?php
	include 'dbh.php';
	
	if(isset($_POST['komplet'])) {
		$komplet = $conn->escape_string($_POST['komplet']);
		
		$sql = "SELECT procenat FROM sleperi_vozaci INNER JOIN kompleti ON (sleperi_vozaci.fk_komplet=kompleti.id) INNER JOIN vozaci ON (sleperi_vozaci.fk_vozac=vozaci.id) WHERE broj=$komplet";
		
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo $row['procenat'];
		}	}
	
	if(isset($_POST['komplet']) && isset($_POST['pomocni']) && isset($_POST['faktura1']) && isset($_POST['faktura2'])) {
		$komplet = $conn->escape_string($_POST['komplet']);
		$faktura1 = $conn->escape_string($_POST['faktura1']);
		$faktura2 = $conn->escape_string($_POST['faktura2']);
		$sql = "SELECT ime, prezime, tegljaci.broj_registracije AS \"tbroj\", tegljaci.marka AS \"tmarka\", prikolice.broj_registracije AS \"pbroj\" FROM sleperi_vozaci INNER JOIN kompleti ON (sleperi_vozaci.fk_komplet=kompleti.id) INNER JOIN vozaci ON (sleperi_vozaci.fk_vozac=vozaci.id) INNER JOIN tegljaci ON (kompleti.fk_tegljac=tegljaci.id) INNER JOIN prikolice ON (kompleti.fk_prikolica=prikolice.id) WHERE broj=$komplet";
		
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo "{" . $row['ime'] . "{" . $row['prezime'] . "{" . $row['tbroj'] . "{" . $row['tmarka'] . "{" . $row['pbroj'];
		}
		
		$od1 = "";
		$do1 = "";
		$sql = "SELECT od1, do1 FROM fakture WHERE komplet_racun_broj='" . $faktura1. "'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$od1 = $row['od1'];
			$do1 = $row['do1'];
		}
		
		$od2 = "";
		$do2 = "";
		$sql = "SELECT od1, do1 FROM fakture WHERE komplet_racun_broj='" . $faktura2 . "'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$od2 = $row['od1'];
			$do2 = $row['do1'];
		}
		
		echo "{" . $od1 . "{" . $do1 . "{" . $do2;
	}

	if(isset($_POST['komplet']) && isset($_POST['pomocni']) && isset($_POST['faktura1']) && !isset($_POST['faktura2'])) {
		$komplet = $conn->escape_string($_POST['komplet']);
		$faktura1 = $conn->escape_string($_POST['faktura1']);
		$sql = "SELECT ime, prezime, tegljaci.broj_registracije AS \"tbroj\", tegljaci.marka AS \"tmarka\", prikolice.broj_registracije AS \"pbroj\" FROM sleperi_vozaci INNER JOIN kompleti ON (sleperi_vozaci.fk_komplet=kompleti.id) INNER JOIN vozaci ON (sleperi_vozaci.fk_vozac=vozaci.id) INNER JOIN tegljaci ON (kompleti.fk_tegljac=tegljaci.id) INNER JOIN prikolice ON (kompleti.fk_prikolica=prikolice.id) WHERE broj=$komplet";
		
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo "{" . $row['ime'] . "{" . $row['prezime'] . "{" . $row['tbroj'] . "{" . $row['tmarka'] . "{" . $row['pbroj'];
		}
		
		$od1 = "";
		$do1 = "";
		$drzava1 = "";
		$drzava2 = "";
		
		$sql = "SELECT od1, do1 FROM fakture WHERE komplet_racun_broj='" . $faktura1. "'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$od1 = $row['od1'];
			$do1 = $row['do1'];
		}
		
		echo "{" . $od1 . "{" . $do1;
		
		$sql = "SELECT drzava FROM gradovi WHERE ime='" . $od1 . "'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$drzava1 = $row['drzava'];
		}
		
		$sql = "SELECT drzava FROM gradovi WHERE ime='" . $do1 . "'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$drzava2 = $row['drzava'];
		}
		
		echo "{" . $drzava1 . "{" . $drzava2;
	}
	
?>