<?php
	include 'dbh.php';

	$racun_broj = $conn->escape_string($_POST["racun_broj"]);;
	$komplet_racun_broj = $conn->escape_string($_POST["komplet_racun_broj"]);

	$datum_izdavanja = $conn->escape_string($_POST["datum_izdavanja"]);
	$valuta_placanja = $conn->escape_string($_POST["valuta_placanja"]);
	$datum_prometa = $conn->escape_string($_POST["datum_prometa"]);

	$mesto_prometa = $conn->escape_string($_POST["mesto_prometa"]);
	$mesto_izdavanja_racuna = $conn->escape_string($_POST["mesto_izdavanja_racuna"]);

	$od = $conn->escape_string($_POST["od"]);
	$do = $conn->escape_string($_POST["do"]);

	$broj_naloga = $conn->escape_string($_POST["broj_naloga"]);
	$cmr = $conn->escape_string($_POST["cmr"]);

	$mesto_utovara = $conn->escape_string($_POST["mesto_utovara"]);
	$mesto_istovara = $conn->escape_string($_POST["mesto_istovara"]);

	$tezina = $conn->escape_string($_POST["tezina"]);
	$vrsta_robe = $conn->escape_string($_POST["vrsta_robe"]);

	$fk_tegljac = $conn->escape_string($_POST["fk_tegljac"]);
	$fk_prikolica = $conn->escape_string($_POST["fk_prikolica"]);
	$ang_tegljac = $conn->escape_string($_POST["ang_tegljac"]);
	$ang_prikolica = $conn->escape_string($_POST["ang_prikolica"]);

	$iznos = $conn->escape_string($_POST["iznos"]);
	$iznosEUR = $conn->escape_string($_POST["iznosEUR"]);
	$kursEUR = $conn->escape_string($_POST["kursEUR"]);

	$sablon = $conn->escape_string($_POST["sablon"]);

	$fk_nalogodavac = $conn->escape_string($_POST["fk_nalogodavac"]);

	$avansna = $conn->escape_string($_POST["avansna"]);
	$uvoz = $conn->escape_string($_POST["uvoz"]);

	$ceo_deo = $conn->escape_string($_POST["ceo_deo"]);
	$domaci_deo = $conn->escape_string($_POST["domaci_deo"]);
	$inostrani_deo = $conn->escape_string($_POST["inostrani_deo"]);

	if($fk_tegljac == 0 && $fk_prikolica == 0) {
		$sql = "INSERT INTO fakture (id, racun_broj, komplet_racun_broj, datum_izdavanja, valuta_placanja, datum_prometa, mesto_prometa, mesto_izdavanja_racuna, broj_naloga, od, do, cmr, mesto_utovara, mesto_istovara, tezina, vrsta_robe, fk_tegljac, fk_prikolica, ang_tegljac, ang_prikolica, iznos, iznosEUR, kursEUR, sablon, fk_nalogodavac, avansna, uvoz, ceo_deo, domaci_deo, inostrani_deo) VALUES
		('NULL', '$racun_broj', '$komplet_racun_broj', '$datum_izdavanja', '$valuta_placanja', '$datum_prometa', '$mesto_prometa', '$mesto_izdavanja_racuna', '$broj_naloga', '$od', '$do', '$cmr', '$mesto_utovara', '$mesto_istovara', '$tezina', '$vrsta_robe', NULL, NULL, '$ang_tegljac', '$ang_prikolica','$iznos', '$iznosEUR', '$kursEUR', '$sablon', '$fk_nalogodavac', $avansna, $uvoz, '$ceo_deo', '$domaci_deo', '$inostrani_deo')";
		echo $sql;
		$conn->query($sql);
	} else {
		$sql = "INSERT INTO fakture (id, racun_broj, komplet_racun_broj, datum_izdavanja, valuta_placanja, datum_prometa, mesto_prometa, mesto_izdavanja_racuna, broj_naloga, od, do, cmr, mesto_utovara, mesto_istovara, tezina, vrsta_robe, fk_tegljac, fk_prikolica, ang_tegljac, ang_prikolica, iznos, iznosEUR, kursEUR, sablon, fk_nalogodavac, avansna, uvoz, ceo_deo, domaci_deo, inostrani_deo) VALUES
		('NULL', '$racun_broj', '$komplet_racun_broj', '$datum_izdavanja', '$valuta_placanja', '$datum_prometa', '$mesto_prometa', '$mesto_izdavanja_racuna', '$broj_naloga', '$od', '$do', '$cmr', '$mesto_utovara', '$mesto_istovara', '$tezina', '$vrsta_robe','$fk_tegljac', '$fk_prikolica', '$ang_tegljac', '$ang_prikolica','$iznos', '$iznosEUR', '$kursEUR', '$sablon', '$fk_nalogodavac', $avansna, $uvoz, '$ceo_deo', '$domaci_deo', '$inostrani_deo')";
		echo $sql;
		$conn->query($sql);
	}


?>
