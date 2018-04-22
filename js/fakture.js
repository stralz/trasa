var tabela = "fakture";
var id_fakture = 0;
var obj = {};
var obj1 = {};
var domaci = false;
var dveTure = false;
var sablon = "";

function clearModalBody() {
	$('.modal > .modal-dialog > .modal-content > .modal-body > form').empty();
}

function addDays(date, days, domaci) {
	if(!domaci) {
		var result = new Date(date);
		var result1 = new Date(result);
		
		if(result1.getMonth() == 11) {
			result = new Date(result1.getFullYear() + 1, 0, 1);
		} else {
			result = new Date(result1.getFullYear(), result1.getMonth() + 1, 1);
		}
	  
		result.setDate(result.getDate() + days);
	  
		var dd = result.getDate();
		var mm = result.getMonth() + 1;
		var yyyy = result.getFullYear();
	  
		return yyyy + '-' + mm + '-' + dd;
	} else {
		var result = new Date(date);
		result.setDate(result.getDate() + days);
		
		var dd = result.getDate();
		var mm = result.getMonth() + 1;
		var yyyy = result.getFullYear();
	  
		return yyyy + '-' + mm + '-' + yyyy;
	}
}

function vratiDatum(datepicker) {
	var tmp = document.getElementById(datepicker).value;
	var date = tmp.split('-');
	var day = date[2];
	var month = date[1];
	var year = date[0];
	return day + '.' + month + '.' + year;
}

function loadFile(url,callback){
	JSZipUtils.getBinaryContent(url,callback);
}

$(function () {
	$(".uredi_dugme").click(function () {
		var idFakture = $(this).closest('tr').attr('id');
		id_fakture = idFakture;
		$.post('php/uzmiKolone.php', {
				'id' : idFakture,
			}, function (data) {
						$("#pomocniKurs").text(data.kursEUR);
					// Start ubacivanja u inpute
						$("#nalogodavac").val(data.fk_nalogodavac);
						$("#racun_broj").val(data.racun_broj);
						$("#valuta_placanja").val(data.valuta_placanja);
						$("#mesto_prometa").val(data.mesto_prometa);
						$("#mesto_izdavanja_racuna").val(data.mesto_izdavanja_racuna);
						$("#tegljac").val(data.fk_tegljac);
						$("#prikolica").val(data.fk_prikolica);
						$("#od1").val(data.od1);
						$("#do1").val(data.do1);
						$("#cmr1").val(data.cmr1);
						$("#tezina1").val(data.tezina1);
						$("#iznos1").val(data.iznos1);
						
						var date = data.datum_izdavanja;
						var day = date.substr(0, 2);
						var month = date.substr(3, 2);
						var year = date.substr(6, 4);
						date = year + "-" + month + "-" + day;
						$("#datum_izdavanja").val(date);
						
						date = data.valuta_placanja;
						day = date.substr(0, 2);
						month = date.substr(3, 2);
						if(month >= 10)
							month = "0" + month;
						year = date.substr(6, 4);
						date = year + "-" + month + "-" + day;
						$("#valuta_placanja").val(date);
					// End ubacivanja u inpute
					
				if(data.sablon.includes("1")) {
					if(data.sablon.includes("Dinarski")) {
						// Sakrije broj naloga 1
						$("#broj_naloga1").hide();
						$("label[for='broj_naloga1']").hide();
						
						// Ubacuje Posiljaoca 1
						$("#mesto_utovara1").val(data.mesto_utovara1);
						// Ubacuje Primaoca 1
						$("#mesto_istovara1").val(data.mesto_istovara1);
					} else {
						// Sakrije mesto istovara 1
						$("#mesto_istovara1").hide();
						$("label[for='mesto_istovara1']").hide();
						// Sakrije mesto utovara 1
						$("#mesto_utovara1").hide();
						$("label[for='mesto_utovara1']").hide();
						
						// Ubacuje Broj naloga 1
						$("#broj_naloga1").val(data.broj_naloga1);
					}
					// Start sakrivanja svih sa '2' u imenu
						$("#od2").hide();
						$("label[for='od2']").hide();
						$("#do2").hide();
						$("label[for='do2']").hide();
						$("#broj_naloga2").hide();
						$("label[for='broj_naloga2']").hide();
						$("#cmr2").hide();
						$("label[for='cmr2']").hide();
						$("#tezina2").hide();
						$("label[for='tezina2']").hide();
						$("#mesto_istovara2").hide();
						$("label[for='mesto_istovara2']").hide();
						$("#mesto_utovara2").hide();
						$("label[for='mesto_utovara2']").hide();
						$("#iznos2").hide();
						$("label[for='iznos2']").hide();
					// Kraj sakrivanja svih sa '2' u imenu
				} else {
					if(data.sablon.includes("Dinarski")) {
						// Sakrije broj naloga 2
						$("#broj_naloga2").hide();
						$("label[for='broj_naloga2']").hide();
						
						// Ubacuje Posiljaoca 2
						$("#mesto_utovara2").val(data.mesto_utovara2);
						// Ubacuje Primaoca 2
						$("#mesto_istovara2").val(data.mesto_istovara2);
					} else {
						// Sakrije mesto istovara 1
						$("#mesto_istovara1").hide();
						$("label[for='mesto_istovara1']").hide();
						// Sakrije mesto utovara 1
						$("#mesto_utovara1").hide();
						$("label[for='mesto_utovara1']").hide();
						// Sakrije mesto istovara 2
						$("#mesto_istovara2").hide();
						$("label[for='mesto_istovara2']").hide();
						// Sakrije mesto utovara 2
						$("#mesto_utovara2").hide();
						$("label[for='mesto_utovara2']").hide();
						
						// Ubacuje Broj naloga 1
						$("#broj_naloga1").val(data.broj_naloga1);
						// Ubacuje Broj naloga 2
						$("#broj_naloga2").val(data.broj_naloga2);
						// Ubacuje CMR 2
						$("#cmr2").val(data.cmr2);
						// Ubacuje Tezina 2
						$("#tezina2").val(data.tezina2);
						//Ubacuje  Iznos 2
						$("#iznos2").val(data.iznos2);
						// Ubacuje Od 2
						$("#od2").val(data.od2);
						// Ubacuje Do 2
						$("#do2").val(data.do2);
					}
				}
		});
	});
	
	$("#dodaj").click(function () {
		// Start Azuriranje tabele
		var inputi = $('.uredi');
		
		for(var i = 0; i < inputi.length; i++) {
			var imeKolone = inputi[i].id;
			obj[imeKolone] = inputi[i].value;
		}
		
		$('.uredi').each(function (index, item) {
			var vrednost = null;
			if($(this).is('select')) {
				vrednost = $('option:selected',this).text();
			} else {
				vrednost = $(this).val();
			}
			
			var kolona = $(this).attr('id');
			var baza = tabela;
			
			$.post('php/azurirajTabelu.php', {
				'vrednost': vrednost,
				'kolona': kolona,
				'id_entiteta': id_fakture,
				'baza': baza,
			});
		});
		
		// End Azuriranje tabele
		
		// Start Azuriranje dokumenta
		
		var inputi = $('input');
		
		for(var i = 0; i < inputi.length; i++) {
			var imeKolone = inputi[i].id;
			var tmp = inputi[i].value;
			if(tmp.split('-')[0].substr(0, 2) == "20")
				tmp = vratiDatum(inputi[i].id)
			obj1[imeKolone] = tmp;
		}
		
		inputi = $('select');
		
		for(var i = 0; i < inputi.length; i++) {
			var imeKolone = inputi[i].id;
			obj1[imeKolone] = inputi[i].value;
		}
		
		var racunBroj = $("#racun_broj").val();
		var imeNalogodavca = document.getElementById("nalogodavac").options[document.getElementById("nalogodavac").selectedIndex].text;
		obj1["ime_nalogodavca"] = imeNalogodavca;
		obj1["kursEUR"] = $("#pomocniKurs").text().substr(0, $("#pomocniKurs").text().length - 2);
		
		if(imeNalogodavca.includes("d.o.o"))
			domaci = true;
		else
			domaci = false;
		
		if($("#broj_naloga2").attr("style").includes("display: none;"))
			dveTure = false;
		else
			dveTure = true;
		
		if(domaci && dveTure) {
			sablon = "DinarskiSablon2Ture";
			obj1["iznos"] = obj1["iznos1"] + obj["iznos2"];
		} else if(domaci && !dveTure) {
			sablon = "DinarskiSablon1Tura";
			obj1["iznos"] = obj1["iznos1"];
		} else if(!domaci && dveTure) {
			sablon = "DevizniSablon2Ture";
			obj1["iznos"] = obj1["iznos1"] + obj["iznos2"];
		} else if(!domaci && !dveTure) {
			sablon = "DevizniSablon1Tura";
			obj1["iznos"] = obj1["iznos1"];
		}
		
		obj1["iznosEUR"] = parseFloat(obj1["iznos"] / parseFloat(obj1["kursEUR"]).toFixed(2)).toFixed(2);
		alert(obj1["iznos"]);
		
		function uradi(param) {
			var mesto = param.mesto;
			var adresa = param.adresa;
			var postanski_broj = param.postanski_broj;
			var nalogodavacPak = param.pak;
			var nalogodavacPib = param.pib;
			var rok_placanja_usluge = param.rok_placanja;
			
			obj1.mesto_nalogodavca = mesto;
			obj1.mesto_prometa = mesto;
			obj1.adresa = adresa;
			obj1.postanski_broj = postanski_broj;
			obj1.pak = nalogodavacPak;
			obj1.pib_nalogodavca = nalogodavacPib;
			obj1.mesto_izdavanja_racuna = mesto;
		}
		
		$.post('php/ucitajNalogodavce.php', {
			'ime': imeNalogodavca,
		}, function(data) {
			if (data === null) {
				console.error('Nešto si zeznuo');
			} else {
				uradi(data);
				
				loadFile("sabloni/" + sablon + ".docx",function(error,content){
					if (error) { throw error };
					var zip = new JSZip(content);
					var doc=new Docxtemplater().loadZip(zip)
					doc.setData(obj1);
					try {
						doc.render()
					}
					catch (error) {
						var e = {
							message: error.message,
							name: error.name,
							stack: error.stack,
							properties: error.properties,
						}
						console.log(JSON.stringify({error: e}));
						throw error;
					}

					var out=doc.getZip().generate({
						type:"blob",
						mimeType: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
					})
					saveAs(out, racunBroj + ".docx")
				});
			}
		});
		
		// End Azuriranje dokumenta
	});
	
	$('#racun_broj').keyup(function () {
		var broj = $(this).val();
		$.post('php/ucitajNalogodavce.php', {
			'broj': broj,
		}, function (data) {
			if(data === null) {
				console.error('Nešto si zeznuo');
			} else {
				$('#tegljac').val(data.tegljac_id);
				$('#prikolica').val(data.prikolica_id);
			}
		});
	});
	
	$("input").change(function () {
		$(this).addClass("uredi");
	});
	
	$("select").change(function () {
		$(this).addClass("uredi");
	});
	
	$('.obrisi').click(function () {
		if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
			var red_id = $(this).closest('tr').attr('id');
			var baza = $(this).closest('table').attr('id').replace('Tabela', '');
			
			$.post('php/obrisiRed.php', {
				'red_id': red_id,
				'baza': baza
			});
			$("tr[id='" + red_id +"']").remove();
		}
		else{
			return false;
		}
	});
});