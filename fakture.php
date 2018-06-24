<?php
	include 'navbar.php';
	include 'php/dbh.php';
?>
<!doctype html>
<html lang="en">
	<head>
		<script src="js/jquery.min.js"></script>
		<script src="js/docxtemplater.js"></script>
		<script src="js/jszip.js"></script>
		<script src="vendor/file-saver.js"></script>
		<script src="vendor/jszip-utils.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--
		Mandatory in IE 6, 7, 8 and 9.
		-->
		<!--[if IE]>
			<script type="text/javascript" src="examples/vendor/jszip-utils-ie.js"></script>
		<![endif]-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/theme.css">
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script defer src="js/all.js"></script>
		
		<script src="js/fakture.js"></script>
		<script src="js/slovima.js"></script>
	</head>
	<body>
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title pull-left">Uredi Fakturu</h2>
						<button class="close" type="button" data-dismiss="modal" onclick="clearModalBody()">x</button>
					</div>
					<div class="modal-body">
						<form>
						<div class="form-group">
							<label for="nalogodavac">Nalogodavac:</label>
							<select class="custom-select" name="nalogodavac" id="nalogodavac">
							    <option selected>Izaberite nalogodavca</option>
							    <?php
									$sql = "SELECT id, ime FROM nalogodavci";
									$result = $conn->query($sql);

									if($result->num_rows > 0)
									{
										while($row = $result->fetch_assoc()) {
											echo '<option value="' . $row["id"] . '">'. $row["ime"] . '</option>';
										}
									} else {
										print "0 results";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="racun_broj">Komplet:</label>
							<input type="text" id="racun_broj" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="komplet_racun_broj">Račun broj:</label>
							<input type="text" id="komplet_racun_broj" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="datum_izdavanja">Datum izdavanja:</label>
							<input type="date" id="datum_izdavanja" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="valuta_placanja">Rok plaćanja usluge:</label>
							<input type="date" id="valuta_placanja" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="mesto_prometa">Mesto prometa:</label>
							<input type="text" id="mesto_prometa" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="mesto_izdavanja_racuna">Mesto izdavanja računa:</label>
							<input type="text" id="mesto_izdavanja_racuna" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="tegljac">Tegljač:</label>
								<select class="custom-select" id="tegljac">
								   <option selected>Izaberite tegljača</option>
								   <?php
										$sql = "SELECT id, marka, broj_registracije FROM tegljaci";
										$result = $conn->query($sql);

										if($result->num_rows > 0)
										{
											while($row = $result->fetch_assoc()) {
												echo '<option value="' . $row["id"] . '">'. $row["marka"] . ': ' . $row["broj_registracije"]. '</option>';
											}
										} else {
											print "0 results";
										}
								    ?>
								</select>
						</div>
						<div class="form-group">
							<label for="prikolica">Prikolica:</label>
							<select class="custom-select" id="prikolica">
							<option selected>Izaberite prikolicu</option>
							<?php
								$sql = "SELECT id, marka, broj_registracije FROM prikolice";
								$result = $conn->query($sql);
								
								if($result->num_rows > 0)
								{
									while($row = $result->fetch_assoc()) {
										echo '<option value="' . $row['id'] . '">' . $row['marka'] . ': ' . $row['broj_registracije'] . '</option>';
									}
								} else {
									print "0 results";
								}
							?>
							</select>
				        </div>
						<div class="form-group">
							<label for="od1">Od 1:</label>
							<select class="custom-select" name="od1" id="od1">
					           <option selected>Izaberite grad:</option>
					           <?php
                                    $sql = "SELECT * FROM gradovi ORDER BY ime";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["ime"] . '">'. $row["ime"] . '</option>';
                                       }
                                    } else {
                                        print "0 results";
                                    }
                                ?>
							</select>
						</div>
						<div class="form-group">
							<label for="do1">Do 1:</label>
							<select class="custom-select" name="do1" id="do1">
					           <option selected>Izaberite grad:</option>
					           <?php
                                    $sql = "SELECT * FROM gradovi ORDER BY IME";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["ime"] . '">'. $row["ime"] . '</option>';
                                       }
                                    } else {
                                        print "0 results";
                                    }
                                ?>
							</select>
						</div>
						<div class="form-group">
							<label for="broj_naloga1">Broj naloga 1:</label>
							<input type="text" id="broj_naloga1" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="cmr1">CMR 1:</label>
							<input type="text" id="cmr1" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="tezina1">Težina 1:</label>
							<input type="text" id="tezina1" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="mesto_utovara1">Pošiljalac 1:</label>
							<select class="custom-select" name="mesto_utovara1" id="mesto_utovara1">
					           <option selected>Izaberite pošiljaoca:</option>
								<?php
									$sql = "SELECT * FROM uvoznici_izvoznici WHERE `u_i`=\"Izvoznik\" OR `u_i`=\"Oba\"";
									$result = $conn->query($sql);

									if($result->num_rows > 0)
									{
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["ime"] . "\">" . $row["ime"] . "</option>";
										}
									} else {
										print "0 results";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="mesto_istovara1">Primalac 1:</label>
							<select class="custom-select" name="mesto_istovara1" id="mesto_istovara1">
					           <option selected>Izaberite primaoca:</option>
								<?php
									$sql = "SELECT * FROM uvoznici_izvoznici WHERE `u_i`=\"Uvoznik\" OR `u_i`=\"Oba\"";
									$result = $conn->query($sql);

									if($result->num_rows > 0)
									{
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["ime"] . "\">" . $row["ime"] . "</option>";
										}
									} else {
										print "0 results";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="iznos1">Iznos 1:</label>
							<input type="text" id="iznos1" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="od2">Od 2:</label>
							<select class="custom-select" name="od2" id="od2">
					           <option selected>Izaberite grad:</option>
					           <?php
                                    $sql = "SELECT * FROM gradovi";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["ime"] . '">'. $row["ime"] . '</option>';
                                       }
                                    } else {
                                        print "0 results";
                                    }
                                ?>
							</select>
						</div>
						<div class="form-group">
							<label for="do2">Do 2:</label>
							<select class="custom-select" name="do2" id="do2">
					           <option selected>Izaberite grad:</option>
					           <?php
                                    $sql = "SELECT * FROM gradovi";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0)
                                    {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["ime"] . '">'. $row["ime"] . '</option>';
                                       }
                                    } else {
                                        print "0 results";
                                    }
                                ?>
							</select>
						</div>
						<div class="form-group">
							<label for="broj_naloga2">Broj naloga 2:</label>
							<input type="text" id="broj_naloga2" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="cmr2">CMR 2:</label>
							<input type="text" id="cmr2" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="tezina2">Težina 2:</label>
							<input type="text" id="tezina2" style="margin-left: 10px;">
						</div>
						<div class="form-group">
							<label for="mesto_utovara2">Pošiljalac 2:</label>
							<select class="custom-select" name="mesto_utovara2" id="mesto_utovara2">
					           <option selected>Izaberite pošiljaoca:</option>
								<?php
									$sql = "SELECT * FROM uvoznici_izvoznici WHERE `u_i`=\"Izvoznik\" OR `u_i`=\"Oba\"";
									$result = $conn->query($sql);

									if($result->num_rows > 0)
									{
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["ime"] . "\">" . $row["ime"] . "</option>";
										}
									} else {
										print "0 results";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="mesto_istovara2">Primalac 2:</label>
							<select class="custom-select" name="mesto_istovara2" id="mesto_istovara2">
					           <option selected>Izaberite primaoca:</option>
								<?php
									$sql = "SELECT * FROM uvoznici_izvoznici WHERE `u_i`=\"Uvoznik\" OR `u_i`=\"Oba\"";
									$result = $conn->query($sql);

									if($result->num_rows > 0)
									{
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["ime"] . "\">" . $row["ime"] . "</option>";
										}
									} else {
										print "0 results";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="iznos2">Iznos 2:</label>
							<input type="text" id="iznos2" style="margin-left: 10px;">
						</div>
						</form>
					</div>
					<div class="modal-footer">
						<a class="btn" id="otvori">Otvori</a>
						<a class="btn btn-success" id="dodaj">Azuriraj</a>
					</div>
				</div>
			</div>
		</div>
		<br><br>
		<div class="container">
			<table class="table table-bordered table-hover" id="faktureTabela">
			<?php
				$sql = "SELECT * FROM fakture";
				$result = $conn->query($sql);

				$brojac = 1;
				if($result->num_rows > 0) {
					echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>BROJ RAČUNA</th><th>DATUM IZDAVANJA</th></tr></thead>";								
					while ($row = $result->fetch_assoc()) {
						echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
						<td>" . $row['komplet_racun_broj'] . "&nbsp; &nbsp; <a class=\"broj_registracije uredi_dugme\" href=\"#\"><i class=\"fas fa-edit\"></i></a></td><td>" . $row['datum_izdavanja'] . "</td></tr>";
					}
				}
				else {
					echo "0 faktura pronadjeno.";
				}
			?>
			</table>
		</div>
		<script>
			$(".uredi_dugme").each(function() {
				$(this).attr("data-toggle", "modal");
				$(this).attr("data-target", "#myModal");
			});
		</script>
		<button id="pomocniKurs" style="display: none;">ss</button>
	</body>
	<script src="js/main.js"></script>
</html>