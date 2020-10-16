<?php
	include 'dbh.php';
	header("Content-Type: application/json");

	if (isset($_POST['ime'])) {
		$imeNalogodavca = $conn->escape_string($_POST['ime']);

		$sql = "SELECT mesto, adresa, postanski_broj, PAK, PIB, rok_placanja FROM nalogodavci WHERE ime LIKE('$imeNalogodavca')";
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
	}

	if (isset($_POST['rok']) || !empty($_POST['rok'])) {
		$rokk = $conn->escape_string($_POST['rok']);
		$imeNalogodavca = $conn->escape_string($_POST['ime']);

		$sql = "UPDATE nalogodavci SET rok_placanja = '$rokk' WHERE ime LIKE('$imeNalogodavca')";
		$conn->query($sql);
	}

	if(isset($_POST['broj']) && !isset($_POST['tegljac_id']) && !isset($_POST['prikolica_id'])) {
		$broj = $conn->escape_string($_POST['broj']);

		$sql = "SELECT tegljaci.broj_registracije AS 'tegljac_broj_registracije', tegljaci.id AS 'tegljac_id',
				prikolice.broj_registracije AS 'prikolica_broj_registracije', prikolice.id AS 'prikolica_id'
				FROM tegljaci INNER JOIN kompleti
				ON tegljaci.id = kompleti.fk_tegljac
				INNER JOIN prikolice
				ON prikolice.id = kompleti.fk_prikolica
				WHERE kompleti.broj =" . $broj . ";";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo json_encode([
				'tegljac_broj_registracije' => $row['tegljac_broj_registracije'],
				'prikolica_broj_registracije' => $row['prikolica_broj_registracije'],
				'tegljac_id' => $row['tegljac_id'],
				'prikolica_id' => $row['prikolica_id']
			]);
		}
	}

	if(isset($_POST['komplet_broj']) && isset($_POST['tegljac_id']) && isset($_POST['prikolica_id'])) {
		$komplet_broj = $conn->escape_string($_POST['komplet_broj']);
		$tegljac_id = $conn->escape_string($_POST['tegljac_id']);
		$prikolica_id = $conn->escape_string($_POST['prikolica_id']);

		if($tegljac_id != 0 && $prikolica_id != 0) {
			$sql = "SELECT tegljaci.broj_registracije AS 'tegljac_broj_registracije', tegljaci.id AS 'tegljac_id',
				prikolice.broj_registracije AS 'prikolica_broj_registracije', prikolice.id AS 'prikolica_id'
				FROM tegljaci INNER JOIN kompleti
				ON tegljaci.id = kompleti.fk_tegljac
				INNER JOIN prikolice
				ON prikolice.id = kompleti.fk_prikolica
				WHERE kompleti.broj ='$komplet_broj'
				AND kompleti.fk_tegljac=$tegljac_id
				AND kompleti.fk_prikolica=$prikolica_id";
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				$row = $result->fetch_assoc();
			} else {
				$sql = "UPDATE kompleti SET fk_tegljac= $tegljac_id, fk_prikolica='$prikolica_id' WHERE kompleti.broj='$komplet_broj';";
				$conn->query($sql);
			}
		}
	}
?>
