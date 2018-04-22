<?php
	$server_name = "localhost";
	$username = "root";
	$password = "";
	$dbname = "trasa";

	$conn = mysqli_connect($server_name, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>