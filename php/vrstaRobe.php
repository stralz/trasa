<?php
  include "dbh.php";

  if (isset($_POST["id"]) && !isset($_POST["naziv"])) {
    $id = $conn->escape_string($_POST["id"]);

    $sql = "SELECT vrsta_robe.id, vrsta_robe.naziv FROM nalogodavci_roba JOIN nalogodavci
    ON (nalogodavci_roba.nalogodavac_id=nalogodavci.id) JOIN vrsta_robe
    ON (nalogodavci_roba.vrsta_robe_id=vrsta_robe.id) WHERE nalogodavci.id=$id";
    $result = $conn->query($sql);

  	if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<option id=\"{$row["id"]}\" value=\"{$row["naziv"]}\"/>";
      }
    } else {
      echo "0 podataka pronadjeno.";
    }
  }

  if (isset($_POST["id"]) && isset($_POST["naziv"])) {
    $id = $conn->escape_string($_POST["id"]);
    $naziv = $conn->escape_string($_POST["naziv"]);

    $sql = "SELECT id FROM vrsta_robe WHERE naziv LIKE ('$naziv')";
    echo "$sql \n";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $sql = "SELECT * FROM nalogodavci_roba WHERE nalogodavac_id=$id AND vrsta_robe_id={$row["id"]}";
      echo "$sql \n";
      $result = $conn->query($sql);

      if ($result->num_rows == 0) {
        $sql = "INSERT INTO nalogodavci_roba (nalogodavac_id, vrsta_robe_id) VALUES ($id, {$row["id"]})";
        echo "$sql \n";
        $conn->query($sql);
      }
    } else {
      $sql = "INSERT INTO vrsta_robe (id, naziv) VALUES (NULL, '$naziv')";
      $conn->query($sql);

      $sql = "INSERT INTO nalogodavci_roba (nalogodavac_id, vrsta_robe_id) VALUES ($id, (SELECT id FROM vrsta_robe WHERE naziv LIKE ('$naziv')))";
      $conn->query($sql);
    }
  }
?>
