<?php
	include 'dbh.php';
	
	if(isset($_POST['racunBroj'])) {
		$racunBroj = $conn->escape_string($_POST['racunBroj']);
		
		$sql = "SELECT * FROM brojevi";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			echo $row['prvi'] . "-" . $racunBroj . "/" . $row['drugi'];
		}
		
		$sql = "UPDATE brojevi SET prvi=prvi + 1, drugi=drugi + 1";
		$conn->query($sql);
	}
?>