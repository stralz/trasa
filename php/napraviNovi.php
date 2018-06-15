<?php

	include 'dbh.php';
	
	if(isset($_POST["baza"])) {
		$baza = $_POST["baza"];
		
		switch($baza)
		{
			case "nalogodavci":
				$ime = $conn->escape_string($_POST["ime"]);
				$mesto = $conn->escape_string($_POST["mesto"]);
				$adresa = $conn->escape_string($_POST["adresa"]);
				$postanski_broj = $conn->escape_string($_POST["postanski_broj"]);
				$pib = $conn->escape_string($_POST["pib"]);
				$pak = $conn->escape_string($_POST["pak"]);
				$rok_placanja = $conn->escape_string($_POST["rok_placanja"]);
				
				$sql = "INSERT INTO `nalogodavci` (`id`, `ime`, `mesto`, `adresa`, `postanski_broj`, `pib`, `pak`, `rok_placanja`) VALUES (NULL,
				'" . $ime . "', '" . $mesto . "', '" . $adresa . "', '" . $postanski_broj . "', '" . $pib . "', '" . $pak . "', '" . $rok_placanja . "');";
				echo $sql;
				break;
			case "tegljaci":
				//$id = $conn->escape_string($_POST["id"]);
				$broj_registracije = $conn->escape_string($_POST["broj_registracije"]);
				$marka = $conn->escape_string($_POST["marka"]);
				$model = $conn->escape_string($_POST["model"]);
				$tip_tahografa = $conn->escape_string($_POST["tip_tahografa"]);
			
				$sql  = "INSERT INTO `tegljaci` (`id`, `broj_registracije`, `marka`, `model`, `tip_tahografa`) VALUES (NULL, '" . $broj_registracije . "',
				'" . $marka . "', '" . $model . "', '" . $tip_tahografa . "')";
				echo $sql;
				break;
			case "prikolice":
				$broj_registracije = $conn->escape_string($_POST["broj_registracije"]);
				$marka = $conn->escape_string($_POST["marka"]);
				$sql = "INSERT INTO `prikolice` (`id`, `broj_registracije`, `marka`) VALUES (NULL, '" . $broj_registracije ."', '" . $marka . "')";
				echo $sql;
				break;
			case "kompleti":
				//$sql = ;
				break;
			case "uvoznici_izvoznici":
				$ime = $conn->escape_string($_POST["ime"]);
				$u_i = $conn->escape_string($_POST["u_i"]);
				
				$sql = "INSERT INTO `uvoznici_izvoznici` (`id`, `ime`, `u_i`) VALUES (NULL, '" . $ime . "', '" . $u_i . "')";
				echo $sql;
				break;
			case "vozaci":
				$ime = $conn->escape_string($_POST["ime"]);
				$prezime = $conn->escape_string($_POST["prezime"]);
				$br_pasosa = $conn->escape_string($_POST["br_pasosa"]);
				$procenat = $conn->escape_string($_POST["procenat"]);
				$uverenje = $conn->escape_string($_POST["uverenje"]);
				
				$sql = "INSERT INTO `vozaci` (`id`, `ime`, `prezime`, `br_pasosa`, `procenat`, `uverenje`)
						VALUES (NULL, '$ime', '$prezime', '$br_pasosa', '$procenat', '$uverenje')";
				break;
			case "pregledi_prikolice":
				$prikolica = $conn->escape_string($_POST["fk_prikolica"]);
				$registracija = $conn->escape_string($_POST["registracija"]);
				$sertifikat = $conn->escape_string($_POST["sertifikat"]);
				$sesto_mesecni = $conn->escape_string($_POST["sesto_mesecni"]);
				
				$sql = "SELECT id FROM prikolice WHERE broj_registracije='$prikolica'";
				$id_prikolice = 0;
				$result = $conn->query($sql);
				if($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$id_prikolice = $row["id"];
				}
				
				$sql = "INSERT INTO `pregledi_prikolice` (`id`, `fk_prikolica`, `registracija`, `sertifikat`, `sesto_mesecni`)
						VALUES (NULL, $id_prikolice, '$registracija', '$sertifikat', '$sesto_mesecni')";
				break;
			case "pregledi_tegljaci":
				$tegljac = $conn->escape_string($_POST["fk_tegljac"]);
				$vozac = $conn->escape_string($_POST["fk_vozac"]);
				$registracija = $conn->escape_string($_POST["registracija"]);
				$sertifikat = $conn->escape_string($_POST["sertifikat"]);
				$sesto_mesecni = $conn->escape_string($_POST["sesto_mesecni"]);
				$tahograf = $conn->escape_string($_POST["tahograf"]);
				
				$id_tegljaca = 0;
				$sql = "SELECT id FROM tegljaci WHERE broj_registracije='$tegljac'";
				$result = $conn->query($sql);
				if($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$id_tegljaca = $row["id"];
				}
				
				$id_vozaca = 0;
				$a = explode(" ", $vozac);
				$ime = $a[0];
				$prezime = $a[1];
				
				$sql = "SELECT id FROM vozaci WHERE ime='$ime' AND prezime='$prezime'";
				$result = $conn->query($sql);
				if($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$id_vozaca = $row["id"];
				}
				
				$sql = "INSERT INTO `pregledi_tegljaci`(`id`, `fk_tegljac`, `fk_vozac`, `registracija`, `sertifikat`, `sesto_mesecni`, `tahograf`) VALUES (NULL, $id_tegljaca, $id_vozaca, '$registracija', '$sertifikat', '$sesto_mesecni', '$tahograf')";
				echo $sql;
				break;
			default:
				break;
		}
		
		$conn->query($sql);
	}
	
?>