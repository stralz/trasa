<?php
	include "dbh.php";
	
	if(isset($_POST["faktura"]) && isset($_POST["trosak"]) && isset($_POST["iznos"]) && isset($_POST["valuta"]) && isset($_POST["datum"])) {
		$faktura = $conn->escape_string($_POST["faktura"]);
		$trosak = $conn->escape_string($_POST["trosak"]);
		$iznos = $conn->escape_string($_POST["iznos"]);
		$valuta = $conn->escape_string($_POST["valuta"]);
		$datum = $conn->escape_string($_POST["datum"]);
		$idFakture = 0;
		$idTroska = 0;
		
		$sql = "SELECT id FROM fakture WHERE komplet_racun_broj='$faktura'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idFakture = $row["id"];
		}
		
		$sql = "INSERT INTO troskovi (id, naziv, datum, iznos, valuta) VALUES (NULL, '$trosak', '$datum', '$iznos', '$valuta')";
		$conn->query($sql);
		
		$sql = "SELECT id FROM troskovi WHERE naziv='$trosak' AND datum='$datum' AND iznos=$iznos AND valuta='$valuta'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idTroska = $row["id"];
		}
		
		$sql = "INSERT INTO fakture_troskovi (fk_fakture, fk_troskovi) VALUES ($idFakture, $idTroska)";
		$conn->query($sql);
		
		echo $idTroska;
	}
	
	if (isset($_POST['pomocni']) && isset($_POST['faktura']) && isset($_POST['brojTroskova'])) {
		$faktura = $conn->escape_string($_POST['faktura']);
		$brojTroskova = $conn->escape_string($_POST['brojTroskova']);
		
		$sql = "SELECT fk_troskovi, naziv, datum, troskovi.iznos, valuta FROM fakture_troskovi INNER JOIN troskovi ON (troskovi.id=fakture_troskovi.fk_troskovi)
		INNER JOIN fakture ON (fakture_troskovi.fk_fakture=fakture.id )
		WHERE fakture.komplet_racun_broj='$faktura'";
		
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$brojTroskova++;
				echo "<tr id=\"" . $row['fk_troskovi'] . "\"><td class=\"troskoviRedniBroj\">$brojTroskova. &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td><td>" . $row['datum'] . "</td><td>" . $row['naziv'] . "</td><td class=\"troskoviIznos\">" . $row['iznos'] . ' ' . $row['valuta'] . "</td></tr>";
			}
		} else {
			echo "";
		}
	}
	
	if(isset($_POST['red_id']) && isset($_POST['baza'])) {
		$red_id = $conn->escape_string($_POST['red_id']);
		$baza = $conn->escape_string($_POST['baza']);
		
		$sql = "DELETE FROM fakture_troskovi WHERE fk_troskovi=" . $red_id;
		$conn->query($sql);
		$sql = "DELETE FROM troskovi WHERE id=" . $red_id;
		$conn->query($sql);
	}
	
	if(isset($_POST['faktura']) && isset($_POST['pomocni'])) {
		$faktura = $conn->escape_string($_POST["faktura"]);
		$pomocni = $conn->escape_string($_POST["pomocni"]);
		
		if($pomocni == 12) {
			$idFakture = 0;
			
			$sql = "SELECT iznos FROM fakture WHERE komplet_racun_broj='$faktura'";
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				echo $row['iznos'];
			}
			
			$sql = "SELECT ime FROM nalogodavci INNER JOIN fakture ON (nalogodavci.id=fakture.fk_nalogodavac) WHERE komplet_racun_broj='$faktura'";
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				echo "<a style=\"display: none;\" class=\"imeNalogodavca\">" . $row['ime'] . "</a>";
			}
		}
	}
?>