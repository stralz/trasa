<?php
	include 'dbh.php';
	
	if(isset($_POST['komplet'])) {
		$komplet = $conn->escape_string($_POST['komplet']);
		
		$sql = "SELECT procenat FROM sleperi_vozaci INNER JOIN kompleti ON (sleperi_vozaci.fk_komplet=kompleti.id) INNER JOIN vozaci ON (sleperi_vozaci.fk_vozac=vozaci.id) WHERE broj=$komplet";
		
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo $row['procenat'];
		}	}

?>