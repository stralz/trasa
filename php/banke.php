<?php
	include 'dbh.php';
	
	if(isset($_POST['ime']) && isset($_POST['pomocni'])) {
		$ime = $conn->escape_string($_POST['ime']);
		$pomocni = $conn->escape_string($_POST['pomocni']);
		
		$sql = "SELECT * FROM banke WHERE ime='$ime'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo $row['racun_broj'];
		}
	}
	
	if(isset($_POST['ime']) && isset($_POST['racun_broj']) && isset($_POST['nalogodavac'
	])) {
		$ime = $conn->escape_string($_POST['ime']);
		$racun_broj = $conn->escape_string($_POST['racun_broj']);
		$nalogodavac = $conn->escape_string($_POST['nalogodavac']);
		
		$sql = "SELECT * FROM banke WHERE ime='$ime'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$id = $row['id'];
			$sql = "UPDATE banke SET ime='$ime', racun_broj='$racun_broj' WHERE ime='$ime'";
			$conn->query($sql);
			$sql = "INSERT INTO nalogodavci_banke (id, fk_nalogodavac, fk_banke) VALUES (NULL, '$nalogodavac', '$id')";
			echo $sql;
			$conn->query($sql);
		} else {
			$sql = "INSERT INTO banke (id, ime, racun_broj) VALUES (NULL, '$ime', '$racun_broj')";
			echo $sql;
			$conn->query($sql);
			
			$sql = "SELECT id FROM banke WHERE ime='$ime'";
			$result = $conn->query($sql);
			echo $sql;
			$row = $result->fetch_assoc();
			$id = $row['id'];
			
			$sql = "INSERT INTO nalogodavci_banke (id, fk_nalogodavac, fk_banke) VALUES (NULL, '$nalogodavac', '$id')";
			echo $sql;
			$conn->query($sql);
		}
	}
?>