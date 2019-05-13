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

		<script src="js/index.js"></script>
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
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="nalogodavac">Nalogodavac:</label>
									<select class="form-control" name="nalogodavac" id="nalogodavac">
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
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="racun_broj">Račun broj:</label>
									<input type="text" class="form-control" id="racun_broj">
								</div>
								<div class="form-group col-md-3">
									<label for="datum_izdavanja">Datum izdavanja:</label>
									<input type="date" class="form-control" id="datum_izdavanja">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="datum_prometa">Datum prometa usluge:</label>
									<input type="date" class="form-control" id="datum_prometa">
								</div>
								<div class="form-group col-md-3">
									<label for="valuta_placanja">Rok plaćanja usluge:</label>
									<input type="date" class="form-control" id="valuta_placanja">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="mesto_prometa">Mesto prometa:</label>
									<input type="text" class="form-control" id="mesto_prometa">
								</div>
								<div class="form-group col-md-4">
									<label for="mesto_izdavanja_racuna">Mesto izdavanja računa:</label>
									<input type="text" class="form-control" id="mesto_izdavanja_racuna">
								</div>
							</div>
							<div class="form-row" id="nas_kamion">
								<div class="form-group col-md-6">
									<label for="tegljac">Tegljač:</label>
										<select class="custom-select" id="tegljac">
										<option selected>Izaberite tegljač</option>
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
								<div class="form-group col-md-6">
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
							</div>
							<div class="form-row" id="ang_kamion">
								<div class="form-group col-md-3">
									<label for="ang_tegljac">Angažovani tegljač:</label>
									<input type="text" class="form-control" id="ang_tegljac">
								</div>
								<div class="form-group col-md-3">
									<label for="ang_prikolica">Angažovana prikolica:</label>
									<input type="text" class="form-control" id="ang_prikolica">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
								  <label for="od">Od:</label>
								  <input type="text" list="listaGradovi" class="form-control" id="od" autocomplete="off">
								</div>
								<datalist id="listaGradovi">
                                    <?php
                                    $sql = "SELECT * FROM gradovi ORDER BY ime";
                                    $result = $conn->query($sql);
                                    if($result->num_rows > 0)
                                        while($row = $result->fetch_assoc())
                                            echo "<option value=\"" . $row["ime"] . "\">";
                                    ?>
								</datalist>
								<div class="form-group col-md-4">
									<label for="do">Do:</label>
									<input type="text" list="listaGradovi" class="form-control" id="do" autocomplete="off">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="cmr">CMR:</label>
									<input type="text" class="form-control" id="cmr">
								</div>
								<div class="form-group col-md-3">
									<label for="broj_naloga">Broj naloga:</label>
									<input type="text" class="form-control" id="broj_naloga">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="vrsta_robe">Vrsta robe:</label>
									<input type="text" class="form-control" id="vrsta_robe">
								</div>
								<div class="form-group col-md-3">
									<label for="tezina">Težina:</label>
									<input type="text" class="form-control" id="tezina">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="iznos">Iznos:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="iznos">
										<div class="input-group-append">
											<span class="input-group-text">&euro;</span>
										</div>
									</div>
								</div>
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
				<tr><td><a class="btn btn-success btn-sm" href="fakture.php"><i class="fas fa-plus"></i></a></td></tr>
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
		<button id="pomocniKurs" style="display: none;"></button>
	</body>
	<script src="js/main.js"></script>
</html>
