<?php
    include 'dbh.php';
    $a = array();

    if(isset($_POST['od']) && isset($_POST['odDrzava'])) {
  		$od = $conn->escape_string($_POST['od']);
  		$odDrzava = $conn->escape_string($_POST['odDrzava']);

  		$sql = "SELECT id, drzava FROM gradovi WHERE ime LIKE('$od')";
  		$result = $conn->query($sql);
  		if($result->num_rows > 0) { // Ako postoji onda echo-ujemo njegovu drzavu.
        $row = $result->fetch_assoc();
        $a["od"] = $row["drzava"];
  		} else {
  			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $od . "', '" . $odDrzava . "')";
  			$conn->query($sql);
  		}
	}

	if(isset($_POST['do']) && isset($_POST['doDrzava'])) {
		$do = $conn->escape_string($_POST['do']);
		$doDrzava = $conn->escape_string($_POST['doDrzava']);

		$sql = "SELECT id, drzava FROM gradovi WHERE ime LIKE ('$do')";
		$result = $conn->query($sql);
		if($result->num_rows > 0) { // Ako postoji onda echo-ujemo njegovu drzavu.
      $row = $result->fetch_assoc();
      $a["do"] = $row["drzava"];
		} else {
			$sql = "INSERT INTO `gradovi` (`id`, `ime`, `drzava`) VALUES (NULL, '" . $do . "', '" . $doDrzava . "')";
			$conn->query($sql);
		}
	}

  echo json_encode($a);

?>
