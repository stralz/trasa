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
			
			.tip_tahografa {
				display: none;
			}
		</style>
		<script src="js/vp.js"></script>
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
				<h1>Vozni park</h3>
			</div>
			<br>
			<div class="row">
				<nav class="col-sm-3 col-md-2 hidden-xs-down bg-light sidebar">
					<ul class="nav nav-pills nav-stacked">
						<li class="nav-item">
							<a class="nav-link active" id="buttonTegljaci" href="#tableTegljac" role="tab" data-toggle="tab" aria-controls="tableTegljac" aria-selected="true">
								Tegljaci
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="buttonPrikolice" href="#tablePrikolice" role="tab" data-toggle="tab" aria-controls="prikolice-tab-content" aria-selected="false">
								Prikolice
							</a>
						</li>
					</ul>
				</nav>
				<div class="col-md-10 col-md-offset-2">
					<div class="tab-content">
						<div id="tableTegljac" class="tab-pane fade active show" role="tabpanel" aria-labelledby="buttonTegljaci">
							<table class="table table-bordered table-hover" id="tegljaciTabela">
							<?php
								$sql = "SELECT vozaci.id AS \"vozac\", pregledi_tegljaci.id, broj_registracije, marka, ime, prezime, registracija, sertifikat, sesto_mesecni, tahograf, lekarsko, tip_tahografa FROM pregledi_tegljaci INNER JOIN tegljaci ON (pregledi_tegljaci.fk_tegljac=tegljaci.id) INNER JOIN vozaci ON (pregledi_tegljaci.fk_vozac=vozaci.id)";
								$result = $conn->query($sql);
								
								$brojac = 1;
								if($result->num_rows > 0) {
									echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>TEGLJAC/VOZAC</th><th>REGISTRACIJA</th><th>SERTIFIKAT(bela potvrda)</th><th>6-MESECNI</th><th>6-TAHOGRAF</th><th>LEKARSKO</th></tr></thead>";
									while($row = $result->fetch_assoc()) {
										echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>";
										echo "<td>" . $row['broj_registracije'] . " / " . $row['marka'] . " / " . $row['ime'] . " " . $row['prezime'] . "</td>";
										echo "<td><input value=\"" . $row['registracija'] . "\" class=\"registracija datum\"></td>";
										echo "<td><input value=\"" . $row['sertifikat'] . "\" class=\"sertifikat datum\"></td>";
										echo "<td><input value=\"" . $row['sesto_mesecni'] . "\" class=\"sesto_mesecni datum\"></td>";
										echo "<td><input value=\"" . $row['tahograf'] . "\" class=\"tahograf datum " . strtolower($row['tip_tahografa']) . "\"></td>";
										echo "<td><input value=\"" . $row['lekarsko'] . "\" class=\"lekarsko datum\" id=\"" . $row['vozac'] . "\"></td></tr>";
									}
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Azuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
								} else {
									echo "0 podataka pronadjeno.";
								}
							?>
							<datalist id="tegljaci">
								<?php
									$sql = "SELECT DISTINCT broj_registracije FROM tegljaci";
									
									$result = $conn->query($sql);
									if($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["broj_registracije"] . "\">";
										}
									}
								?>
							</datalist>
							<datalist id="vozaci">
								<?php
									$sql = "SELECT DISTINCT ime, prezime FROM vozaci";
									
									$result = $conn->query($sql);
									if($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["ime"] . " " . $row['prezime'] . "\">";
										}
									}
								?>
							</datalist>
							</table>
						</div>
						<div id="tablePrikolice" class="tab-pane fade" role="tabpanel" aria-labelledby="buttonPrikolice">
							<table class="table table-bordered table-hover" id="prikoliceTabela">
							<?php
								$sql = "SELECT * FROM pregledi_prikolice INNER JOIN prikolice ON (pregledi_prikolice.fk_prikolica=prikolice.id)";
								$result = $conn->query($sql);

								$brojac = 1;
								if($result->num_rows > 0) {
									echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>BROJ REGISTRACIJE</th><th>MARKA</th><th>REGISTRACIJA</th><th>SERTIFIKAT(bela potvrda)</th><th>6-MESECNI</th></tr></thead>";								
									while ($row = $result->fetch_assoc()) {
										echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
										<td>" . $row['broj_registracije'] . "</td><td>" . $row['marka'] . "</td><td><input value=\"" . $row['registracija'] . "\" class=\"registracija datum\"></td>
										<td><input value=\"" . $row['sertifikat'] . "\" class=\"sertifikat datum\"</td><td><input value=\"" . $row['sesto_mesecni'] . "\" class=\"sesto_mesecni datum\"></td></tr>";
									}
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Azuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
								} else {
									echo "0 podataka pronadjeno.";
								}
							?>
							<datalist id="prikolice">
								<?php
									$sql = "SELECT DISTINCT broj_registracije FROM prikolice";
									
									$result = $conn->query($sql);
									if($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["broj_registracije"] . "\">";
										}
									}
								?>
							</datalist>
							</table>
						</div>
					</div>
					<script>
						$(".datum").each(function () {
							var d = $(this);
							var brojDana;
							if(d.hasClass('digitalni'))
								brojDana = 30;
							else
								brojDana = 15;
							d = d.val();
							var d1 = new Date(d.split('.')[2], +(d.split('.')[1]) - +1, d.split('.')[0], 0, 0, 0, 0);
							var d2 = new Date();
							d2.setDate(d2.getDate() + brojDana);
							if(d1 < d2) {
								$(this).css("background", "#FD4239");
							}
						});
					</script>
				</div>
			</div>
		</div>
	<script src="js/main.js"></script>
	<script>
		$(".dodaj").each(function() {
			$(this).attr("data-toggle", "modal");
			$(this).attr("data-target", "#myModal");
		});
	</script>
	</body>
</html>