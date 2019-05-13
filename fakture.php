<?php
    include 'php/dbh.php';
	include 'navbar.php';

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
		<div class="container" style="margin-top: 40px;">
			<form>
        <div class="form-row">
					<div class="form-group mb-3 col-md-4">
						<label for="nalogodavac">Nalogodavac:</label>
						<input type="text" class="form-control" list="listaNalogodavci" id="nalogodavac" placeholder="Izaberite nalogodavca:" onmousedown="value = '';">
						<datalist id="listaNalogodavci">
							<?php
									$sql = "SELECT id, ime FROM nalogodavci";
									$result = $conn->query($sql);

									if($result->num_rows > 0)
									{
										while($row = $result->fetch_assoc()) {
											echo '<option id="' . $row['id'] . '"value="' . $row["ime"] . '"/>';
									}
									} else {
										print "0 podataka pronadjeno.";
									}
								?>
						</datalist>
					</div>
          <div class="form-group col-md-2 offset-md-1" id="vrsta_fakture" style="display: none;">
            <br>
            <label class="radio-inline"><input type="radio" name="vrsta_fakture" value="kla_faktura"checked> Klasična faktura</label>
            &nbsp;&nbsp;
            <label class="radio-inline"><input type="radio" name="vrsta_fakture" value="ava_faktura"> Avansna faktura</label>
          </div>
        </div>
				<div class="form-row">
					<div class="form-group col-md-3">
						<label class="radio-inline"><input type="radio" name="kamion" value="nas_kamion"checked> Naš kamion</label>
						&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="kamion" value="ang_kamion"> Angažovani kamion</label>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-1">
						<label for="broj_ture">Broj ture:</label>
						<input type="text" class="form-control" id="broj_ture" value="<?php
							$sql = "SELECT prvi FROM brojevi";
							$result = $conn->query($sql);

							if($result->num_rows > 0) {
								$row = $result->fetch_assoc();
								echo $row['prvi'] + 1;
							}
						?>">
					</div>
        </div>
        <div class="form-row" id="utovar" style="display: none;">
          <div class="form-group col-md-2">
						<label for="datum_utovara">Datum utovara:</label>
						<input type="date" class="form-control" id="datum_utovara">
					</div>
					<div class="form-group col-md-2 offset-md-1">
						<label for="dan_utovara_kurs">Kurs na dan utovara:</label>
						<div class="input-group">
							<input type="text" class="form-control" id="dan_utovara_kurs">
							<div class="input-group-append">
								<span class="input-group-text">din.</span>
							</div>
						</div>
					</div>
        </div>
        <div class="form-row" id="istovar" style="display: none;">
          <div class="form-group col-md-2">
						<label for="datum_istovara">Datum istovara:</label>
						<input type="date" class="form-control" id="datum_istovara">
					</div>
					<div class="form-group col-md-2 offset-md-1">
						<label for="dan_istovara_kurs">Kurs na dan istovara:</label>
						<div class="input-group">
							<input type="text" class="form-control" id="dan_istovara_kurs">
							<div class="input-group-append">
								<span class="input-group-text">din.</span>
							</div>
						</div>
					</div>
        </div>
				<div class="form-row">
					<div class="form-group col-md-1">
						<label for="komplet_broj">Komplet:</label>
						<input type="text" class="form-control" id="komplet_broj">
					</div>
					<div class="form-group col-md-2">
						<label for="datum_prometa_usluge">Datum prometa usluge:</label>
						<input type="date" class="form-control" id="datum_prometa_usluge">
					</div>
          <div class="form-group col-md-2" id="kurs" style="display: none;">
						<label for="kurs_rucni">Kurs EUR:</label>
            <div class="input-group">
							<input type="text" class="form-control" id="kurs_rucni">
							<div class="input-group-append">
								<span class="input-group-text">din.</span>
							</div>
						</div>
          </div>
					<div class="form-group col-md-3">
						<label for="rok_placanja_usluge">Rok plaćanja usluge:</label>
						<input type="text" class="form-control" id="rok_placanja_usluge">
					</div>
					<div class="form-group col-md-3" style="display: none;">
						<label for="valuta_placanja">Valuta plaćanja:</label>
						<input type="date" class="form-control" id="valuta_placanja">
					</div>
				</div>
        <div class="form-row" id="nas_kamion">
            <div class="form-group col-md-3">
  						<label for="tegljac">Tegljač:</label>
  						<div class="input-group mb-3">
  							<select class="custom-select" id="tegljac">
  								<option value="0" selected>Izaberite tegljač:</option>
  								<?php
  									$sql = "SELECT id, marka, broj_registracije FROM tegljaci";
  									$result = $conn->query($sql);

  									if($result->num_rows > 0)
  									{
  										while($row = $result->fetch_assoc()) {
  											echo '<option value="' . $row["id"] . '">'. $row["marka"] . ': ' . $row["broj_registracije"]. '</option>';
  										}
  									} else {
  										print "0 podataka pronadjeno.";
  									}
  								?>
  							</select>
  						</div>
            </div>
            <div class="form-group col-md-3">
              <label for="prikolica">Prikolica:</label>
				      <div class="input-group mb-3">
				        <select class="custom-select" 	id="prikolica">
    							<option value="0" selected>Izaberite prikolicu:</option>
    							<?php
    								$sql = "SELECT id, marka, broj_registracije FROM prikolice";
    								$result = $conn->query($sql);

    								if($result->num_rows > 0)
    								{
    									while($row = $result->fetch_assoc()) {
    										echo '<option value="' . $row['id'] . '">' . $row['marka'] . ': ' . $row['broj_registracije'] . '</option>';
    									}
    								} else {
    									print "0 podataka pronadjeno.";
    								}
    							?>
  							</select>
				        </div>
              </div>
        </div>
				<div class="form-row" id="ang_kamion" style="display: none;">
					<div class="form-group col-md-3">
						<label for="ang_tegljac">Angažovani tegljač:</label>
						<input type="text" class="form-control" id="ang_tegljac">
					</div>
					<div class="form-group col-md-3">
						<label for="ang_prikolica">Angažovana prikolica:</label>
						<input type="text" class="form-control" id="ang_prikolica">
					</div>
				</div>
			    <div class="form-group">
					<div class="tab-content" id="myTabContent">
						<div class="form-row">
							<div class="form-group col-md-3">
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
              <div class="form-group col-md-1" style=" margin-right: -20px">
								<button class="btn btn-success btn-small drzava" style="margin-top: 29px;margin-bottom: -20px;" id="odDrzava">SRB</button>
							</div>
							<div class="form-group col-md-3">
							  <label for="do">Do:</label>
							  <input type="text" list="listaGradovi" class="form-control" id="do" autocomplete="off">
							</div>
              <div class="form-group col-md-1" style=" margin-right: -20px">
								<button class="btn btn-success btn-small drzava" style="margin-top: 29px;margin-bottom: -20px;" id="doDrzava">I</button>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3 brojNaloga">
								<label for="broj_naloga">Broj naloga:</label>
								<input type="text" class="form-control" id="broj_naloga">
							</div>
              <div class="form-group col-md-3">
								<label for="cmr">CMR:</label>
								<input type="text" class="form-control" id="cmr">
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
						<div class="form-row" id="cena_default">
							<div class="form-group col-md-3">
								<label for="iznos">Cena:</label>
								<div class="input-group">
									<input type="text" class="form-control" id="iznos">
									<div class="input-group-append">
									<span id="eurdin" class="input-group-text">&euro;</span>
									</div>
								</div>
							</div>
							<div class="form-group col-md-3">
								<label for="iznos_din">Cena u dinarima:</label>
								<div class="input-group">
									<input type="text" class="form-control" id="iznos_din">
									<div class="input-group-append">
										<span class="input-group-text">din.</span>
									</div>
								</div>
							</div>
						</div>
            <div id="cena_milsped" style="display: none; margin-top: 20px;">
              <div class="form-row">
                <div class="form-group col-md-3">
									<label for="cena_u_celosti_eur">Cena u celosti:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="cena_u_celosti_eur">
										<div class="input-group-append">
										<span class="input-group-text">&euro;</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-3">
									<label for="cena_domaci_deo_eur">Domaći deo:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="cena_domaci_deo_eur">
										<div class="input-group-append">
											<span class="input-group-text">&euro;</span>
										</div>
									</div>
								</div>
                <div class="form-group col-md-3">
									<label for="cena_inostrani_deo_eur">Inostrani deo:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="cena_inostrani_deo_eur">
										<div class="input-group-append">
											<span class="input-group-text">&euro;</span>
										</div>
									</div>
								</div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
									<label for="cena_u_celosti_din">Cena u celosti u dinarima:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="cena_u_celosti_din">
										<div class="input-group-append">
										<span class="input-group-text">din.</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-3">
									<label for="cena_domaci_deo_din">Domaći deo u dinarima:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="cena_domaci_deo_din">
										<div class="input-group-append">
											<span class="input-group-text">din.</span>
										</div>
									</div>
								</div>
                <div class="form-group col-md-3">
									<label for="cena_inostrani_deo_din">Inostrani deo u dinarima:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="cena_inostrani_deo_din">
										<div class="input-group-append">
											<span class="input-group-text">din.</span>
										</div>
									</div>
								</div>
              </div>
            </div>
					</div>
			  </div>
			 <button type="submit" class="btn btn-success" id="napravi">Napravi</button>
			</form>
      <?php
          $conn->close();
      ?>
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
	</body>
	<script src="js/main.js"></script>
</html>
