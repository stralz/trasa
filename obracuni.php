<?php
	include 'navbar.php';
	include 'php/dbh.php';
?>
<!doctype html>
<html lang="en">
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		<div class="container-fluid">
			<!-- Gornji deo stranice, fakutra -->
			<div class="row" style="margin-top: 40px;">
			
				<div class="col-md-6">
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
					<div id="divFaktura2" style="display: none;">
						<label for="faktura2">Faktura:</label>
						<input type="text" list="listaFaktura" id="faktura2" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<table class="table table-bordered">
						<thead class="thead">
							<tr>
								<th>Company</th>
								<th>Contact</th>
								<th>Country</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Alfreds Futterkiste</td>
								<td>Maria Anders</td>
								<td>Germany</td>
							</tr>
							<tr>
								<td>Centro comercial Moctezuma</td>
								<td>Francisco Chang</td>
								<td>Mexico</td>
							</tr>
							<tr>
								<td>Ernst Handel</td>
								<td>Roland Mendel</td>
								<td>Austria</td>
							</tr>
						</tbody>
					</table> 
				</div>
			</div>
			<!-- Srednji deo stranice, troskovi -->
			<div class="row" style="margin-top: 40px;">
				<div class="col-md-6">
					<h3>Troskovi</h3>
					<table class="table table-bordered" id="tableTroskovi">
						<thead class="thead">
							<tr>
								<th></th>
								<th id="racun_broj1">Racun br. 1</th>
								<th id="racun_broj2"></th>
								<th>
									<a style="margin: -10 -7 -7 -7;" id="otvoriModal" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTrosak">
										Dodaj trosak
									</a>
								</th>
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
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th>TOTAL</th>
								<th id="totalEUR">EUR: 0</th>
								<th id="totalKN">KN: 0</th>
								<th id="totalRSD">RSD: 0</th>
							</tr>
						</thead>
					</table>
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
		<a style="display: none;" id="tmp">
		</a>
	</body>
	<script src="js/main.js"></script>
</html>