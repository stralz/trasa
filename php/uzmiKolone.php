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
		$sql = "SELECT racun_broj, komplet_racun_broj, ime_banke, racun_broj_banke, datum_izdavanja, valuta_placanja, datum_prometa, mesto_prometa, mesto_izdavanja_racuna,
		broj_naloga1, broj_naloga2, od1, od2, do1, do2, cmr1, cmr2, mesto_utovara1, mesto_utovara2, mesto_istovara1,
		mesto_istovara2, tezina1, tezina2, fk_tegljac, fk_prikolica, iznos1, iznos2, iznos, iznosEUR, kursEUR, sablon, nalogodavci.ime, fk_nalogodavac
		FROM fakture INNER JOIN nalogodavci ON (fk_nalogodavac=nalogodavci.id) WHERE fakture.id=" . $id;

		$result = $conn->query($sql);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if(strpos($row['sablon'], '1') !== false) {
					echo json_encode([
					'racun_broj' => $row['racun_broj'],
					'komplet_racun_broj' => $row['komplet_racun_broj'],
					'ime_banke' => $row['ime_banke'],
					'racun_broj_banke' => $row['racun_broj_banke'],
					'datum_izdavanja' => $row['datum_izdavanja'],
					'valuta_placanja' => $row['valuta_placanja'],
					'datum_prometa' => $row['datum_prometa'],
					'mesto_prometa' => $row['mesto_prometa'],
					'mesto_izdavanja_racuna' => $row['mesto_izdavanja_racuna'],
					'broj_naloga1' => $row['broj_naloga1'],
					'od1' => $row['od1'],
					'do1' => $row['do1'],
					'cmr1' => $row['cmr1'],
					'mesto_utovara1' => $row['mesto_utovara1'],
					'mesto_istovara1' => $row['mesto_istovara1'],
					'tezina1' => $row['tezina1'],
					'iznos1' => $row['iznos1'],
					'iznos' => $row['iznos'],
					'iznosEUR' => $row['iznosEUR'],
					'kursEUR' => $row['kursEUR'],
					'sablon' => $row['sablon'],
					'fk_nalogodavac' => $row['fk_nalogodavac'],
					'nalogodavac_ime' => $row['ime'],
					'fk_tegljac' => $row['fk_tegljac'],
					'fk_prikolica' => $row['fk_prikolica'],
					]);
				} else {
					echo json_encode([
					'racun_broj' => $row['racun_broj'],
					'komplet_racun_broj' => $row['komplet_racun_broj'],
					'ime_banke' => $row['ime_banke'],
					'racun_broj_banke' => $row['racun_broj_banke'],
					'datum_izdavanja' => $row['datum_izdavanja'],
					'valuta_placanja' => $row['valuta_placanja'],
					'datum_prometa' => $row['datum_prometa'],
					'mesto_prometa' => $row['mesto_prometa'],
					'mesto_izdavanja_racuna' => $row['mesto_izdavanja_racuna'],
					'broj_naloga1' => $row['broj_naloga1'],
					'broj_naloga2' => $row['broj_naloga2'],
					'od1' => $row['od1'],
					'od2' => $row['od2'],
					'od2' => $row['od2'],
					'do1' => $row['do1'],
					'do2' => $row['do2'],
					'cmr1' => $row['cmr1'],
					'cmr2' => $row['cmr2'],
					'mesto_utovara1' => $row['mesto_utovara1'],
					'mesto_utovara2' => $row['mesto_utovara2'],
					'mesto_istovara1' => $row['mesto_istovara1'],
					'mesto_istovara2' => $row['mesto_istovara2'],
					'tezina1' => $row['tezina1'],
					'tezina2' => $row['tezina2'],
					'iznos1' => $row['iznos1'],
					'iznos2' => $row['iznos2'],
					'iznos' => $row['iznos'],
					'iznosEUR' => $row['iznosEUR'],
					'kursEUR' => $row['kursEUR'],
					'sablon' => $row['sablon'],
					'nalogodavac_ime' => $row['ime'],
					'fk_tegljac' => $row['fk_tegljac'],
					'fk_nalogodavac' => $row['fk_nalogodavac'],
					'fk_prikolica' => $row['fk_prikolica'],
					]);
				}
			}
		}
	}
?>
