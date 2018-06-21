<?php
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
		<?php include 'navbar.php'; ?>
		<div class="container" style="margin-top: 40px;">
			<form>
                <div class="form-row">
				        <label for="nalogodavac">Nalogodavac:</label>
				        <div class="input-group mb-3">
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
                                        print "0 podataka pronadjeno.";
                                    }
                                ?>
				        </select>
				        </div>
			     </div>
				 <div class="form-row">
					<div class="form-group col-md-3">
						<label for="racun_broj">Komplet:</label>
						<input type="text" class="form-control" id="racun_broj">
					</div>
					<div class="form-group col-md-3">
						<label for="datum_prometa_usluge">Datum prometa usluge:</label>
						<input type="date" class="form-control" id="datum_prometa_usluge">
					</div>
					<div class="form-group col-md-3">
						<label for="rok_placanja_usluge">Rok placanja usluge:</label>
						<input type="text" class="form-control" id="rok_placanja_usluge">
					</div>
				</div>
                 <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="tegljac">Tegljac:</label>
				        <div class="input-group mb-3">
							<select class="custom-select" id="tegljac">
							   <option selected>Izaberite tegljaca</option>
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
                     <div class="form-group col-md-4">
                    <label for="prikolica">Prikolica:</label>
				        <div class="input-group mb-3">
				        <select class="custom-select" 	id="prikolica">
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
									print "0 podataka pronadjeno.";
								}
							?>
							</select>
				        </div>
                    </div>
                </div>
			    <div class="form-group">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="prvi-tab" data-toggle="tab" href="#prvi" role="tab" aria-controls="prvi" aria-selected="true">1</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="drugi-tab" data-toggle="tab" href="#drugi" role="tab" aria-controls="drugi" aria-selected="false">2</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="treci-tab" role="tab" href="#drugi">+</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="prvi" role="tabpanel" aria-labelledby="prvi-tab">
							<div class="form-row">
								<div class="form-group col-md-3">
								  <label for="od1">Od:</label>
								  <input type="text" list="listaGradovi" class="form-control" id="od1" autocomplete="off">
								</div>
								<datalist id="listaGradovi">
									
								</datalist>
								<div class="form-group col-md-1" style=" margin-right: -20px">
									<div class="radio" name="od1Radio" style="margin-top: 20px; margin-bottom: -20px;">
										<label><input type="radio" name="od1Radio">SRB</label>
										<br>
										<label><input type="radio" name="od1Radio">ITA</label>
									</div>
								</div>
								<div class="form-group col-md-3">
								  <label for="do1">Do:</label>
								  <input type="text" list="listaGradovi" class="form-control" id="do1" autocomplete="off">
								</div>
								<div class="form-group col-md-1" style=" margin-right: -20px">
									<div class="radio" name="do1Radio" style="margin-top: 20px; margin-bottom: -20px;">
										<label><input type="radio" name="do1Radio">SRB</label>
										<br>
										<label><input type="radio" name="do1Radio">ITA</label>
									</div>
								</div>
								<div class="form-group col-md-1">
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:29px;">
										<i class="fas fa-location-arrow"></i>
										</button>
										<div class="dropdown-menu" id="dropdownRelacije1">
											
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6 brojNaloga1">
									<label for="broj_naloga1">Broj naloga:</label>
									<input type="text" class="form-control" id="broj_naloga1">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="cmr1">CMR:</label>
									<input type="text" class="form-control" id="cmr1">
								</div>
								<div class="form-group col-md-3">
									<label for="tezina1">Tezina:</label>
									<input type="text" class="form-control" id="tezina1">
								</div>
							</div>
							<div class="form-row posiljalacPrimalac1">
								<div class="form-group col-md-3">
									<label for="mesto_utovara1">Posiljalac:</label>
									<input type="text" list="listaPosiljalac1" class="form-control" id="posiljalac1">
									<datalist id="listaPosiljalac1">
										<?php
											$sql = "SELECT ime, u_i FROM uvoznici_izvoznici WHERE `u_i`=\"Izvoznik\" OR `u_i`=\"Oba\"";
											$result = $conn->query($sql);

											if($result->num_rows > 0)
											{
												while($row = $result->fetch_assoc()) {
													echo "<option value=\"" . $row["ime"] . "\">";
												}
											}
										?>
									</datalist>
								</div>
								<div class="form-group col-md-3">
									<label for="mesto_istovara1">Primalac:</label>
									<input type="text" list="listaPrimalac1" class="form-control" id="primalac1">
									<datalist id="listaPrimalac1">
										<?php
											$sql = "SELECT ime, u_i FROM uvoznici_izvoznici WHERE `u_i`=\"Uvoznik\" OR `u_i`=\"Oba\"";
											$result = $conn->query($sql);

											if($result->num_rows > 0)
											{
												while($row = $result->fetch_assoc()) {
													echo "<option value=\"" . $row["ime"] . "\">";
												}
											} else {
												print "0 podataka pronadjeno.";
											}
										?>
									</datalist>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="iznos1">Cena:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="iznos1">
										<div class="input-group-append">
										<span id="eurdin" class="input-group-text">&euro;</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="drugi" role="tabpanel" aria-labelledby="drugi-tab">
							<div class="form-row">
								<div class="form-group col-md-3">
								  <label for="od2">Od:</label>
								  <input type="text" list="listaGradovi" class="form-control" id="od2" autocomplete="off">
								</div>
								<div class="form-group col-md-1" style=" margin-right: -20px">
									<div class="radio" name="od2Radio" style="margin-top: 20px; margin-bottom: -20px;">
										<label><input type="radio" name="od2Radio">SRB</label>
										<br>
										<label><input type="radio" name="od2Radio">ITA</label>
									</div>
								</div>
								<div class="form-group col-md-3">
								  <label for="do2">Do:</label>
								  <input type="text" list="listaGradovi" class="form-control" id="do2" autocomplete="off">
								</div>
								<div class="form-group col-md-1" style=" margin-right: -20px">
									<div class="radio" name="do2Radio" style="margin-top: 20px; margin-bottom: -20px;">
										<label><input type="radio" name="do2Radio">SRB</label>
										<br>
										<label><input type="radio" name="do2Radio">ITA</label>
									</div>
								</div>
								<div class="form-group col-md-1">
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:29px;">
										<i class="fas fa-location-arrow"></i>
										</button>
										<div class="dropdown-menu" id="dropdownRelacije2">
											
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6 brojNaloga2">
									<label for="broj_naloga2">Broj naloga:</label>
									<input type="text" class="form-control" id="broj_naloga2">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="cmr2">CMR:</label>
									<input type="text" class="form-control" id="cmr2">
								</div>
								<div class="form-group col-md-3">
									<label for="tezina2">Tezina:</label>
									<input type="text" class="form-control" id="tezina2">
								</div>
							</div>
							<div class="form-row posiljalacPrimalac2">
								<div class="form-group col-md-3">
									<label for="posiljalac2">Posiljalac:</label>
									<input type="text" list="listaPosiljalac2" class="form-control" id="posiljalac2">
									<datalist id="listaPosiljalac2">
										<?php
											$sql = "SELECT ime, u_i FROM uvoznici_izvoznici WHERE `u_i`=\"Izvoznik\" OR `u_i`=\"Oba\"";
											$result = $conn->query($sql);

											if($result->num_rows > 0)
											{
												while($row = $result->fetch_assoc()) {
													echo "<option value=\"" . $row["ime"] . "\">";
												}
											} else {
												print "0 podataka pronadjeno.";
											}
										?>
									</datalist>
								</div>
								<div class="form-group col-md-3">
									<label for="primalac2">Primalac:</label>
									<input type="text" list="listaPrimalac2" class="form-control" id="primalac2">
									<datalist id="listaPrimalac2">
										<?php
											$sql = "SELECT ime, u_i FROM uvoznici_izvoznici WHERE `u_i`=\"Uvoznik\" OR `u_i`=\"Oba\"";
											$result = $conn->query($sql);

											if($result->num_rows > 0)
											{
												while($row = $result->fetch_assoc()) {
													echo "<option value=\"" . $row["ime"] . "\">";
												}
											} else {
												print "0 podataka pronadjeno.";
											}
										?>
									</datalist>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="iznos2">Cena:</label>
									<div class="input-group">
										<input type="text" class="form-control" id="iznos2">
										<div class="input-group-append">
										<span class="input-group-text">&euro;</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="treci" role="tabpanel" aria-labelledby="treci-tab"></div>
					</div>
			  </div>
			 <button type="submit" class="btn btn-primary" id="napravi">Napravi</button>
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