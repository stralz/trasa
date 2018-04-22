$file = "https://www.nbs.rs/static/nbs_site/gen/cirilica/30/kurs/IndikativniKurs.htm";

$doc = new DOMDocument(); $doc->loadHTMLFile($file);

$xpath = new DOMXpath($doc);

$elements = $xpath->query("//tr[3]/td[1]");

if (!is_null($elements)) { foreach ($elements as $element) { $nodes = $element->childNodes; foreach ($nodes as $node) { echo $node->nodeValue; } } }

var kursEUR = document.getElementById("kursEUR").text.replace(/\s/g, '').replace(',', '.');

relacije query-i, treba dodati za nalogodavci_gradovi a ne za gradovi, slovima.js

Sta treba regulisati: -posiljalac2 i primalac2 ne rade; -jedan nalogodavac ne radi kako treba;
