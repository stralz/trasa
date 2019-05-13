<?php
	
	if(isset($_POST["datum"])) {
		$datum = $_POST["datum"];
		$file = "https://www.navidiku.rs/kursna-lista/kursna-lista-nbs/$datum";
		
		$doc = new DOMDocument(); @$doc->loadHTMLFile($file);
		$xpath = new DOMXpath($doc);

		$elements = $xpath->query("//table[@class='tabela']/tbody/tr/td[4]");

		if (!is_null($elements)) {
			
			echo $elements[0]->childNodes[0]->nodeValue;
		}
	}
?>