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
		
		<script src="js/obracuni.js"></script>
	</head>
	<body>
		<div class="modal fade" id="modalTrosak">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title pull-left">Trosak</h2>
						<button class="close" type="button" data-dismiss="modal" onclick="clearModalBody()">x</button>
					</div>
					<div class="modal-body" id="trosakModalBody">
						<form>
							<div class="form-group">
								<label for="datum">Datum:</label>
								<input type="date" id="trosakDatum" style="margin-left: 10px;" class="col-sm-4 form-control" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="trosak">Trosak:</label>
								<input type="text" list="listTroskovi" id="trosak" class="col-sm-4 form-control" style="margin-left: 10px;" autocomplete="off">
								<datalist id="listTroskovi">
									<?php
										$sql = "SELECT DISTINCT naziv FROM troskovi";
										
										$result = $conn->query($sql);
										if($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												echo "<option value=\"" . $row["naziv"] . "\">";
											}
										}
									?>
								</datalist>
							</div>
							<div class="form-group">
								<label for="iznosTroska">Iznos troska:</label>
								<input type="text" id="trosakIznos" style="margin-left: 10px;" class="col-sm-4 form-control" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="valuta">Valuta:</label>
								<select id="trosakValuta" class="col-sm-4 form-control" style="margin-left: 10px;">
									<option selected>Izaberite valutu</option>
									<option value="EUR">EUR</option>
									<option value="KN">KN</option>
									<option value="RSD">RSD</option>
								</select>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<a class="btn btn-success" data-dismiss="modal" id="dodajTrosak">Dodaj trosak</a>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalGorivo">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title pull-left">Sipanje</h2>
						<button class="close" type="button" data-dismiss="modal" onclick="clearModalBody()">x</button>
					</div>
					<div class="modal-body" id="gorivoModalBody">
						<form>
							<div class="form-group">
								<label for="gorivoDatum">Datum:</label>
								<input type="date" id="gorivoDatum" style="margin-left: 10px;" class="col-sm-4 form-control" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="kilometraza">Kilometraza:</label>
								<input type="text" id="kilometraza" class="col-sm-4 form-control" style="margin-left: 10px;" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="mestoTankiranja">Mesto tankiranja:</label>
								<input type="text" id="mestoTankiranja" list="listMestoTankiranja" style="margin-left: 10px;" class="col-sm-4 form-control" autocomplete="off">
								<datalist id="listMestoTankiranja">
									<?php
										$sql = "SELECT * FROM benzinske_stanice";
										$result = $conn->query($sql);
										if($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												echo "<option value=\"" . $row["naziv"] . "\">";
											}
										}
									?>
								</datalist>
							</div>
							<div class="form-group">
								<label for="kolicinaLitara">Kolicina litara:</label>
								<input type="text" id="kolicinaLitara" style="margin-left: 10px;" class="col-sm-4 form-control" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="cenaPoLitru">Cena po litru:</label>
								<input type="text" id="cenaPoLitru" style="margin-left: 10px;" class="col-sm-4 form-control" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="kojaFaktura">Faktura:</label>
									<div class="radio">
										<label><input type="radio" name="valuta"> EUR</label>
									</div>
									<div class="radio">
										<label><input type="radio" name="valuta"> RSD</label>
									</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<a class="btn btn-success" data-dismiss="modal" id="dodajGorivo">Dodaj sipanje</a>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<!-- Gornji deo stranice, FAKTURA -->
			
			<div class="row" style="margin-top: 40px;">
			
				<div class="col-md-6" id="fakture">
					<label for="faktura1">Faktura: </label> &nbsp;<a class="btn btn-success btn-sm" id="dodajFakturu" style="margin-bottom: 5px;"><i class="fas fa-plus"></i></a>
					<input type="text" list="listaFaktura" id="faktura1" class="form-control">
					<datalist id="listaFaktura">
						<?php
							$sql = "SELECT racun_broj FROM fakture";
							$result = $conn->query($sql);
							
							if($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<option value=\"" . $row["racun_broj"] . "\">";
								}
							} else {
								echo "<option value=\"0 rezultata\">";
							}
						?>
					</datalist>
					<br>
					<div id="divFaktura2" style="display: none; margin-bottom: 15px;">
						<label for="faktura2">Faktura:</label>
						<input type="text" list="listaFaktura" id="faktura2" class="form-control">
					</div>
					<div id="sacuvajDugme">
						<button id="sacuvaj" class="btn btn-success btn-sm">
							<i class="far fa-save"></i> Sacuvaj
						</button>
					</div>
				</div>
				<div class="col-md-6" id="rekapitulacija">
					<h5 id="odlazak">Odlazna tura: </h5>
					<h5 id="povratak" style="display: none;">Povratna tura: </h5>
					<h5 id="plata">Plata: </h5>
					<h3 id="ostalo"><strong>Ostalo: </strong></h5>
				</div>
			</div>
			
			<!-- Srednji deo stranice, TROSKOVI -->
			
			<div class="row" style="margin-top: 40px;">
				<div class="col-md-6">
					<h3><strong>Troskovi</strong> <a id="otvoriModal" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTrosak">
									Dodaj trosak
								  </a>
					</h3>
					<table class="table table-bordered" id="tableTroskovi">
						<thead class="thead">
							<tr>
								<th></th>
								<th id="racun_broj1">Racun br. 1</th>
								<th id="racun_broj2"></th>
								<th></th>
							</tr>
							<tr>
								<th>R.B</th>
								<th>Datum</th>
								<th>Trosak</th>
								<th>Iznos</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<thead>
							<tr id="pomocniRed1">
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th>TOTAL</th>
								<th id="troskoviTotalEUR">EUR: 0</th>
								<th id="troskoviTotalKN">KN: 0</th>
								<th id="troskoviTotalRSD">RSD: 0</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			
			<!-- Donji deo stranice, GORIVO, PONDERISANA CENA-->
			<div class="row" style="margin-top: 40px;">
				<div class="col-md-9">
					<h3><strong>Sipanja</strong> <a id="otvoriModalGorivo" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalGorivo">
							Dodaj sipanje
						</a>
					</h3>
					<table id="tableGorivo" class="table table-bordered">
						<thead class="thead">
							<tr>
								<th>R.B</th>
								<th>Datum</th>
								<th>Kilometraza</th>
								<th>Mesto tankiranja</th>
								<th>Iznos</th>
								<th>Kolicina litra</th>
								<th>Cena po litru</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						<thead>
							<tr id="pomocniRed2">
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th>TOTAL</th>
								<th id="gorivoTotalEUR">EUR: 0</th>
								<th id="gorivoTotalRSD">RSD: 0</th>
								<th id="gorivoTotalL">L: 0</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- Donji deo stranice, PONDERISANA CENA-->
				<div class="col-md-3">
					<h5>Ponderisana cena 1. </h6><span><strong style="font-size: 25px;" id="ponderisana1"><u></u></strong></span>
					<h5>Ponderisana cena 2. </h6><span><strong style="font-size: 25px;" id="ponderisana2"><u></u></strong></span>
				</div>
			</div>
			
			<!-- Donji deo stranice, KILOMETRAZA I POTROSNJA -->
			<div class="row" style="margin-top: 40px;">
				<div class="col-md-4">
					<h3><strong>Kilometraza i potrosnja</strong>
					</h3>
					<form>
						<div class="form-row">
							<label for="pocetnaKilometraza">Pocetna kilometraza: </label>
							<input type="text" class="form-control kip" id="pocetnaKilometraza">
						</div>
						<div class="form-row">
							<label for="zavrsnaKilometraza">Zavrsna kilometraza: </label>
							<input type="text" class="form-control kip" id="zavrsnaKilometraza">
						</div>
						<div class="form-row">
							<label for="ukupnoKilometara">Ukupno kilometara: </label>
							<input type="text" class="form-control kip font-weight-bold" id="ukupnoKilometara" style="color: black;">
						</div>
						<div class="form-row">
							<label for="potrosnja">Potrosnja: </label>
							<input type="text" class="form-control kip" id="potrosnja">
						</div>
						<div class="form-row">
							<label for="ukupnoPotrosenoLitara">Ukupno potroseno litara: </label>
							<input type="text" class="form-control kip font-weight-bold" id="ukupnoPotrosenoLitara" style="color: black;">
						</div>
						<div class="form-row" style="margin-top: 10px;">
							<button class="btn btn-success" id="azurirajKiP">Azuriraj</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<a style="display: none;" id="kursEUR">
			<?php
				$file = "https://www.nbs.rs/static/nbs_site/gen/cirilica/30/kurs/IndikativniKurs.htm";

				$doc = new DOMDocument(); $doc->loadHTMLFile($file);

				$xpath = new DOMXpath($doc);

				$elements = $xpath->query("//tr[3]/td[1]");

				if (!is_null($elements)) {
					foreach ($elements as $element) {
						$nodes = $element->childNodes;
						foreach ($nodes as $node) {
							echo $node->nodeValue;
						}
					}
				}
			?>
		</a>
		<a id="procenat" style="display: none;">
		</a>
	</body>
	<script src="js/main.js"></script>
</html>