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
		
		$sql = "SELECT id FROM fakture WHERE racun_broj='$faktura'";
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
	
	if (isset($_POST['pomocni']) && isset($_POST['faktura'])) {
		$faktura = $conn->escape_string($_POST['faktura']);
		
		$sql = "SELECT fk_troskovi, naziv, datum, troskovi.iznos, valuta FROM fakture_troskovi INNER JOIN troskovi ON (troskovi.id=fakture_troskovi.fk_troskovi)
		INNER JOIN fakture ON (fakture_troskovi.fk_fakture=fakture.id )
		WHERE fakture.racun_broj='$faktura'";
		
		$brojac = 0;
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$brojac++;
				echo "<tr id=\"" . $row['fk_troskovi'] . "\"><td class=\"redni_broj\">$brojac. &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td><td>" . $row['datum'] . "</td><td>" . $row['naziv'] . "</td><td class=\"iznos\">" . $row['iznos'] . ' ' . $row['valuta'] . "</td></tr>";
			}
		}
		
	}
?>