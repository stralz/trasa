<?php

	include 'dbh.php';
	
	if(isset($_POST["baza"])) {
		$baza = $_POST["baza"];
		
		switch($baza)
		{
			case "nalogodavci":
				
				$id = $conn->escape_string($_POST["id"]);
				$ime = $conn->escape_string($_POST["ime"]);
				$mesto = $conn->escape_string($_POST["mesto"]);
				$adresa = $conn->escape_string($_POST["adresa"]);
				$postanski_broj = $conn->escape_string($_POST["postanski_broj"]);
				$pib = $conn->escape_string($_POST["pib"]);
				$pak = $conn->escape_string($_POST["pak"]);
				$rok_placanja = $conn->escape_string($_POST["rok_placanja"]);
				
				$sql = "INSERT INTO `nalogodavci` (`id`, `ime`, `mesto`, `adresa`, `postanski_broj`, `pib`, `pak`, `rok_placanja`) VALUES (NULL,
				'" . $ime . "', '" . $mesto . "', '" . $adresa . "', '" . $postanski_broj . "', '" . $pib . "', '" . $pak . "', '" . $rok_placanja . "');";
				break;
			case "tegljaci":
				
				$id = $conn->escape_string($_POST["id"]);
				$broj_registracije = $conn->escape_string($_POST["broj_registracije"]);
				$marka = $conn->escape_string($_POST["marka"]);
				$model = $conn->escape_string($_POST["model"]);
				$tip_tahografa = $conn->escape_string($_POST["tip_tahografa"]);
			
				$sql  = "INSERT INTO `tegljaci` (`id`, `broj_registracije`, `marka`, `model`, `tip_tahografa`) VALUES (NULL, '" . $broj_registracije . "',
				'" . $marka . "', '" . $model . "', '" . $tip_tahografa . "')";
				break;
			case "prikolice":
				//$sql = ;
				break;
			case "kompleti":
				//$sql = ;
				break;
			case "uvoznici_izvoznici":
				$id = $conn->escape_string($_POST["id"]);
				$ime = $conn->escape_string($_POST["ime"]);
				$u_i = $conn->escape_string($_POST["u_i"]);
				
				$sql = "INSERT INTO `uvoznici_izvoznici` (`id`, `ime`, `u_i`) VALUES (NULL, '" . $ime . "', '" . $u_i . "')";
				break;
			default:
				break;
		}
		
		$conn->query($sql);
	}
	
?>