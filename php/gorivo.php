<?php
	include 'dbh.php';
	
	if(isset($_POST['faktura']) && isset($_POST['datum']) && isset($_POST['kilometraza']) && isset($_POST['mestoTankiranja'])
		& isset($_POST['kolicinaLitara']) && isset($_POST['cenaPoLitru']) & isset($_POST['iznos'])
		& isset($_POST['brojGoriva'])) {
		$faktura = $conn->escape_string($_POST['faktura']);
		$datum = $conn->escape_string($_POST['datum']);
		$kilometraza = $conn->escape_string($_POST['kilometraza']);
		$mestoTankiranja = $conn->escape_string($_POST['mestoTankiranja']);
		$kolicinaLitara = $conn->escape_string($_POST['kolicinaLitara']);
		$cenaPoLitru = $conn->escape_string($_POST['cenaPoLitru']);
		$brojGoriva = $conn->escape_string($_POST['brojGoriva']);
		$iznos = $conn->escape_string($_POST['iznos']);
		
		$idBenzinske = 0;
		$idGoriva = 0;
		$idFakture = 0;
		
		$sql = "SELECT * FROM benzinske_stanice WHERE naziv='" . $mestoTankiranja . "'";
		$result = $conn->query($sql);
		if($result->num_rows == 0) {
			$sql = "INSERT INTO benzinske_stanice (id, naziv) VALUES (NULL, '" . $mestoTankiranja . "')";
			$conn->query($sql);
			
			$sql = "SELECT * FROM benzinske_stanice WHERE naziv='" . $mestoTankiranja . "'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$idBenzinske = $row['id'];
		} else {
			$row = $result->fetch_assoc();
			$idBenzinske = $row['id'];
		}
		
		$sql = "INSERT INTO gorivo (id, datum, kilometraza, kolicina_litara, cena_po_litru, iznos, fk_benzinska_stanica)
				VALUES (NULL, '$datum', $kilometraza, '$kolicinaLitara', '$cenaPoLitru', '$iznos', $idBenzinske)";
		$conn->query($sql);
		
		$sql = "SELECT id FROM fakture WHERE komplet_racun_broj='$faktura'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idFakture = $row["id"];
		}
		
		$sql = "SELECT id FROM gorivo WHERE datum='$datum' AND kilometraza='$kilometraza' AND kolicina_litara='$kolicinaLitara'
				AND cena_po_litru='$cenaPoLitru' AND iznos='$iznos' AND fk_benzinska_stanica='$idBenzinske'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idGoriva = $row["id"];
		}
		
		$sql = "INSERT INTO fakture_gorivo (fk_fakture, fk_gorivo) VALUES ($idFakture, $idGoriva)";
		$conn->query($sql);
		echo $idGoriva;
	}
	
	if(isset($_POST['pomocni']) && isset($_POST['faktura']) && isset($_POST['brojGoriva']) && isset($_POST['brojRacuna'])) {
		$pomocni = $conn->escape_string($_POST['pomocni']);
		$faktura = $conn->escape_string($_POST['faktura']);
		$brojGoriva = $conn->escape_string($_POST['brojGoriva']);
		$brojRacuna = $conn->escape_string($_POST['brojRacuna']);
		
		$idFakture = 0;
		
		$sql = "SELECT id FROM fakture WHERE komplet_racun_broj='$faktura'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$idFakture = $row["id"];
		}
		$sql = "SELECT gorivo.id, gorivo.datum, gorivo.kilometraza, benzinske_stanice.naziv, gorivo.iznos, gorivo.kolicina_litara, gorivo.cena_po_litru
				FROM fakture INNER JOIN fakture_gorivo ON (fakture.id=fakture_gorivo.fk_fakture)
				INNER JOIN gorivo ON (fakture_gorivo.fk_gorivo=gorivo.id)
				INNER JOIN benzinske_stanice ON (gorivo.fk_benzinska_stanica=benzinske_stanice.id)
				WHERE fakture.id=" . $idFakture;
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$a = explode("-", $faktura);
				$brojRacuna = $a[0];
				echo "<tr id=\"" . $row['id'] . "\"><td class=\"gorivoRedniBroj\">" . $brojGoriva . ". &nbsp;<a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td><td>" . $row['datum'] . "</td><td>" . $row['kilometraza'] . "</td><td>" . $row['naziv'] . "</td><td class=\"gorivoIznos" . $brojRacuna . "\">" . $row['iznos'] . "</td><td class=\"kolicinaLitara" . $brojRacuna . "\">" . $row['kolicina_litara'] . "</td><td>" . $row['cena_po_litru'] . "</td></tr>";
				$brojGoriva++;
			}
		} else {
			echo "";
		}
	}
	
	if(isset($_POST['red_id']) && isset($_POST['baza'])) {
		$red_id = $conn->escape_string($_POST['red_id']);
		$baza = $conn->escape_string($_POST['baza']);
		
		$sql = "DELETE FROM fakture_gorivo WHERE fk_gorivo=" . $red_id;
		$conn->query($sql);
		$sql = "DELETE FROM gorivo WHERE id=" . $red_id;
		$conn->query($sql);
	}
	
	
	
	
	
	
	
	
	
	
?>