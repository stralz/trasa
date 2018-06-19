var dveTure = false;
var domaci = false;
var obj = null;
var mestoOd1;
var posiljalac2 = "";
var primalac2 = "";
var sablon = "";

function izaberiRelaciju(_od, _do, grupa) {
	if(grupa == 1) {
		$("#od1").val(_od);
		$("#do1").val(_do);
	} else {
		$("#od2").val(_od);
		$("#do2").val(_do);
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

function danas() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1;
	var yyyy = today.getFullYear();

	if(dd<10) {
		dd = '0'+dd
	} 

	if(mm<10) {
		mm = '0'+mm
	} 

	return dd + '.' + mm + '.' + yyyy;
}

function dateToString(date) {
	var dd = date.getDate();
	var mm = date.getMonth() + 1;
	var yyyy = date.getFullYear();

	if(dd<10) {
		dd = '0'+dd
	} 

	if(mm<10) {
		mm = '0'+mm
	}
	
	return dd + '.' + mm + '.' + yyyy;
}

function addDays(date, days) {
	if(!domaci) {
		var result = new Date(date.split('.')[2], date.split('.')[1], date.split('.')[0]);
		var result1 = new Date(result);
		
		if(result1.getMonth() == 11) {
			result = new Date(result1.getFullYear() + 1, 0, 1);
		} else {
			result = new Date(result1.getFullYear(), result1.getMonth() + 1, 1);
		}
	  
		result.setDate(result.getDate() + days);
	  
		var dd = result.getDate();
		var mm = result.getMonth();
		if(mm < 10)
			mm = "0" + mm;
		var yyyy = result.getFullYear();
	  
		return dd + '.' + mm + '.' + yyyy;
	} else {
		var result = new Date(date.split('.')[2], date.split('.')[1], date.split('.')[0]);
		result.setDate(result.getDate() + days);
		
		var dd = result.getDate();
		var mm = result.getMonth();
		if(mm < 10)
			mm = "0" + mm;
		var yyyy = result.getFullYear();
	  
		return dd + '.' + mm + '.' + yyyy;
	}
}

$(function() {
	$("#napravi").click(function(e) {
		e.preventDefault();
		var racunBroj = document.getElementById("racun_broj").value;
		var datumPrometaUsluge = vratiDatum("datum_prometa_usluge");
		var rokPlacanjaUsluge = document.getElementById("rok_placanja_usluge").value.split(' ')[0];
		var imeNalogodavca = document.getElementById("nalogodavac").options[document.getElementById("nalogodavac").selectedIndex].text;
		var today = new Date();
		var tmpday = addDays(today.getDate() + "." + (today.getMonth() + 1) + "." + today.getFullYear(), parseInt(rokPlacanjaUsluge));
		var tegljac_id = $('#tegljac').val();
		var prikolica_id = $('#prikolica').val();
		var tegljac = document.getElementById("tegljac").options[document.getElementById("tegljac").selectedIndex].text;
		var prikolica = document.getElementById("prikolica").options[document.getElementById("prikolica").selectedIndex].text;
		var kursEUR = document.getElementById("kursEUR").text.replace(/\s/g, '').replace(',', '.');
		kursEUR = kursEUR.substr(0, kursEUR - 2);
		
		var brojNaloga1 = document.getElementById("broj_naloga1").value;
		mestoOd1 = document.getElementById("od1").value;
		var mestoDo1 = document.getElementById("do1").value;
		var _cmr1 = document.getElementById("cmr1").value;
		var _tezina1 = document.getElementById("tezina1").value;
		var posiljalac1 = document.getElementById("posiljalac1").value;
		var primalac1 = document.getElementById("primalac1").value;
		var _iznos1 = document.getElementById("iznos1").value;
		
		var iznos = 0;
		var brojNaloga2 = "";
		var mestoOd2 = "";
		var mestoDo2 = "";
		var _cmr2 = "";
		var _tezina2 = "";
		var _iznos2 = "";
		
		if(dveTure) {
			brojNaloga2 = document.getElementById("broj_naloga2").value;
			mestoOd2 = document.getElementById("od2").value;
			mestoDo2 = document.getElementById("do2").value;
			_cmr2 = document.getElementById("cmr2").value;
			_tezina2 = document.getElementById("tezina2").value;
			posiljalac2 = document.getElementById("posiljalac2").value;
			primalac2 = document.getElementById("primalac2").value;
			_iznos2 = document.getElementById("iznos2").value;
			
			iznos = parseFloat(+_iznos1 + +_iznos2).toFixed(2);
		} else {
			iznos = parseFloat(_iznos1).toFixed(2);
		}
		
		obj = {
			racun_broj: racunBroj,
			datum_izdavanja: danas(),
			datum_prometa: datumPrometaUsluge,
			ime_nalogodavca: imeNalogodavca,
			valuta_placanja: tmpday,
			tegljac: tegljac.substring(tegljac.indexOf(": "), tegljac.length),
			prikolica: prikolica.substring(prikolica.indexOf(": ") + 2, prikolica.length),
			
			broj_naloga1: brojNaloga1,
			od1: mestoOd1,
			do1: mestoDo1,
			cmr1: _cmr1,
			tezina1: _tezina1,
			mesto_utovara1: posiljalac1,
			mesto_istovara1: primalac1,
			iznos1: parseFloat(_iznos1).toFixed(2),
			
			broj_naloga2: brojNaloga2,
			od2: mestoOd2,
			do2: mestoDo2,
			cmr2: _cmr2,
			tezina2: _tezina2,
			mesto_utovara2: posiljalac2,
			mesto_istovara2: primalac2,
			iznos2: parseFloat(_iznos2).toFixed(2),
			kursEUR: kursEUR,
			iznos: iznos,
			iznosEUR: parseFloat(iznos / parseFloat(kursEUR).toFixed(2)).toFixed(2),
		};
		
		function uradi(param) {
			var mesto = param.mesto;
			var adresa = param.adresa;
			var postanski_broj = param.postanski_broj;
			var nalogodavacPak = param.pak;
			var nalogodavacPib = param.pib;
			var rok_placanja_usluge = param.rok_placanja;
			
			obj.mesto_nalogodavca = mesto;
			obj.mesto_prometa = mesto;
			obj.adresa = adresa;
			obj.postanski_broj = postanski_broj;
			obj.pak = nalogodavacPak;
			obj.pib_nalogodavca = nalogodavacPib;
			obj.mesto_izdavanja_racuna = mesto;
		}
		
		if(domaci && dveTure) {
			sablon = "DinarskiSablon2Ture";
		} else if(domaci && !dveTure) {
			sablon = "DinarskiSablon1Tura";
		} else if(!domaci && dveTure) {
			sablon = "DevizniSablon2Ture";
		} else if(!domaci && !dveTure) {
			sablon = "DevizniSablon1Tura";
		}
		
		$.post('php/ucitajNalogodavce.php', {
			'ime': imeNalogodavca,
			'rok': rokPlacanjaUsluge,
			'od1': mestoOd1,
			'do1': mestoDo1,
			'od2': mestoOd2,
			'do2': mestoDo2,
			'broj': racunBroj,
			'tegljac_id': tegljac_id,
			'prikolica_id': prikolica_id,
			'posiljalac1': posiljalac1,
			'posiljalac2': posiljalac2,
			'primalac1': primalac1,
			'primalac2': primalac2,
		}, function(data) {
			if (data === null) {
				console.error('Nešto si zeznuo');
			} else {
				uradi(data);
				
				loadFile("sabloni/" + sablon + ".docx",function(error,content){
					if (error) { throw error };
					var zip = new JSZip(content);
					var doc=new Docxtemplater().loadZip(zip)
					doc.setData(obj);
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
		
		var mestoOd1Drzava = $("input:radio[name='od1Radio']:checked").closest('label').text();
		var mestoDo1Drzava = $("input:radio[name='do1Radio']:checked").closest('label').text();
		var mestoOd2Drzava = $("input:radio[name='od2Radio']:checked").closest('label').text();
		var mestoDo2Drzava = $("input:radio[name='do2Radio']:checked").closest('label').text();
		var idNalogodavca = document.getElementById("nalogodavac").options[document.getElementById("nalogodavac").selectedIndex].value;
		
		if(mestoOd1 && mestoDo1 && mestoOd2 && mestoDo2) {
			$.post('php/relacije.php', {
				ime: imeNalogodavca,
				idNalogodavca: idNalogodavca,
				od1: mestoOd1,
				od1Drzava: mestoOd1Drzava,
				do1: mestoDo1,
				do1Drzava: mestoDo1Drzava,
				od2: mestoOd2,
				od2Drzava: mestoOd2Drzava,
				do2: mestoDo2,
				do2Drzava: mestoDo2Drzava
			});
		} else if (mestoOd1 && mestoDo1) {
			$.post('php/relacije.php', {
				ime: imeNalogodavca,
				idNalogodavca: idNalogodavca,
				od1: mestoOd1,
				od1Drzava: mestoOd1Drzava,
				do1: mestoDo1,
				do1Drzava: mestoDo1Drzava,
			});
		}
		
		$.post('php/napraviFakturu.php', {
			mesto_utovara2: posiljalac2,
			mesto_istovara2: primalac2,
			fk_nalogodavac: idNalogodavca,
			racun_broj: racunBroj,
			datum_izdavanja: danas(),
			valuta_placanja: tmpday,
			datum_prometa: datumPrometaUsluge,
			mesto_prometa: "Mesto prometa",
			mesto_izdavanja_racuna: "Mesto izdavanja",
			fk_nalogodavac: idNalogodavca,
			fk_tegljac: tegljac_id,
			fk_prikolica: prikolica_id,
			
			broj_naloga1: brojNaloga1,
			od1: mestoOd1,
			do1: mestoDo1,
			cmr1: _cmr1,
			tezina1: _tezina1,
			mesto_utovara1: posiljalac1,
			mesto_istovara1: primalac1,
			iznos1: parseFloat(_iznos1).toFixed(2),
			
			broj_naloga2: brojNaloga2,
			od2: mestoOd2,
			do2: mestoDo2,
			cmr2: _cmr2,
			tezina2: _tezina2,
			iznos2: parseFloat(_iznos2).toFixed(2),
			kursEUR: kursEUR,
			iznos: iznos,
			iznosEUR: parseFloat(iznos / parseFloat(kursEUR).toFixed(2)).toFixed(2),
			sablon: sablon
		});
	});
	
	$("#treci-tab").click(function () {
		dveTure = !dveTure;
		
		if(dveTure) {
			$("#drugi-tab").css('display', 'block');
			$("#drugi-tab").tab("show");
			$("#treci-tab").text("-");
		} else {
			$("#drugi-tab").css('display', 'none');
			$("#drugi-tab").tab("show");
			$("#treci-tab").text("+");
			$("#prvi-tab").tab("show");
		}
		
	});
	
	$('#nalogodavac').change(function () {
		var tmp = document.getElementById("nalogodavac");
		var imeNalogodavca = tmp.options[tmp.selectedIndex].text;
		$.post('php/ucitajNalogodavce.php', {
			ime: imeNalogodavca
		}, function(data) {
			if (data === null) {
				console.error('Nešto si zeznuo');
			} else {
				$('#rok_placanja_usluge').val(data.rok_placanja);
			}
		});
		
		$.post('php/relacije.php', {
			ime: imeNalogodavca,
			pomocni: 0,
		}, function (data) {
			$('#listaGradovi').html(data);
		});
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
	
	$('#nalogodavac').change(function () {
		var tmp = document.getElementById("nalogodavac");
		var imeNalogodavca = tmp.options[tmp.selectedIndex].text;
		
		if(imeNalogodavca.includes("d.o.o")) {
			$(".brojNaloga1").css('display', 'none');
			$(".brojNaloga2").css('display', 'none');
			if($(".posiljalacPrimalac1").css('display') == 'none'){
				$(".posiljalacPrimalac1").css('display', 'block');
				$(".posiljalacPrimalac2").css('display', 'block');
			}
			domaci = true;
		} else {
			$(".brojNaloga1").css('display', 'block');
			$(".brojNaloga2").css('display', 'block');
			$(".posiljalacPrimalac1").css('display', 'none');
			$(".posiljalacPrimalac2").css('display', 'none');
			domaci = false;
		}
		
		$.post('php/relacije.php', {
			ime: imeNalogodavca,
			grupa: 1,
		}, function (data) {
			$('#dropdownRelacije1').html(data);
		});
		
		$.post('php/relacije.php', {
			ime: imeNalogodavca,
			grupa: 2,
		}, function (data) {
			$('#dropdownRelacije2').html(data);
		});
		
	});
});