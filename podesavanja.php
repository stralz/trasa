<?php
	include 'php/dbh.php';
?>
<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/theme.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
		<style>
			table tr td input {
				width: 100%;
				background-color: #222222;
				border: none;
				color: white;
			}
		</style>
		<script>
			function clearModalBody() {
				$('.modal > .modal-dialog > .modal-content > .modal-body > form').empty();
			}
		
			$(".nav>li").each(function() {
				var navItem = $(this);
				if (navItem.find("a").attr("href") == location.pathname) {
					navItem.addClass("active");
				}
			});
			
			var tmpData = null;
			var obj = {};
			
			$(function () {
				$("input").focus(function () {
					var def = $(this).val();
					$(this).keyup(function () {
						var cur1 = $(this).val();
						if(def != cur1) {
							$(this).blur(function () {
								$(this).css("background-color", "#adccff");
								$(this).css("color", "black");
								$(this).addClass("promenjen");
							});
						}
					});
				});
				
				$("select").change(function () {
					$(this).blur(function () {
						$(this).css("background-color", "#adccff");
						$(this).css("color", "black");
						$(this).addClass("promenjen");
					});
				});
				
				$('.azuriraj').click(function () {
					$('.promenjen').each(function (index, item) {
						var vrednost = null;
						if($(this).is('select')) {
							vrednost = $('option:selected',this).text();
						} else {
							vrednost = $(this).val();
						}
						$(this).removeClass('promenjen');
						var kolona = $(this).attr('class');
						var id_entiteta = $(this).closest('tr').attr('id');
						var baza = $(this).closest('table').attr('id').replace('Tabela', '');
						
						$.post('php/azurirajTabelu.php', {
							'vrednost': vrednost,
							'kolona': kolona,
							'id_entiteta': id_entiteta,
							'baza': baza,
						});
						
						alert("UPDATE " + baza + " SET `" + kolona + "`=" + vrednost + " WHERE `id`=" + id_entiteta + ";");
					});
				});
				
				$('.dodaj').click(function () {
					var tabela = $(this).closest('table').attr('id').replace('Tabela', '');
					tabela = tabela.substring(0, 1).toUpperCase() + tabela.substring(1, tabela.length);
					$('.modal > .modal-dialog > .modal-content > .modal-header > h2').html(tabela);
					
					var baza = $(this).closest('table').attr('id').replace('Tabela', '');
					obj["baza"] = baza;
					
					$.post('php/uzmiKolone.php', {
							'tabela' : tabela,
						}, function (data) {
							if(data === null)
								console.error("error");
							else {
								tmpData = data;
								var modal_body = $('.modal > .modal-dialog > .modal-content > .modal-body > form');
								
								for(var x in data) {
									if(data.hasOwnProperty(x)) {
										var tmp = data[x].replace('_', ' ');
										tmp = tmp.toLowerCase().replace(/\b[a-z]/g, function(letter) {
											return letter.toUpperCase();
										});
										if(tmp == "U I") {
											tmp = "Uvoznik/Izvoznik";
											modal_body.html(modal_body.html() + "<div class=\"form-group\"><label for=\"" + data[x] + "\">" + tmp + ": " +
											"</label><select id=\"" + data[x] + "\" class=\"update\" style=\"margin-left: 10px;\"><option value=\"Oba\">Oba</option><option value=\"Uvoznik\">Uvoznik</option><option value=\"Izvoznik\">Izvoznik</option></select></div>");
										} else {
											modal_body.html(modal_body.html() + "<div class=\"form-group\"><label for=\"" + data[x] + "\">" + tmp + ": " +
											"</label><input type=\"text\" id=\"" + data[x] + "\" class=\"update\" style=\"margin-left: 10px;\"></div>");
										}
									}
								}
							}
					});
				});
				
				$('#dodaj').click(function () {
					var inputi = $('.update');
					
					for(var i = 0; i < inputi.length; i++) {
						var imeKolone = inputi[i].id;
						obj[imeKolone] = inputi[i].value;
					}
					
					$.post('php/napraviNovi.php', obj);
				});
				
				$('.obrisi').click(function () {
					if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
						var red_id = $(this).closest('tr').attr('id');
						var baza = $(this).closest('table').attr('id').replace('Tabela', '');
						
						$.post('php/obrisiRed.php', {
							'red_id': red_id,
							'baza': baza
						});
					}
					else{
						return false;
					}
				});
			});
		</script>
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
						<a class="btn btn-success" id="dodaj">Dodaj</a>
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
					<ul class="nav nav-pills flex-column">
						<li class="nav-item">
							<a class="nav-link active" id="buttonNalogodavci" href="#tableNalogodavac" role="tab" data-toggle="tab" aria-controls="tableNalogodavac" aria-selected="true">
								Nalogodavci <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="buttonTegljaci" href="#tableTegljac" role="tab" data-toggle="tab" aria-controls="tableTegljac" aria-selected="false">
								Tegljaci
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
									</th><th>MESTO</th><th>ADRESA</th><th>POSTANSKI BROJ</th><th>PIB</th><th>PAK</th><th>ROK PLACANJA</th></tr></thead>";
									while($row = $result->fetch_assoc()) {
										echo "<tr id=\"" . $row['id'] . "\"><td class=\"text-center\">" . $brojac++ . ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td>
										<td><input value=\"" . $row['ime'] . "\" class=\"ime\"></td><td><input value=\"" . $row['mesto'] .
										"\" class=\"mesto\"></td><td><input value=\"" . $row['adresa'] . "\" class=\"adresa\"></td><td><input value=\"" . $row['postanski_broj'] .
										"\" class=\"postanski_broj\"></td><td><input value=\"" . $row['pib'] . "\" class=\"pib\"><td><input value=\"" . $row['pak'] .
										"\" class=\"pak\"></td><td><input value=\"" . $row['rok_placanja'] . "\" class=\"rok_placanja\"></td></tr>";
									}
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Azuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
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
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Azuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
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
									echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Azuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
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
										echo "<thead class=\"thead\"><tr class=\"table-active\"><th>br.</th><th>ime</th><th>u_i</th></tr></thead>";
										
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
										echo "<tr><td><div class=\"text-center\"><a class=\"btn btn-dark btn-sm azuriraj\">Azuriraj</a><br><br><a class=\"btn btn-success btn-sm dodaj\"><i class=\"fas fa-plus\"></i></a></div></td></tr>";
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