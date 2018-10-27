<?php
	include 'dbh.php';

	$racun_broj = "";
	$komplet_racun_broj = "";
	$datum_izdavanja = "";
	$valuta_placanja = "";
	$datum_prometa = "";
	$mesto_prometa = "";
	$mesto_izdavanja_racuna = "";
	$ime_banke = "";
	$racun_broj_banke = "";
	$broj_naloga1 = "";
	$broj_naloga2 = $conn->escape_string($_POST["broj_naloga2"]);
	$od1 = "";
	$do1 = "";
	$od2 = $conn->escape_string($_POST["od2"]);
	$do2 = $conn->escape_string($_POST["do2"]);
	$cmr1 = "";
	$cmr2 = $conn->escape_string($_POST["cmr2"]);
	$mesto_utovara1 = "";
	$mesto_istovara1 = "";
	$mesto_utovara2 = "";
	$mesto_istovara2 = "";
	$tezina1 = "";
	$tezina2 = $conn->escape_string($_POST["tezina2"]);
	$fk_tegljac = "";
	$fk_prikolica = "";
	$iznos1 = "";
	$iznos2 = $conn->escape_string($_POST["iznos2"]);
	$iznos = "";
	$iznosEUR = "";
	$kursEUR = "";
	$sablon = "";
	$fk_nalogodavac = "";

	if(isset($_POST["racun_broj"])) {
		$racun_broj = $conn->escape_string($_POST["racun_broj"]);
	}

	if(isset($_POST["komplet_racun_broj"])) {
		$komplet_racun_broj = $conn->escape_string($_POST["komplet_racun_broj"]);
	}

	if(isset($_POST["ime_banke"])) {
		$ime_banke = $conn->escape_string($_POST["ime_banke"]);
	}

	if(isset($_POST["racun_broj_banke"])) {
		$racun_broj_banke = $conn->escape_string($_POST["racun_broj_banke"]);
	}

	if(isset($_POST["datum_izdavanja"])) {
		$datum_izdavanja = $conn->escape_string($_POST["datum_izdavanja"]);
	}

	if(isset($_POST["valuta_placanja"])) {
		$valuta_placanja = $conn->escape_string($_POST["valuta_placanja"]);
	}

	if(isset($_POST["datum_prometa"])) {
		$datum_prometa = $conn->escape_string($_POST["datum_prometa"]);
	}

	if(isset($_POST["mesto_prometa"])) {
		$mesto_prometa = $conn->escape_string($_POST["mesto_prometa"]);
	}

	if(isset($_POST["mesto_izdavanja_racuna"])) {
		$mesto_izdavanja_racuna = $conn->escape_string($_POST["mesto_izdavanja_racuna"]);
	}

	if(isset($_POST["broj_naloga1"])) {
		$broj_naloga1 = $conn->escape_string($_POST["broj_naloga1"]);
	}

	if(isset($_POST["od1"])) {
		$od1 = $conn->escape_string($_POST["od1"]);
	}

	if(isset($_POST["do1"])) {
		$do1 = $conn->escape_string($_POST["do1"]);
	}

	if(isset($_POST["cmr1"])) {
		$cmr1 = $conn->escape_string($_POST["cmr1"]);
	}

	if(isset($_POST["mesto_utovara1"])) {
		$mesto_utovara1 = $conn->escape_string($_POST["mesto_utovara1"]);
	}

	if(isset($_POST["mesto_istovara1"])) {
		$mesto_istovara1 = $conn->escape_string($_POST["mesto_istovara1"]);
	}

	if(isset($_POST["mesto_utovara2"])) {
		$mesto_utovara2 = $conn->escape_string($_POST["mesto_utovara2"]);
	}

	if(isset($_POST["mesto_istovara2"])) {
		$mesto_istovara2 = $conn->escape_string($_POST["mesto_istovara2"]);
	}

	if(isset($_POST["tezina1"])) {
		$tezina1 = $conn->escape_string($_POST["tezina1"]);
	}

	if(isset($_POST["fk_tegljac"])) {
		$fk_tegljac = $conn->escape_string($_POST["fk_tegljac"]);
	}

	if(isset($_POST["fk_prikolica"])) {
		$fk_prikolica = $conn->escape_string($_POST["fk_prikolica"]);
	}

	if(isset($_POST["iznos1"])) {
		$iznos1 = $conn->escape_string($_POST["iznos1"]);
	}

	if(isset($_POST["iznos"])) {
		$iznos = $conn->escape_string($_POST["iznos"]);
	}

	if(isset($_POST["iznosEUR"])) {
		$iznosEUR = $conn->escape_string($_POST["iznosEUR"]);
	}

	if(isset($_POST["kursEUR"])) {
		$kursEUR = $conn->escape_string($_POST["kursEUR"]);
	}

	if(isset($_POST["sablon"])) {
		$sablon = $conn->escape_string($_POST["sablon"]);
	}

	if(isset($_POST["fk_nalogodavac"])) {
		$fk_nalogodavac = $conn->escape_string($_POST["fk_nalogodavac"]);
	}

	$sql = "INSERT INTO `fakture` (`id`, `racun_broj`, `komplet_racun_broj`, `datum_izdavanja`, `valuta_placanja`, `datum_prometa`, `mesto_prometa`,
	`mesto_izdavanja_racuna`, `broj_naloga1`, `broj_naloga2`, `od1`, `od2`, `do1`, `do2`, `cmr1`, `cmr2`, `mesto_utovara1`,
	`mesto_utovara2`, `mesto_istovara1`, `mesto_istovara2`, `tezina1`, `tezina2`, `fk_tegljac`, `fk_prikolica`, `iznos1`, `iznos2`,
	`iznos`, `iznosEUR`, `kursEUR`, `sablon`, `fk_nalogodavac`, `ime_banke`, `racun_broj_banke`) VALUES ('NULL', '$racun_broj', '$komplet_racun_broj','$datum_izdavanja', '$valuta_placanja',
	'$datum_prometa', '$mesto_prometa', '$mesto_izdavanja_racuna', '$broj_naloga1', '$broj_naloga2', '$od1', '$od2', '$do1',
	'$do2', '$cmr1', '$cmr2', '$mesto_utovara1', '$mesto_utovara2', '$mesto_istovara1', '$mesto_istovara2', '$tezina1',
	'$tezina2', '$fk_tegljac', '$fk_prikolica', '$iznos1', '$iznos2', '$iznos', '$iznosEUR', '$kursEUR', '$sablon', '$fk_nalogodavac', '$ime_banke', '$racun_broj_banke')";
	echo $sql;
	$conn->query($sql);

?>
