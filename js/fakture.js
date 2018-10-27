var dveTure = false;
var domaci = false;
var obj = null;
var mestoOd1;
var posiljalac2 = "";
var primalac2 = "";
var sablon = "";

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
		var racunBroj = $("#racun_broj").val();
		var datumPrometaUsluge = vratiDatum("datum_prometa_usluge");
		var rokPlacanjaUsluge = document.getElementById("rok_placanja_usluge").value.split(' ')[0];
		var imeNalogodavca = $("#nalogodavac").val();
		var today = new Date();
		var tmpday = addDays(today.getDate() + "." + (today.getMonth() + 1) + "." + today.getFullYear(), parseInt(rokPlacanjaUsluge));
		var tegljac_id = $('#tegljac').val();
		var prikolica_id = $('#prikolica').val();
		var tegljac = document.getElementById("tegljac").options[document.getElementById("tegljac").selectedIndex].text;
		var prikolica = document.getElementById("prikolica").options[document.getElementById("prikolica").selectedIndex].text;
		var kursEUR = document.getElementById("kursEUR").text.replace(/\s/g, '').replace(',', '.');
		kursEUR = kursEUR.substr(0, kursEUR - 2);
		var imeBanke = $("#banka").val();
		var racunBrojBanke = $("#racun_broj_banke").val();

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

		var intPart = parseInt(iznos);
		var decimala = parseInt(Math.floor(100 * (iznos - intPart)));

		$.post("php/racunBroj.php", {
			racunBroj: racunBroj,
		}, function (data) {
			var tmpRacunBroj = racunBroj;
			racunBroj = data;
			obj = {
				racun_broj: racunBroj,
				datum_izdavanja: danas(),
				datum_prometa: datumPrometaUsluge,
				ime_nalogodavca: imeNalogodavca,
				valuta_placanja: tmpday,
				tegljac: tegljac.substring(tegljac.indexOf(": "), tegljac.length),
				prikolica: prikolica.substring(prikolica.indexOf(": ") + 2, prikolica.length),
				banka_ime: imeBanke,
				racun_broj_banke: racunBrojBanke,

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
				kursEUR: parseFloat(kursEUR).toFixed(2),
				iznos: iznos,
				slovima: izBrojaUSlova(intPart, 2, 1) + " dinara i " + decimala + "/100",
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

			var racunBroj = $("#racun_broj").val();
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
						doc.setOptions({nullGetter: function () {
							return "";
						}});
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

					var mestoOd1Drzava = $("#od1Drzava").text();
					var mestoDo1Drzava = $("#do1Drzava").text();
					var mestoOd2Drzava = $("#od2Drzava").text();
					var mestoDo2Drzava = $("#do2Drzava").text();
					var idNalogodavca = $("#listaNalogodavci > option[value='" + imeNalogodavca + "'").attr("id");

					if(mestoOd1 && mestoDo1 && mestoOd2 && mestoDo2) {
						$.post('php/gradovi.php', {
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
						$.post('php/gradovi.php', {
							od1: mestoOd1,
							od1Drzava: mestoOd1Drzava,
							do1: mestoDo1,
							do1Drzava: mestoDo1Drzava,
						});
					}

					$.post('php/napraviFakturu.php', {
						fk_nalogodavac: idNalogodavca,
						racun_broj: tmpRacunBroj,
						komplet_racun_broj: racunBroj,
						datum_izdavanja: danas(),
						valuta_placanja: tmpday,
						datum_prometa: datumPrometaUsluge,
						mesto_prometa: obj["mesto_nalogodavca"],
						mesto_izdavanja_racuna: "Vidikovac",
						fk_nalogodavac: idNalogodavca,
						fk_tegljac: tegljac_id,
						fk_prikolica: prikolica_id,
						ime_banke: imeBanke,
						racun_broj_banke: racunBrojBanke,

						broj_naloga1: brojNaloga1,
						od1: mestoOd1,
						do1: mestoDo1,
						cmr1: _cmr1,
						tezina1: _tezina1,
						mesto_utovara1: posiljalac1,
						mesto_istovara1: primalac1,
						mesto_utovara2: posiljalac2,
						mesto_istovara2: primalac2,
						iznos1: parseFloat(_iznos1).toFixed(2),

						broj_naloga2: brojNaloga2,
						od2: mestoOd2,
						do2: mestoDo2,
						cmr2: _cmr2,
						tezina2: _tezina2,
						iznos2: parseFloat(_iznos2).toFixed(2),
						kursEUR: parseFloat(kursEUR).toFixed(2),
						iznos: iznos,
						iznosEUR: parseFloat(iznos / parseFloat(kursEUR).toFixed(2)).toFixed(2),
						sablon: sablon
					});
					console.log("===========================");
					console.log("primalac1: " + primalac1);
					console.log("primalac2: " + primalac2);
					console.log("posiljalac1: " + posiljalac1);
					console.log("posiljalac2: " + posiljalac2);
					console.log("===========================");
					$.post("php/banke.php", {
						ime: imeBanke,
						nalogodavac: idNalogodavca,
						racun_broj: racunBrojBanke,
					});
				}
			});
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
		var imeNalogodavca = $("#nalogodavac").val();
		if($("#listaNalogodavci > option[value=\"" + imeNalogodavca + "\"").attr("id") == null)
		{
			if(confirm("Nalogodavac ne postoji, želite li da ga ubacite?"))
				location.href = "podesavanja.php?ime=" + imeNalogodavca;
		}

		$.post('php/ucitajNalogodavce.php', {
			ime: imeNalogodavca
		}, function(data) {
			if (data === null) {
				console.error('Nešto si zeznuo');
			} else {
				$('#rok_placanja_usluge').val(data.rok_placanja);
			}
		});

		if(imeNalogodavca.includes("d.o.o"))
			$("#eurdin").text("din.");
		else
			$("#eurdin").text("€");
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
		var imeNalogodavca = $("#nalogodavac").val();

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
	});

	$("#posiljalac1").change(function () {
		var z = $("#posiljalac1").val();
		console.log(z);
		if($("#listaPosiljalac1 > option[value=\"" + z + "\"").val() == null)
		{
			console.log("z: " + z);
			if(confirm("Pošiljalac ne postoji, želite li da ga ubacite?")) {
				var tip = prompt("Pošiljalac, primalac ili oba?", "");
				tip = tip.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				$.post("php/ucitajNalogodavce.php", {
					imeP: z,
					tip: tip,
				});
			}
		}
	});

	$("#primalac1").change(function () {
		var z = $("#primalac1").val();
		console.log(z);
		if($("#listaPrimalac1 > option[value=\"" + z + "\"").val() == null)
		{
			if(confirm("Primalac ne postoji, želite li da ga ubacite?")) {
				var tip = prompt("Pošiljalac, primalac ili oba?", "");
				tip = tip.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				$.post("php/ucitajNalogodavce.php", {
					imeP: z,
					tip: tip,
				});
			}
		}
	});

	$("#posiljalac2").change(function () {
		var z = $("#posiljalac2").val();
		console.log(z);
		if($("#listaPosiljalac2 > option[value=\"" + z + "\"").val() == null)
		{
			if(confirm("Pošiljalac ne postoji, želite li da ga ubacite?")) {
				var tip = prompt("Pošiljalac, primalac ili oba?", "");
				tip = tip.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				$.post("php/ucitajNalogodavce.php", {
					imeP: z,
					tip: tip,
				});
			}
		}
	});

	$("#primalac2").change(function () {
		var z = $("#primalac2").val();
		console.log(z);
		if($("#listaPrimalac2 > option[value=\"" + z + "\"").val() == null)
		{
			if(confirm("Pošiljalac ne postoji, želite li da ga ubacite?")) {
				var tip = prompt("Pošiljalac, primalac ili oba?", "");
				tip = tip.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				$.post("php/ucitajNalogodavce.php", {
					imeP: z,
					tip: tip,
				});
			}
		}
	});

	$("#banka").change(function () {
		var b = $("#banka").val();
		$.post('php/banke.php', {
			ime: b,
			pomocni: 12,
		}, function (data) {
			$("#racun_broj_banke").val(data);
		});
	});

	$(".drzava").click(function (e) {
		e.preventDefault();
		if($(this).text().trim() == "SRB")
			$(this).text("ITA");
		else
			$(this).text("SRB");
	});
});
