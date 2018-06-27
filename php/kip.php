<?php 
	include "dbh.php";
	
	if(isset($_POST['faktura']) && isset($_POST['pocKm']) && isset($_POST['zavKm']) && isset($_POST['potrosnja'])) {
		$pocKm = $conn->escape_string($_POST['pocKm']);
		$zavKm = $conn->escape_string($_POST['zavKm']);
		$potrosnja = $conn->escape_string($_POST['potrosnja']);
		$faktura = $conn->escape_string($_POST['faktura']);
		
		$idFakture = 0;
		
		$sql = "SELECT id FROM fakture WHERE komplet_racun_broj=\"$faktura\"";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idFakture = $row['id'];
		}
		
		$sql = "SELECT id FROM kip WHERE fk_fakture=$idFakture";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$sql = "UPDATE kip SET pocetna_kilometraza=\"$pocKm\", zavrsna_kilometraza=\"$zavKm\", potrosnja=\"$potrosnja\"
					WHERE fk_fakture=$idFakture;";
			echo $sql;
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO kip (id, fk_fakture, pocetna_kilometraza, zavrsna_kilometraza, potrosnja)
					VALUES (NULL, $idFakture, $pocKm, $zavKm, $potrosnja)";
			echo $sql;
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['faktura']) && isset($_POST['pomocni'])) {
		$faktura = $conn->escape_string($_POST['faktura']);
		
		$idFakture = 0;
		
		$sql = "SELECT id FROM fakture WHERE komplet_racun_broj=\"$faktura\"";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idFakture = $row['id'];
		}
		
		$sql = "SELECT pocetna_kilometraza, zavrsna_kilometraza, potrosnja FROM kip WHERE fk_fakture=$idFakture";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo $row['pocetna_kilometraza'] . " " . $row['zavrsna_kilometraza'] . " " . $row['potrosnja'];
		}
	}
?>