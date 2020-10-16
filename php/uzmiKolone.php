<?php
	include 'dbh.php';
	header("Content-Type: application/json");

	if (isset($_POST['tabela'])) {
		$tabela = $_POST['tabela'];

		$sql = "DESCRIBE " . $conn->escape_string($tabela);
		$result = $conn->query($sql);
		$rows = array();

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['Field'] != "id")
					$rows[] = $row['Field'];
			}
			echo json_encode($rows);
		} else {
			echo "null";
		}
	}

	if (isset($_POST['id'])) {
		$id = $conn->escape_string($_POST['id']);
		$sql = "SELECT racun_broj, komplet_racun_broj, datum_izdavanja, valuta_placanja, datum_prometa, mesto_prometa, mesto_izdavanja_racuna,
		broj_naloga, od, do, cmr, mesto_utovara, mesto_istovara, vrsta_robe, tezina, fk_tegljac, fk_prikolica, ang_tegljac, ang_prikolica, iznos,
		iznosEUR, kursEUR, sablon, nalogodavci.ime, fk_nalogodavac, avansna, uvoz, ceo_deo, domaci_deo, inostrani_deo
		FROM fakture INNER JOIN nalogodavci ON (fk_nalogodavac=nalogodavci.id) WHERE fakture.id=" . $id;

		$result = $conn->query($sql);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo json_encode([
				'racun_broj' => $row['racun_broj'],
				'komplet_racun_broj' => $row['komplet_racun_broj'],
				'datum_izdavanja' => $row['datum_izdavanja'],
				'valuta_placanja' => $row['valuta_placanja'],
				'datum_prometa' => $row['datum_prometa'],
				'mesto_prometa' => $row['mesto_prometa'],
				'mesto_izdavanja_racuna' => $row['mesto_izdavanja_racuna'],
				'broj_naloga' => $row['broj_naloga'],
				'od' => $row['od'],
				'do' => $row['do'],
				'cmr' => $row['cmr'],
				'vrsta_robe' => $row['vrsta_robe'],
				'mesto_utovara' => $row['mesto_utovara'],
				'mesto_istovara' => $row['mesto_istovara'],
				'tezina' => $row['tezina'],
				'iznos' => $row['iznos'],
				'iznosEUR' => $row['iznosEUR'],
				'kursEUR' => $row['kursEUR'],
				'sablon' => $row['sablon'],
				'fk_nalogodavac' => $row['fk_nalogodavac'],
				'nalogodavac_ime' => $row['ime'],
				'fk_tegljac' => $row['fk_tegljac'],
				'fk_prikolica' => $row['fk_prikolica'],
				'ang_tegljac' => $row['ang_tegljac'],
				'ang_prikolica' => $row['ang_prikolica'],
				'avansna' => $row["avansna"],
				'uvoz' => $row["uvoz"],
				'ceo_deo' => $row["ceo_deo"],
				'domaci_deo' => $row["domaci_deo"],
				'inostrani_deo' => $row["inostrani_deo"]
				]);
			}
		}
	}
?>
