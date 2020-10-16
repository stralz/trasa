<?php
  include 'dbh.php';

  if (isset($_POST["ang_tegljac"]) && isset($_POST["ang_prikolica"])) {
    $ang_tegljac = $conn->escape_string($_POST["ang_tegljac"]);
    $ang_prikolica = $conn->escape_string($_POST["ang_prikolica"]);

    $sql = "SELECT * FROM ang_tegljaci WHERE broj_registracije LIKE ('$ang_tegljac')";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
      $sql = "INSERT INTO ang_tegljaci (id, broj_registracije) VALUES (NULL, '$ang_tegljac')";
      $conn->query($sql);
    }

    $sql = "SELECT * FROM ang_prikolice WHERE broj_registracije LIKE ('$ang_prikolica')";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
      $sql = "INSERT INTO ang_prikolice (id, broj_registracije) VALUES (NULL, '$ang_prikolica')";
      $conn->query($sql);
    }
  }
?>
