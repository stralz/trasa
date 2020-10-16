<?php
  include 'dbh.php';

  if (isset($_POST["tegljac_id"]) && isset($_POST["prikolica_id"])) {
		$tegljac_id = $conn->escape_string($_POST["tegljac_id"]);
		$prikolica_id = $conn->escape_string($_POST["prikolica_id"]);

		$sql = "SELECT broj_registracije FROM tegljaci WHERE id=$tegljac_id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo $row["broj_registracije"];
		}

    echo "|";

		$sql = "SELECT broj_registracije FROM prikolice WHERE id=$prikolica_id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo $row["broj_registracije"];
		}
	}
?>
