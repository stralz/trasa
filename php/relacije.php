<?php
	include 'dbh.php';

	if(isset($_POST['ime']) && isset($_POST['pomocni'])) {
		$ime = $conn->escape_string($_POST['ime']);
		$sql = "SELECT * FROM gradovi ORDER BY ime";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()) {
				echo "<option value=\"" . $row["ime"] . "\">";
			}
		}
	}
	
	if(isset($_POST['ime']) && isset($_POST['grupa'])) {
		$ime = $conn->escape_string($_POST['ime']);
		$grupa = $conn->escape_string($_POST['grupa']);
		
		$sql = "SELECT g1.ime AS \"od\", g2.ime AS \"do\" FROM nalogodavci_relacije AS n_r
		INNER JOIN gradovi AS g1 ON n_r.fk_od=g1.id
		INNER JOIN gradovi AS g2 ON n_r.fk_do=g2.id
		INNER JOIN nalogodavci AS n ON n.id=n_r.fk_nalogodavac
		WHERE n.ime='" . $ime ."' ORDER BY n_r.broj DESC";
		$result = $conn->query($sql);

		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()) {
				echo "<a class=\"dropdown-item\" href=\"#\" onclick=\"izaberiRelaciju('" . $row["od"] . "', '" . $row["do"] . "', '$grupa')\">" . $row["od"] . "
				- " . $row["do"] ."</a>";
			}
		} else {
			print "0 results";
		}
	}
	
	if(isset($_POST['od1']) && isset($_POST['od1Drzava']) && isset($_POST['idNalogodavca'])) {
		$od1 = $conn->escape_string($_POST['od1']);
		$od1Drzava = $conn->escape_string($_POST['od1Drzava']);
		$idNalogodavca = $conn->escape_string($_POST['idNalogodavca']);
		
		$sql = "SELECT id FROM gradovi WHERE ime='" . $od1 . "'";
		echo "ECHO ZA UBACIVANJE GRADA: $sql <br>";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			
		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $od1 . "', '" . $od1Drzava . "')";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['do1']) && isset($_POST['do1Drzava']) && isset($_POST['idNalogodavca'])) {
		$do1 = $conn->escape_string($_POST['do1']);
		$do1Drzava = $conn->escape_string($_POST['do1Drzava']);
		$idNalogodavca = $conn->escape_string($_POST['idNalogodavca']);
		
		$sql = "SELECT id FROM gradovi WHERE ime='" . $do1 . "'";
		echo "ECHO ZA UBACIVANJE GRADA: $sql <br>";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			
		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $do1 . "', '" . $do1Drzava . "')";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['od2']) && isset($_POST['od2Drzava']) && isset($_POST['idNalogodavca'])) {
		$od2 = $conn->escape_string($_POST['od2']);
		$od2Drzava = $conn->escape_string($_POST['od2Drzava']);
		$idNalogodavca = $conn->escape_string($_POST['idNalogodavca']);
		
		$sql = "SELECT id FROM gradovi WHERE ime='" . $od2 . "'";
		echo "ECHO ZA UBACIVANJE GRADA: $sql <br>";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			
		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $od2 . "', '" . $od2Drzava . "')";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['do2']) && isset($_POST['do2Drzava']) && isset($_POST['idNalogodavca'])) {
		$do2 = $conn->escape_string($_POST['do2']);
		$do2Drzava = $conn->escape_string($_POST['do2Drzava']);
		$idNalogodavca = $conn->escape_string($_POST['idNalogodavca']);
		
		$sql = "SELECT id FROM gradovi WHERE ime='" . $do2 . "'";
		echo "ECHO ZA UBACIVANJE GRADA: $sql <br>";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			
		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $do2 . "', '" . $do2Drzava . "')";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['od1']) && isset($_POST['do1']) && isset($_POST['ime'])) {
		$ime = $conn->escape_string($_POST['ime']);
		$od1 = $conn->escape_string($_POST['od1']);
		$do1 = $conn->escape_string($_POST['do1']);
		
		$sql = "SELECT id FROM gradovi WHERE ime='" . $od1 . "'";
		$idOd1 = "";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$idOd1 = $row['id'];
			}
		}
		
		$sql = "SELECT id FROM gradovi WHERE ime='" . $do1 . "'";
		$idDo1 = "";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$idDo1 = $row['id'];
			}
		}
		
		$sql = "SELECT id FROM nalogodavci WHERE ime='" . $ime . "'";
		$idOdNalogodavca = "";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$idOdNalogodavca = $row['id'];
			}
		}
		
		$sql = "SELECT * FROM nalogodavci_relacije WHERE fk_od=" . $idOd1 . " AND fk_do=" . $idDo1 . " AND fk_nalogodavac=" . $idOdNalogodavca;
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$sql = "UPDATE nalogodavci_relacije SET broj = broj + 1 WHERE fk_nalogodavac=" . $idOdNalogodavca . " AND fk_od=" . $idOd1 . " AND fk_do=" . $idDo1;
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO `nalogodavci_relacije` (`id`, `fk_od`, `fk_do`, `fk_nalogodavac`, `broj`) VALUES (NULL, " . $idOd1 . ", " . $idDo1 . ", " . $idOdNalogodavca . ", 1)";
			$conn->query($sql);
		}
	}
	
	if(isset($_POST['od2']) && isset($_POST['do2']) && isset($_POST['ime'])) {
		$ime = $conn->escape_string($_POST['ime']);
		$od2 = $conn->escape_string($_POST['od2']);
		$do2 = $conn->escape_string($_POST['do2']);
		
		$sql = "SELECT id FROM gradovi WHERE ime='" . $od2 . "'";
		$idOd2 = "";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$idOd2 = $row['id'];
			}
		}
		
		$sql = "SELECT id FROM gradovi WHERE ime='" . $do2 . "'";
		$idDo2 = "";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$idDo2 = $row['id'];
			}
		}
		
		$sql = "SELECT id FROM nalogodavci WHERE ime='" . $ime . "'";
		$idOdNalogodavca = "";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$idOdNalogodavca = $row['id'];
			}
		}
		$sql = "SELECT * FROM nalogodavci_relacije WHERE fk_od=" . $idOd2 . " AND fk_do=" . $idDo2 . " AND fk_nalogodavac=" . $idOdNalogodavca;
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$sql = "UPDATE nalogodavci_relacije SET broj = broj + 1 WHERE fk_nalogodavac=" . $idOdNalogodavca . " AND fk_od=" . $idOd2 . " AND fk_do=" . $idDo2;
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO `nalogodavci_relacije` (`id`, `fk_od`, `fk_do`, `fk_nalogodavac`, `broj`) VALUES (NULL, " . $idOd2 . ", " . $idDo2 . ", " . $idOdNalogodavca . ", 1)";
			//echo "SQL ZA UBACIVANJE NOVE RELACIJE: <br> $sql";
			$conn->query($sql);
		}
	}
?>