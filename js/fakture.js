var id_nalogodavca = null;

var dveTure = false;
var domaci = false;
var obj = null;
var posiljalac2 = "";
var primalac2 = "";
var sablon = "";
var ang_kamion = false;
var ava_faktura = false;
var kursNaDanUtovara = 0;
var kursNaDanIstovara = 0;
var kursNaDan = 0;

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

function dveDecimale(x) {
	return parseFloat(x).toFixed(2);
}

$(function() {
	$("#napravi").click(function(e) {
		e.preventDefault();

		var brojTure = $("#broj_ture").val();

		var komplet_racun_broj = "";

		var datum_prometa_usluge = vratiDatum("datum_prometa_usluge");
		var rokPlacanjaUsluge = document.getElementById("rok_placanja_usluge").value.split(' ')[0];

		var imeNalogodavca = $("#nalogodavac").val();
		var idNalogodavca = $("#listaNalogodavci > option[value='" + imeNalogodavca + "'").attr("id");

		var today = new Date();
		var valuta_placanja = addDays(today.getDate() + "." + (today.getMonth() + 1) + "." + today.getFullYear(), parseInt(rokPlacanjaUsluge));

		var tegljac_id = $('#tegljac').val();
		var prikolica_id = $('#prikolica').val();
		var tegljac = document.getElementById("tegljac").options[document.getElementById("tegljac").selectedIndex].text;
		var prikolica = document.getElementById("prikolica").options[document.getElementById("prikolica").selectedIndex].text;

		var angTegljac = $("#ang_tegljac").val();
		var angPrikolica = $("#ang_prikolica").val();

		// Kurs na danasnji dan.
		var kursEURDanas = document.getElementById("kursEUR").text.replace(/\s/g, '').replace(',', '.');
		kursEURDanas = kursEURDanas.substr(0, kursEURDanas - 2);
		// Kurs koji ce se koristiti.
		var kursEUR = kursEURDanas;

		var brojNaloga = document.getElementById("broj_naloga").value;

		var mestoOd = document.getElementById("od").value;
		var mestoOdD;
		var mestoDo = document.getElementById("do").value;
		var mestoDoD;

		var _cmr = document.getElementById("cmr").value;
		var _tezina = document.getElementById("tezina").value;
		var vrsta_robe = document.getElementById("vrsta_robe").value;

		var iznos = document.getElementById("iznos").value;
		var intPart = parseInt(iznos);
		var decimala = parseInt(Math.floor(100 * (iznos - intPart)));

		/*
			Provera koji je nalogodavac u pitanju, da li je Milsped ili Kontinental
		*/
		var datum_istovara, datum_utovara, datum_avans;

		var cena_u_celosti_eur, cena_u_celosti_din;
		var cena_domaci_deo_eur, cena_domaci_deo_din;
		var cena_inostrani_deo_eur, cena_inostrani_deo_din;

		if(idNalogodavca == 12) { // Onda je Kontinental.
			datum_utovara = vratiDatum("datum_utovara");
		} else if(idNalogodavca == 13) { // onda je Milsped.
			if(ava_faktura) {
				valuta_placanja = vratiDatum("valuta_placanja");
				kursEUR = $("#kurs_rucni").val();
			}
			else
				datum_istovara = vratiDatum("datum_istovara");

			cena_u_celosti_eur = $("#cena_u_celosti_eur").val();
			cena_u_celosti_din = $("#cena_u_celosti_din").val();

			cena_domaci_deo_eur = $("#cena_domaci_deo_eur").val();
			cena_domaci_deo_din = $("#cena_domaci_deo_din").val();

			cena_inostrani_deo_eur = $("#cena_inostrani_deo_eur").val();
			cena_inostrani_deo_din = $("#cena_inostrani_deo_din").val();
		}

		if(ang_kamion) {
			komplet_racun_broj = brojTure + "/AK/" + (today.getFullYear() - 2000);
			console.log(komplet_racun_broj);
		} else {
			komplet_racun_broj = brojTure + "/" + tegljac_id + "-" + prikolica_id + "/" + (today.getFullYear() - 2000);
			console.log(komplet_racun_broj);
		}

		var racunBroj = komplet_racun_broj;

		if (id_nalogodavca == 13) { // 13, zato sto je Milsped-ov ID = 13.
			if (ava_faktura) {
				valuta_placanja = vratiDatum("valuta_placanja");
			} else {
				var dd = datum_prometa_usluge.split('.')[0];
				var mm = datum_prometa_usluge.split('.')[1];
				var yyyy = datum_prometa_usluge.split('.')[2];

				if(dd <= 15) dd = 8;
				else dd = 22;

				mm = +mm + 2;
				if(mm > 12) {
					mm = +mm - 12;
					yyyy++;
				}
				valuta_placanja = dd + "." + mm + "." + yyyy;
			}
		}

		$.post("php/racunBroj.php", {
			prvi: brojTure,
			avansna: ava_faktura
		}, function (data) {
			obj = {
				racun_broj: racunBroj,
				datum_izdavanja: danas(),
				datum_prometa: datum_prometa_usluge,
				ime_nalogodavca: imeNalogodavca,
				valuta_placanja: valuta_placanja,
				tegljac: tegljac.substring(tegljac.indexOf(": "), tegljac.length),
				prikolica: prikolica.substring(prikolica.indexOf(": ") + 2, prikolica.length),

				broj_naloga: brojNaloga,
				od: mestoOd,
				do: mestoDo,
				cmr: _cmr,
				tezina: _tezina,
				vrsta_robe: vrsta_robe,

				kursEUR: dveDecimale(kursEUR),
				iznos: iznos,
				slovima: izBrojaUSlova(intPart, 2, 1) + " dinara i " + decimala + "/100",
				iznosEUR: dveDecimale(iznos / dveDecimale(kursEUR)),
			};

			// Provera da li je angazovani kamion ili nije.
			// Ako jeste, ubacujemo ga u obj.
			if (ang_kamion) {
				obj["tegljac"] = angTegljac;
				obj["prikolica"] = angPrikolica;
			}

			// Provera da li je nalogodavac Milsped ili Kontinental.
			// Provera, takodje, da li je avansna ili klasicna faktura.
			if(idNalogodavca == 12) { // Onda je Kontinental.
				obj["datum_utovara"] = datum_utovara;
				obj["dan_utovara_kurs"] = kursNaDanUtovara;
			} else if(idNalogodavca == 13) { // onda je Milsped.
				if(!ava_faktura) {
					obj["datum_istovara"] = datum_istovara;
					obj["dan_istovara_kurs"] = kursNaDanIstovara;
				}

				obj["cena_u_celosti_eur"] = cena_u_celosti_eur;
				obj["cena_u_celosti_din"] = cena_u_celosti_din;

				obj["cena_domaci_deo_eur"] = cena_domaci_deo_eur;
				obj["cena_domaci_deo_din"] = cena_domaci_deo_din;

				obj["cena_inostrani_deo_eur"] = cena_inostrani_deo_eur;
				obj["cena_inostrani_deo_din"] = cena_inostrani_deo_din;

				iznos = +cena_u_celosti_din;
				console.log("CENA U CELOSTI DIN:" +  cena_u_celosti_din);
				console.log("CENA U CELOSTI DIN 2:" +  +cena_u_celosti_din);
			} else if(idNalogodavca == 16) {
				iznos = +$("#iznos").val();
			}

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

			// Provera koji je sablon u pitanju.
			// I na osnovu provere zadaje sablon.
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
				'od': mestoOd,
				'do': mestoDo,
				'broj': racunBroj,
				'tegljac_id': tegljac_id,
				'prikolica_id': prikolica_id,
			}, function(data) {
				if (data === null) {
					console.error('Nešto si zeznuo');
				} else {
					uradi(data);

					var mestoOdDrzava = $("#odDrzava").text();
					var mestoDoDrzava = $("#doDrzava").text();

					$.post('php/gradovi.php', {
						od: mestoOd,
						odDrzava: mestoOdDrzava,
						do: mestoDo,
						doDrzava: mestoDoDrzava,
					}, function (gradovi) {
							mestoOdD = gradovi.od;
							mestoDoD = gradovi.do;

							if(idNalogodavca == 13) {
								obj["od"] = obj["od"] + " - Granica (SRB)";
								obj["do"] = "Granica (SRB) - " + obj["do"];

								obj["domaci_deo"] = cena_domaci_deo_din;
								obj["inostrani_deo"] = cena_inostrani_deo_din;

								obj["mestoOdD"] = mestoOdD;
								obj["mestoDoD"] = mestoDoD;
							}

							loadFile("sabloni/" + sablon + ".docx",function(error,content){
								if (error) { throw error };
								var zip = new JSZip(content);
								var doc = new Docxtemplater().loadZip(zip)
								doc.setData(obj);
								doc.setOptions({nullGetter: function () {
									return "";
								}});

								try {
									doc.render();
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
					});

					/*
						Ubacuje fakturu u bazu.
					*/
					$.post('php/napraviFakturu.php', {
						fk_nalogodavac: idNalogodavca,

						racun_broj: racunBroj,
						komplet_racun_broj: komplet_racun_broj,

						datum_izdavanja: danas(),
						valuta_placanja: valuta_placanja,
						datum_prometa: datum_prometa_usluge,

						mesto_prometa: obj["mesto_nalogodavca"],
						mesto_izdavanja_racuna: "Vidikovac",

						fk_nalogodavac: idNalogodavca,

						fk_tegljac: tegljac_id,
						fk_prikolica: prikolica_id,
						tegljac: tegljac,
						prikolica: prikolica,
						ang_tegljac: angTegljac,
						ang_prikolica: angPrikolica,

						broj_naloga: brojNaloga,
						od: mestoOd,
						do: mestoDo,
						cmr: _cmr,
						tezina: _tezina,
						vrsta_robe: vrsta_robe,

						kursEUR: dveDecimale(kursEUR),
						iznos: iznos,
						iznosEUR: dveDecimale(iznos / dveDecimale(kursEUR)),
						sablon: sablon
					});
				}
			});
		});
	});

	$('#nalogodavac').change(function () {
		// zasto ovo postoji.
		var imeNalogodavca = $("#nalogodavac").val();
		id_nalogodavca = $("#listaNalogodavci > option[value='" + imeNalogodavca + "'").attr("id");

		if(id_nalogodavca == null && imeNalogodavca != "")
		{
			if(confirm("Nalogodavac ne postoji, želite li da ga ubacite?"))
				location.href = "podesavanja.php?ime=" + imeNalogodavca;
		} else if (id_nalogodavca == 13) { // 13, zato sto je Milsped-ov ID = 13.
			$("#rok_placanja_usluge").parent().hide();
			$("#vrsta_fakture").show();
			$("#utovar").hide();
			$("#istovar").show();
			$("#cena_milsped").show();
			$("#cena_default").hide();
		} else if (id_nalogodavca == 12) { // 12, zato sto je Kontinental-ov ID = 12.
			$("#rok_placanja_usluge").parent().show();
			$("#vrsta_fakture").hide();
			$("#utovar").show();
			$("#istovar").hide();
			$("#cena_milsped").hide();
			$("#cena_default").show();
		} else {
			$("#rok_placanja_usluge").parent().show();
			$("#vrsta_fakture").hide();
			$("#utovar").hide();
			$("#istovar").hide();
			$("#cena_milsped").hide();
			$("#cena_default").show();
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
	});

	$('#komplet_broj').keyup(function () {
		var kompletBroj = $(this).val();
		$.post('php/ucitajNalogodavce.php', {
			'broj': kompletBroj,
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
			$(".brojNaloga").css('display', 'none');
			domaci = true;
		} else {
			$(".brojNaloga").css('display', 'block');
			domaci = false;
		}
	});

	$(".drzava").click(function (e) {
		e.preventDefault();
		if($("#odDrzava").text().trim() == "SRB")
			$("#odDrzava").text("I");
		else
			$("#odDrzava").text("SRB");
		if($("#doDrzava").text().trim() == "SRB")
			$("#doDrzava").text("I");
		else
			$("#doDrzava").text("SRB");
	});

	// Event za radio button.
	// Odredjuje da li je izabran angazovani ili nas kamion.
	$('input[type="radio"][name="kamion"]').on('change', function () {
		if(this.value == "nas_kamion") {
			ang_kamion = false;
			$("#ang_kamion").hide();
			$("#nas_kamion").show();
			$("#komplet_broj").parent().show();
			$("#datum_prometa_usluge").parent().addClass("offset-md-1");     // menja offset
		} else {
			ang_kamion = true;
			$("#nas_kamion").hide();
			$("#ang_kamion").show();
			$("#komplet_broj").parent().hide();
			$("#datum_prometa_usluge").parent().removeClass("offset-md-1");  // menja offset
		}
	});

	// <Datumi>
	//
	$('#datum_utovara').on('change', function () {
		var datum_utovara = vratiDatum("datum_utovara");
		var novi_datum = datum_utovara.split('.')[0] + "-" + datum_utovara.split('.')[1] + "-" + datum_utovara.split('.')[2];

		// link za skrejp: https://www.navidiku.rs/kursna-lista/kursna-lista-nbs/27-04-2019
		$.ajaxSetup({async: false});
		$.post("php/kursNaDan.php", {
			datum: novi_datum,
		}, function (data) {
			kursNaDanUtovara = data;
		});

		$("#dan_utovara_kurs").val(parseFloat(kursNaDanUtovara));
		$.ajaxSetup({async: true});
		kursEUR = kursNaDanUtovara;
	});

	$('#datum_istovara').on('change', function () {
		var datum_istovara = vratiDatum("datum_istovara");
		var novi_datum = datum_istovara.split('.')[0] + "-" + datum_istovara.split('.')[1] + "-" + datum_istovara.split('.')[2];

		// link za skrejp: https://www.navidiku.rs/kursna-lista/kursna-lista-nbs/27-04-2019
		$.ajaxSetup({async: false});
		$.post("php/kursNaDan.php", {
			datum: novi_datum,
		}, function (data) {
			kursNaDanIstovara = data;
		});

		$("#dan_istovara_kurs").val(parseFloat(kursNaDanIstovara));
		$.ajaxSetup({async: true});
		kursEUR = kursNaDanIstovara;
	});
	// </Datumi>
	//

	// <Cene za Milsped>
	//
	$("#cena_u_celosti_eur").change(function () {
		if($("#kurs_rucni").val() == "")
			$("#cena_u_celosti_din").val(dveDecimale(+this.value * +kursEUR));
		else
			$("#cena_u_celosti_din").val(dveDecimale(+this.value * +($("#kurs_rucni").val())));
	});

	$("#cena_domaci_deo_eur").change(function () {
		if($("#kurs_rucni").val() == "")
			$("#cena_domaci_deo_din").val(dveDecimale(+this.value * +kursEUR));
		else
			$("#cena_domaci_deo_din").val(dveDecimale(+this.value * +($("#kurs_rucni").val())));
	});

	$("#cena_inostrani_deo_eur").change(function () {
		if($("#kurs_rucni").val() == "")
			$("#cena_inostrani_deo_din").val(dveDecimale(+this.value * +kursEUR));
		else
			$("#cena_inostrani_deo_din").val(dveDecimale(+this.value * +($("#kurs_rucni").val())));
	});
	// </Cene za Milsped>
	//

	$('input[type="radio"][name="vrsta_fakture"]').on('change', function () {
		if (this.value == "kla_faktura") {
			ava_faktura = false;
			$("#istovar").show();
			$("#valuta_placanja").parent().hide();
			$("#kurs").hide();
		} else {
			ava_faktura = true;
			$("#istovar").hide();
			$("#valuta_placanja").parent().show();
			$("#kurs").show();
		}
	});
});
