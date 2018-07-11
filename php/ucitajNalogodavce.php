<?php
	include 'dbh.php';
	header("Content-Type: application/json");
	
	if (isset($_POST['ime'])) {
		$imeNalogodavca = $conn->escape_string($_POST['ime']);
		
		$sql = "SELECT mesto, adresa, postanski_broj, PAK, PIB, rok_placanja FROM nalogodavci WHERE `ime`='" . $imeNalogodavca . "' LIMIT 1";
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
		
		$sql = "UPDATE nalogodavci SET rok_placanja = " . $rokk . " WHERE `ime`='" . $imeNalogodavca. "'";
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
	
	if(isset($_POST['broj']) && isset($_POST['tegljac_id']) && isset($_POST['prikolica_id'])) {
		$broj = $conn->escape_string($_POST['broj']);
		$tegljac_id = $conn->escape_string($_POST['tegljac_id']);
		$prikolica_id = $conn->escape_string($_POST['prikolica_id']);
		
		$sql = "SELECT tegljaci.broj_registracije AS 'tegljac_broj_registracije', tegljaci.id AS 'tegljac_id', 
				prikolice.broj_registracije AS 'prikolica_broj_registracije', prikolice.id AS 'prikolica_id'
				FROM tegljaci INNER JOIN kompleti
				ON tegljaci.id = kompleti.fk_tegljac
				INNER JOIN prikolice
				ON prikolice.id = kompleti.fk_prikolica
				WHERE kompleti.broj =" . $broj . "
				AND kompleti.fk_tegljac=" . $tegljac_id . " 
				AND kompleti.fk_prikolica=" . $prikolica_id . "";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
		} else {
			$sql = "UPDATE kompleti
					SET fk_tegljac=" . $tegljac_id . ", fk_prikolica=" . $prikolica_id .
					" WHERE kompleti.broj=" . $broj . ";";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['posiljalac1']) && isset($_POST['ime'])) {
		$posiljalac1 = $conn->escape_string($_POST['posiljalac1']);
		$ime = $conn->escape_string($_POST['ime']);
		$idNalogodavac = 0;
		$idU_I = 0;
		
		$sql = "SELECT id FROM nalogodavci WHERE `ime`='" . $ime . "'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idNalogodavac = $row['id'];
		}
		$sql = "SELECT id FROM uvoznici_izvoznici WHERE `ime`=\"" . $posiljalac1. "\"";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idU_I = $row['id'];
		}
		
		$sql = "SELECT broj FROM u_i_nalogodavac WHERE `fk_nalogodavac`=" . $idNalogodavac . " AND `fk_u_i`=" . $idU_I;
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$sql = "UPDATE u_i_nalogodavac SET broj = broj + 1 WHERE `fk_nalogodavac`=" . $idNalogodavac . " AND `fk_u_i`=" .  $idU_I . "";
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO `u_i_nalogodavac` (`fk_nalogodavac`, `fk_u_i`, `broj`) VALUES (" . $idNalogodavac . ", " . $idU_I . ", 1)";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['posiljalac2']) && isset($_POST['ime'])) {
		$posiljalac2 = $conn->escape_string($_POST['posiljalac2']);
		$ime = $conn->escape_string($_POST['ime']);
		$idNalogodavac = 0;
		$idU_I = 0;
		
		$sql = "SELECT id FROM nalogodavci WHERE `ime`='" . $ime . "'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idNalogodavac = $row['id'];
		}
		
		$sql = "SELECT id FROM uvoznici_izvoznici WHERE `ime`=\"" . $posiljalac2. "\"";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idU_I = $row['id'];
		}
		
		$sql = "SELECT broj FROM u_i_nalogodavac WHERE `fk_nalogodavac`=" . $idNalogodavac . " AND `fk_u_i`=" . $idU_I;
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$sql = "UPDATE u_i_nalogodavac SET broj = broj + 1 WHERE `fk_nalogodavac`=" . $idNalogodavac . " AND `fk_u_i`=" .  $idU_I . "";
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO `u_i_nalogodavac` (`fk_nalogodavac`, `fk_u_i`, `broj`) VALUES (" . $idNalogodavac . ", " . $idU_I . ", 1)";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['primalac1']) && isset($_POST['ime'])) {
		$primalac1 = $conn->escape_string($_POST['primalac1']);
		$ime = $conn->escape_string($_POST['ime']);
		$idNalogodavac = 0;
		$idU_I = 0;
		
		$sql = "SELECT id FROM nalogodavci WHERE `ime`='" . $ime . "'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idNalogodavac = $row['id'];
		}
		
		$sql = "SELECT id FROM uvoznici_izvoznici WHERE `ime`=\"" . $primalac1. "\"";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idU_I = $row['id'];
		}
		
		$sql = "SELECT broj FROM u_i_nalogodavac WHERE `fk_nalogodavac`=" . $idNalogodavac . " AND `fk_u_i`=" . $idU_I;
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$sql = "UPDATE u_i_nalogodavac SET broj = broj + 1 WHERE `fk_nalogodavac`=" . $idNalogodavac . " AND `fk_u_i`=" .  $idU_I . "";
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO `u_i_nalogodavac` (`fk_nalogodavac`, `fk_u_i`, `broj`) VALUES (" . $idNalogodavac . ", " . $idU_I . ", 1)";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['primalac2']) && isset($_POST['ime'])) {
		$primalac2 = $conn->escape_string($_POST['primalac2']);
		$ime = $conn->escape_string($_POST['ime']);
		$idNalogodavac = 0;
		$idU_I = 0;
		
		$sql = "SELECT id FROM nalogodavci WHERE `ime`='" . $ime . "'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idNalogodavac = $row['id'];
		}
		$sql = "SELECT id FROM uvoznici_izvoznici WHERE `ime`=\"" . $primalac2. "\"";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idU_I = $row['id'];
		}
		
		$sql = "SELECT broj FROM u_i_nalogodavac WHERE `fk_nalogodavac`=" . $idNalogodavac . " AND `fk_u_i`=" . $idU_I;
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) {
			$sql = "UPDATE u_i_nalogodavac SET broj = broj + 1 WHERE `fk_nalogodavac`=" . $idNalogodavac . " AND `fk_u_i`=" .  $idU_I . "";
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO `u_i_nalogodavac` (`fk_nalogodavac`, `fk_u_i`, `broj`) VALUES (" . $idNalogodavac . ", " . $idU_I . ", 1)";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['imeP']) && isset($_POST['tip'])) {
		$imeP = $conn->escape_string($_POST['imeP']);
		$tip = $conn->escape_string($_POST['tip']);
		
		$sql = "INSERT INTO uvoznici_izvoznici (id, ime, u_i) VALUES (NULL, '$imeP', '$tip')";
		$conn->query($sql);
	}
?>