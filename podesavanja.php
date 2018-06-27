<?php
	include 'php/dbh.php';
?>
<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script src="js/jquery.min.js"></script>
		<script src="js/slovima.js"></script>
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
		<style>
			table tr td input {
				width: 100%;
				background-color: #222222;
				border: none;
				color: white;
			}
			
			tr td{
				max-width:100%;
				white-space:nowrap;
			}
		</style>
		<script src="js/podesavanja.js"></script>
	</head>
	<body>
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title pull-left">Header</h2>
						<button class="close" type="button" data-dismiss="modal" onclick="clearModalBody()">x</button>
					</div>
					<div class="modal-body">
						<form></form>
					</div>
					<div class="modal-footer">
						<a class="btn btn-success" id="dodaj" data-dismiss="modal">Dodaj</a>
					</div>
				</div>
			</div>
		</div>
		<?php
			include 'navbar.php';
		?>
		<div class="container-fluid" style="margin-top: 40px;">
			<div class="row">
				<nav class="col-sm-3 col-md-2 hidden-xs-down bg-light sidebar">
					<ul class="nav nav-pills nav-stacked" id="navigacija">
						<li class="nav-item">
							<a class="nav-link active" id="buttonNalogodavci" href="#tableNalogodavac" role="tab" data-toggle="tab" aria-controls="tableNalogodavac" aria-selected="true">
								Nalogodavci <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="buttonTegljaci" href="#tableTegljac" role="tab" data-toggle="tab" aria-controls="tableTegljac" aria-selected="false">
								Tegljači
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="buttonPrikolice" href="#tablePrikolice" role="tab" data-toggle="tab" aria-controls="prikolice-tab-content" aria-selected="false">
								Prikolice
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="buttonUvoznici_Izvoznici" href="#tableUvoznici_Izvoznici" role="tab" data-toggle="tab" aria-controls="uvoznici-izvoznici-tab-content" aria-selected="false">
								Uvoznici/Izvoznici
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="buttonVozaci" href="#tableVozaci" role="tab" data-toggle="tab" aria-controls="vozaci-tab-content" aria-selected="false">
								Vozači
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="buttonBrojevi" href="#tableBrojevi" role="tab" data-toggle="tab" aria-controls="brojevi-tab-content" aria-selected="false">
								Brojači
							</a>
						</li>
					</ul>
				</nav>
				<div class="col-md-10 col-md-offset-2">
					<div class="tab-content">
						<div id="tableNalogodavac" class="tab-pane fade active show" role="tabpanel" aria-labelledby="buttonNalogodavci">
							<table class="table table-bordered table-hover" id="nalogodavciTabela">
							<?php
								$sql = "SELECT * FROM nalogodavci";
								$result = $conn->query($sql);

								$brojac = 1;
								if($result->num_rows > 0) {
									echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>IME
									</th><th>MESTO</th><th>ADRESA</th><th>POŠTANSKI BROJ</th><th>PIB</th><th>PAK</th><th>ROK PLAĆANJA</th></tr></thead>";
									while($row = $result->fetch_assoc()) {
										echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
										<td><input value=\"" . $row['ime'] . "\" class=\"ime\"></td><td><input value=\"" . $row['mesto'] .
										"\" class=\"mesto\"></td><td><input value=\"" . $row['adresa'] . "\" class=\"adresa\"></td><td><input value=\"" . $row['postanski_broj'] .
										"\" class=\"postanski_broj\"></td><td><input value=\"" . $row['pib'] . "\" class=\"pib\"><td><input value=\"" . $row['pak'] .
										"\" class=\"pak\"></td><td><input value=\"" . $row['rok_placanja'] . "\" class=\"rok_placanja\"></td></tr>";
									}
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Ažuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
								} else {
									echo "0 podataka pronadjeno.";
								}
							?>
							</table>
						</div>
						<div id="tableTegljac" class="tab-pane fade" role="tabpanel" aria-labelledby="buttonTegljaci">
							<table class="table table-bordered table-hover" id="tegljaciTabela">
							<?php
								$sql = "SELECT * FROM tegljaci";
								$result = $conn->query($sql);
								
								$brojac = 1;
								if($result->num_rows > 0) {
									echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>BROJ REGISTRACIJE</th><th>MARKA</th><th>MODEL</th><th>TIP TAHOGRAFA</th></tr></thead>";
									while($row = $result->fetch_assoc()) {
										echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
										<td><input value=\"" .
										$row['broj_registracije'] . "\" class=\"broj_registracije\"></td><td><input value=\"" . $row['marka'] .
										"\" class=\"marka\"></td><td><input value=\"" . $row['model'] . "\" class=\"model\"></td><td><input value=\"" .
										$row['tip_tahografa'] . "\" class=\"tip_tahografa\"></td></tr>";
									}
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Ažuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
								} else {
									echo "0 podataka pronadjeno.";
								}
							?>
							</table>
						</div>
						<div id="tablePrikolice" class="tab-pane fade" role="tabpanel" aria-labelledby="buttonPrikolice">
							<table class="table table-bordered table-hover" id="prikoliceTabela">
							<?php
								$sql = "SELECT * FROM prikolice";
								$result = $conn->query($sql);

								$brojac = 1;
								if($result->num_rows > 0) {
									echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>BROJ REGISTRACIJE</th><th>MARKA</th></tr></thead>";								
									while ($row = $result->fetch_assoc()) {
										echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
										<td><input value=\"" .
										$row['broj_registracije'] . "\" class=\"broj_registracije\"></td><td><input value=\"" . $row['marka'] .
										"\" class=\"marka\"></td></tr>";
									}
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Ažuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
								} else {
									echo "0 podataka pronadjeno.";
								}
							?>
							</table>
						</div>
						<div id="tableUvoznici_Izvoznici" class="tab-pane fade" role="tabpanel" aria-labelledby="buttonUvoznici_Izvoznici">
							<table class="table table-bordered table-hover" id="uvoznici_izvozniciTabela">
								<?php
									$sql = "SELECT id, ime, u_i FROM uvoznici_izvoznici";
									$result = $conn->query($sql);
									
									$brojac = 1;
									if($result->num_rows > 0) {
										echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>IME</th><th>UVOZNIK ILI IZVOZNIK</th></tr></thead>";
										
										while ($row = $result->fetch_assoc()) {
											if($row['u_i'] == 'Uvoznik') {
												echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
												<td><input value=\"" .
												$row['ime'] . "\" class=\"ime\"></td><td>
													<select class=\"u_i\">
														<option value=\"1\" selected>" . $row['u_i'] . "</option>
														<option value=\"2\">Izvoznik</option>
														<option value=\"3\">Oba</option>
													</select>
												</td></tr>";
											} elseif ($row['u_i'] == 'Izvoznik') {
												echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
											<td><input value=\"" .
											$row['ime'] . "\" class=\"ime\"></td><td>
												<select class=\"u_i\">
													<option value=\"1\" selected>" . $row['u_i'] . "</option>
													<option value=\"2\">Uvoznik</option>
													<option value=\"3\">Oba</option>
												</select>
											</td></tr>";
											} else {
												echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
											<td><input value=\"" .
											$row['ime'] . "\" class=\"ime\"></td><td>
												<select class=\"u_i\">
													<option value=\"1\" selected>" . $row['u_i'] . "</option>
													<option value=\"2\">Izvoznik</option>
													<option value=\"3\">Uvoznik</option>
												</select>
											</td></tr>";
											}
										}
										echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Ažuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
									} else {
										echo "0 podataka pronadjeno.";
									}
								?>
							</table>
						</div>
						<div id="tableVozaci" class="tab-pane fade" role="tabpanel" aria-labelledby="buttonVozaci">
							<table class="table table-bordered table-hover" id="vozaciTabela">
							<?php
								$sql = "SELECT * FROM vozaci";
								$result = $conn->query($sql);

								$brojac = 1;
								if($result->num_rows > 0) {
									echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>IME</th><th>PREZIME</th><th>BROJ PASOŠA</th><th>PROCENAT</th><th>UVERENJE</th><th>LEKARSKO</th></tr></thead>";
									while ($row = $result->fetch_assoc()) {
										if($row['uverenje'] == "Da") {
											echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
											<td><input value=\"" . $row['ime'] . "\" class=\"ime\"></td><td><input value=\"" . $row['prezime'] . "\" class=\"prezime\"></td><td><input value=\"" . $row['br_pasosa'] .
											"\" class=\"brPasosa\"></td><td><input value=\"" . $row['procenat'] . "\" class=\"procenat\"></td><td><select class=\"u_i\">
														<option value=\"1\" selected>Da</option>
														<option value=\"2\">Ne</option>
													</select><td><input type=\"text\" value=\"" . $row['lekarsko'] . "\" class=\"lekarsko\"></td></td></tr>";
										} else {
											echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
											<td><input value=\"" .
											$row['ime'] . " " . $row['prezime'] . "\" class=\"imePrezime\"></td><td><input value=\"" . $row['br_pasosa'] .
											"\" class=\"brPasosa\"></td><td><input value=\"" . $row['procenat'] . "\" class=\"procenat\"></td><td><select class=\"u_i\">
														<option value=\"1\">Da</option>
														<option value=\"2\" selected>Ne</option>
													</select></td><td><input type=\"text\" value=\"" . $row['lekarsko'] . "\" class=\"lekarsko\"></td></tr>";
										}
										
									}
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Ažuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
								} else {
									echo "0 podataka pronadjeno.";
								}
							?>
							</table>
						</div>
						<div id="tableBrojevi" class="tab-pane fade" role="tabpanel" aria-labelledby="buttonBrojevi">
							<table class="table table-bordered table-hover" id="brojeviTabela">
							<?php
								$sql = "SELECT * FROM brojevi";
								$result = $conn->query($sql);

								$brojac = 1;
								if($result->num_rows > 0) {
									$row = $result->fetch_assoc();
									echo "<thead class=\"thead\"><tr class=\"table-active\"><th>PRVI</th><th>DRUGI</th></tr></thead>";
									echo "<tr id=\"" . $row['id'] . "\"><td><input value=\"" . $row['prvi'] . "\" class=\"prvi\"></td><td><input value=\"" . $row['drugi'] . "\" class=\"drugi\"></td></tr>";
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Ažuriraj</a></td></tr>";
								} else {
									echo "0 podataka pronadjeno.";
								}
							?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(".dodaj").each(function() {
				$(this).attr("data-toggle", "modal");
				$(this).attr("data-target", "#myModal");
			});
		</script>
		<script src="js/main.js"></script>
	</body>
</html>