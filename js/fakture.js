var id_nalogodavca = null;

var dveTure = false;
var domaci = false;
var obj = null;
var posiljalac2 = "";
var primalac2 = "";
var sablon = "";
var ang_kamion = false;
var ava_faktura = false;
var uvoz = false;
var kursNaDanUtovara = 0;
var kursNaDanIstovara = 0;
var kursNaDanFakturisanja = 0;
var kursNaDan = 0;

function vratiDatum(datepicker) {
	var tmp = document.getElementById(datepicker).value;
	var date = tmp.split('-');
	var day = date[2];
	var month = date[1];
	var year = date[0];
	return day + '.' + month + '.' + year;
}

function vratiDecimalu(decimala) {
	if (decimala > 0 && decimala < 10)
		return "0" + decimala + "/100";
	else if (decimala == "")
		return "00/100";
	else
		return decimala + "/100";
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

function format_novac(n, c, d, t) {
  var c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
    j = (j = i.length) > 3 ? j % 3 : 0;

  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

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

function dveDecimale(x) {
	return parseFloat(x).toFixed(2);
}

$(function() {
	$("#napravi").click(function(e) {
		e.preventDefault();

		var komplet_racun_broj = "";

		var brojFakture = $("#broj_fakture").val();
		var brojTure = $("#broj_ture").val();

		var datum_prometa_usluge = vratiDatum("datum_prometa_usluge");
		var rokPlacanjaUsluge = document.getElementById("rok_placanja_usluge").value;

		var komplet_broj = $("#komplet_broj").val();

		var imeNalogodavca = $("#nalogodavac").val();
		var idNalogodavca = $("#listaNalogodavci > option[value='" + imeNalogodavca + "'").attr("id");

		var datum_izdavanja = vratiDatum("datum_izdavanja_racuna");
		var today = new Date();
		var valuta_placanja;

		var tegljac_id = $('#tegljac').val();
		var prikolica_id = $('#prikolica').val();
		var tegljac = document.getElementById("tegljac").options[document.getElementById("tegljac").selectedIndex].text;
		var prikolica = document.getElementById("prikolica").options[document.getElementById("prikolica").selectedIndex].text;

		var angTegljac = $("#ang_tegljac").val();
		var angPrikolica = $("#ang_prikolica").val();

		var brojNaloga = $("#broj_naloga").val();

		var mestoOd = $("#od").val();
		var mestoDo = $("#do").val();

		var _cmr = $("#cmr").val();
		var _tezina = $("#tezina").val();
		var vrsta_robe = $("#vrsta_robe").val();

		var iznos = $("#iznos").val();
		var iznos_din = $("#iznos_din").val();
		if (iznos_din != "")
			iznos = iznos_din;
		var intPart = parseInt(iznos);
		var decimala = iznos - Math.floor(iznos);
		decimala = Math.round(decimala * 100) / 100;
		decimala = decimala.toString().substr(2, 2);

		/*
			Provera koji je nalogodavac u pitanju, da li je Milsped ili Kontinental
		*/
		var datum_istovara, datum_utovara, datum_avans, datum_fakturisanja;

		var cena_u_celosti_eur, cena_u_celosti_din;
		var cena_domaci_deo_eur, cena_domaci_deo_din;
		var cena_inostrani_deo_eur, cena_inostrani_deo_din;

		if(idNalogodavca == 13) { // Onda je Milsped;

			if(ava_faktura) {
				valuta_placanja = $("#valuta_placanja").val();
				datum_prometa_usluge = vratiDatum("datum_prometa_usluge");
				kursEUR = $("#kurs_rucni").val();
			}
			else {
				datum_istovara = vratiDatum("datum_istovara");
				datum_prometa_usluge = vratiDatum("datum_prometa_usluge");
			}

			cena_u_celosti_eur = $("#cena_u_celosti_eur").val();
			cena_u_celosti_din = $("#cena_u_celosti_din").val();

			cena_domaci_deo_eur = $("#cena_domaci_deo_eur").val();
			cena_domaci_deo_din = $("#cena_domaci_deo_din").val();

			cena_inostrani_deo_eur = $("#cena_inostrani_deo_eur").val();
			cena_inostrani_deo_din = $("#cena_inostrani_deo_din").val();

			valuta_placanja = rokPlacanjaUsluge;
		} else {
			valuta_placanja = rokPlacanjaUsluge;
		}

		if(ang_kamion) {
			if (ava_faktura)
				komplet_racun_broj = brojFakture + "/AK/" + (today.getFullYear() - 2000);
			else
				komplet_racun_broj = brojFakture + "/AK/" + (today.getFullYear() - 2000);
		 } else {
			if (ava_faktura)
				komplet_racun_broj = brojFakture + "/" +  komplet_broj + "/" + (today.getFullYear() - 2000);
			else
				komplet_racun_broj = brojFakture + "/" + brojTure + "-" + komplet_broj + "/" + (today.getFullYear() - 2000);
		}

		var racunBroj = komplet_racun_broj;

		$.post("php/racunBroj.php", {
			prvi: brojFakture,
			avansna: ava_faktura
		}, function (data) {
			obj = {
				racun_broj: racunBroj,
				datum_izdavanja: datum_izdavanja,
				datum_prometa: datum_prometa_usluge,
				ime_nalogodavca: imeNalogodavca,
				valuta_placanja: valuta_placanja,
				tegljac: tegljac.substring(tegljac.indexOf(": "), tegljac.length),
				prikolica: prikolica.substring(prikolica.indexOf(": ") + 2, prikolica.length),

				broj_naloga: brojNaloga,
				od: mestoOd,
				do: mestoDo,
				cmr: _cmr,
				tezina: format_novac(_tezina, 2, ',', '.') + " kg",
				vrsta_robe: vrsta_robe,

				kursEUR: format_novac(kursEUR, 4, ',', '.'),
				iznos: format_novac(dveDecimale(iznos), 2),
				slovima: izBrojaUSlova(intPart, 1, 1),
				iznosEUR: format_novac(dveDecimale(iznos / dveDecimale(kursEUR)), 2),
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
				obj["iznos"] = format_novac(iznos_din, 2);

				obj["slovima"] = obj["slovima"] + " dinara i " + vratiDecimalu(decimala);
			} else if(idNalogodavca == 13) { // onda je Milsped.
				if(!ava_faktura) {
					obj["datum_istovara"] = datum_istovara;
					obj["dan_istovara_kurs"] = kursNaDanIstovara;
				}

				obj["cena_u_celosti_eur"] = format_novac(cena_u_celosti_eur, 2);
				obj["cena_u_celosti_din"] = format_novac(cena_u_celosti_din, 2);

				obj["cena_domaci_deo_eur"] = format_novac(cena_domaci_deo_eur, 2);
				obj["cena_domaci_deo_din"] = format_novac(cena_domaci_deo_din, 2);

				obj["cena_inostrani_deo_eur"] = format_novac(cena_inostrani_deo_eur, 2);
				obj["cena_inostrani_deo_din"] = format_novac(cena_inostrani_deo_din, 2);

				iznos = +cena_u_celosti_din;
				obj["iznos"] = format_novac(cena_u_celosti_din, 2);
				obj["iznosEUR"] = format_novac(cena_u_celosti_eur, 2);

				// Posto je kod Milspeda iznos cena_u_celosti_din.
				intPart = parseInt(iznos);
				console.log("IZNOS: " + intPart);
				decimala = iznos - Math.floor(iznos);
				decimala = Math.round(decimala * 100) / 100;
				decimala = decimala.toString().substr(2, 2);

				obj["slovima"] = izBrojaUSlova(intPart, 1, 1) + " dinara i " + vratiDecimalu(decimala);
			} else if(idNalogodavca == 16) { // Cambianica
				iznos = $("#iznos").val();
				obj["iznos"] = format_novac($("#iznos").val(), 2);
				obj["slovima"] = "hiljadučetiristo EUR";
				kursEUR = 0;
			} else if(idNalogodavca == 11) { // Todorovic
				obj["iznos"] = format_novac($("#iznos_din").val(), 2);
				iznos = $("#iznos_din").val();

				obj["slovima"] = obj["slovima"] + " dinara i " + vratiDecimalu(decimala);
			} else {
				if (iznos_din != null)
					obj["iznos"] = format_novac(iznos_din, 2);

				obj["slovima"] = obj["slovima"] + " dinara i " + vratiDecimalu(decimala);
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

			function _gradovi(param) {
				var mesto_od_d = param.od;
				var mesto_do_d = param.do;

				obj.mesto_od_d = mesto_od_d;
				obj.mesto_do_d = mesto_do_d;
			}

			$.post('php/ucitajNalogodavce.php', {
				'ime': imeNalogodavca,
				'rok': rokPlacanjaUsluge,
				'od': mestoOd,
				'do': mestoDo,
				'broj': racunBroj,
				'komplet_broj' : komplet_broj,
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
							if(idNalogodavca == 13) { // 13 zato sto je Milsped-ov ID = 13.
								obj["domaci_deo"] = format_novac(cena_domaci_deo_din, 2);
								obj["inostrani_deo"] = format_novac(cena_inostrani_deo_din, 2);
							}

							obj["mestoOdDrzava"] = mestoOdDrzava;
							obj["mestoDoDrzava"] = mestoDoDrzava;

							if (mestoOdDrzava == "I") {
								uvoz = true;
							}

							// Inicijalizujemo promenljivu nazivDokumenta kako bi u nju
							// sacuvali potrebni naziv za dokument koji ce biti generisan.
							var nazivDokumenta;

							// Proveravamo koji je nalogodavac izabran,
							// i da li je izvozna ili uvozna faktura.
							//
							// Takodje dajemo naziv dokumentu koji ce biti generisan.
							if(idNalogodavca == 13) { // 13 zato sto je Milsped-ov ID = 13.
								if(uvoz) {
									if (ava_faktura) {
										obj["racun_broj"] = "Avansni račun br. AVR " + obj["racun_broj"];
										sablon = "Milsped_uvoz_ava";
									} else {
										obj["racun_broj"] = "Račun br. " + obj["racun_broj"];
										sablon = "Milsped_uvoz";
									}

									if (ang_kamion)
										nazivDokumenta = brojFakture + " M uvoz";
									else
										nazivDokumenta = brojFakture + " Mn uvoz";

								} else {
									if (ava_faktura) {
											obj["racun_broj"] = "Avansni račun br. AVR " + obj["racun_broj"];
											sablon = "Milsped_izvoz_ava";
									} else {
											obj["racun_broj"] = "Račun br. " + obj["racun_broj"];
											sablon = "Milsped_izvoz";
									}

									if (ang_kamion)
										nazivDokumenta = brojFakture + " M";
									else
										nazivDokumenta = brojFakture + " Mn";

								}
							} else if(idNalogodavca == 16) { // Zato sto je Cambianica ID = 16.
								if (mestoOdDrzava == "I")
									sablon = "Cambianica_uvoz";
								else
									sablon = "Cambianica_izvoz";

								obj["racun_broj"] = "Račun br. " + obj["racun_broj"];

								nazivDokumenta = brojFakture + " cn";

							} else if(idNalogodavca == 11) { // Zato sto je Todorovic ID = 11.
								if(uvoz)
									sablon = "Todorovic_uvoz";
								else
									sablon = "Todorovic_izvoz";

								obj["racun_broj"] = "Račun br. " + obj["racun_broj"];

								nazivDokumenta = brojFakture + " T";

							} else if(idNalogodavca == 12) { // Zato sto je Kontinental ID = 12.
								if(uvoz)
									sablon = "Kontinental_uvoz";
								else
									sablon = "Kontinental_izvoz";

								obj["racun_broj"] = "Račun br. " + obj["racun_broj"];

								if (ang_kamion)
									nazivDokumenta = brojFakture + " K";
								else
									nazivDokumenta = brojFakture + " Kn";

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
								saveAs(out, nazivDokumenta + ".docx")
							});
					});

					/*
						Ovde ubacujemo vrstu robe u bazu i povezujemo je
						sa nalogdavcem koji je izabran ukoliko ta vrsta vrsta robe
						vec ne postoji u nasoj bazi.
					*/
					$.post('php/vrstaRobe.php', {
						id: idNalogodavca,
						naziv: vrsta_robe
					});

					/*
						Ovde ubacujemo angazovanog tegljaca i angazovanu prikolicu
						u bazu, ukoliko ona ne postoji.
					*/
					if (angTegljac != "" && angPrikolica != "") {
						$.post('php/angazovaniKamion.php', {
							ang_tegljac: angTegljac,
							ang_prikolica: angPrikolica
						});
					}

					/*
						Ubacuje fakturu u bazu.
					*/
					$.post('php/napraviFakturu.php', {
						fk_nalogodavac: idNalogodavca,

						racun_broj: racunBroj,
						komplet_racun_broj: komplet_racun_broj,

						datum_izdavanja: datum_izdavanja,
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

						kursEUR: kursEUR,
						iznos: iznos,
						iznosEUR: dveDecimale(iznos / dveDecimale(kursEUR)),
						sablon: sablon,
						avansna: (ava_faktura ? 1 : 0),
						uvoz: (uvoz ? 1 : 0),
						ceo_deo: format_novac(cena_u_celosti_din, 2),
						domaci_deo: format_novac(cena_domaci_deo_din, 2),
						inostrani_deo: format_novac(cena_inostrani_deo_din, 2)
					});
				}
			});
		});
	});

	$("#nalogodavac").change(function () {
		var imeNalogodavca = $("#nalogodavac").val();
		id_nalogodavca = $("#listaNalogodavci > option[value='" + imeNalogodavca + "'").attr("id");

		if(id_nalogodavca == null && imeNalogodavca != "")
		{
			if(confirm("Nalogodavac ne postoji, želite li da ga ubacite?"))
				location.href = "podesavanja.php?ime=" + imeNalogodavca;
		} else if (id_nalogodavca == 13) { // 13, zato sto je Milsped-ov ID = 13;
			$("#rok_placanja_usluge").parent().show();
			$("#iznos_din").parent().parent().hide();
			$("#vrsta_fakture").show();
			$("#utovar").hide();
			$("#istovar").show();
			$("#fakturisanje").hide();
			$("#hide").show();
			$("#cena_milsped").show();
			$("#cena_default").hide();
			$("#datum_prometa_usluge").parent().show();
		} else if (id_nalogodavca == 12) { // 12, zato sto je Kontinental-ov ID = 12;
			$("#rok_placanja_usluge").parent().show();
			$("#iznos_din").parent().parent().show();
			$("#vrsta_fakture").hide();
			$("#utovar").show();
			$("#istovar").hide();
			$("#fakturisanje").hide();
			$("#cena_milsped").hide();
			$("#cena_default").show();
			$("#datum_prometa_usluge").parent().show();
			$("#valuta_placanja").parent().hide();
		} else if(id_nalogodavca == 11) { // 11, zato sto je Todorovic-ev ID = 11;
			$("#rok_placanja_usluge").parent().show();
			$("#iznos_din").parent().parent().show();
			$("#vrsta_fakture").hide();
			$("#utovar").hide();
			$("#istovar").hide();
			$("#fakturisanje").show();
			$("#cena_milsped").hide();
			$("#cena_default").show();
			$("#datum_prometa_usluge").parent().show();
			$("#valuta_placanja").parent().hide();
		} else if(id_nalogodavca == 16) {
			$("#rok_placanja_usluge").parent().show();
			$("#iznos_din").parent().parent().hide();
			$("#vrsta_fakture").hide();
			$("#utovar").hide();
			$("#istovar").hide();
			$("#fakturisanje").hide();
			$("#cena_milsped").hide();
			$("#cena_default").show();
			$("#datum_prometa_usluge").parent().show();
			$("#valuta_placanja").parent().hide();
		} else {
			$("#rok_placanja_usluge").parent().show();
			$("#iznos_din").parent().parent().show();
			$("#vrsta_fakture").hide();
			$("#utovar").hide();
			$("#istovar").hide();
			$("#fakturisanje").hide();
			$("#cena_milsped").hide();
			$("#cena_default").show();
			$("#datum_prometa_usluge").parent().show();
			$("#valuta_placanja").parent().hide();
		}

		/*
			Ovde treba da se ubace vrste robe u polje,
			u odnosu na to koji je nalogodavac izabran;
		*/
		$.post('php/vrstaRobe.php', {
			id: id_nalogodavca
		}, function(data) {
			if (data !== null) {
				$("#listaVrstaRobe").empty();
				$("#listaVrstaRobe").append(data);
			}
		});

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
			$("#broj_ture").parent().show();
		} else {
			ang_kamion = true;
			$("#nas_kamion").hide();
			$("#ang_kamion").show();
			$("#komplet_broj").parent().hide();
			$("#broj_ture").parent().hide();
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

		if (kursNaDanUtovara != null) {
			$("#dan_utovara_kurs").val(parseFloat(kursNaDanUtovara));
			$.ajaxSetup({async: true});
			kursEUR = kursNaDanUtovara;
		}
	});

	$("#dan_utovara_kurs").on('change', function () {
		if ($(this).val() != null)
			kursEUR = $(this).val();
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

		if (kursNaDanIstovara != null) {
			$("#dan_istovara_kurs").val(parseFloat(kursNaDanIstovara));
			$.ajaxSetup({async: true});
			kursEUR = kursNaDanIstovara;
		}
	});

	$("#dan_istovara_kurs").on('change', function () {
		if ($(this).val() != null)
			kursEUR = $(this).val();
	});

	$("#datum_fakturisanja").on('change', function () {
		var datum_fakturisanja = vratiDatum("datum_fakturisanja");
		var novi_datum = datum_fakturisanja.split('.')[0] + "-" + datum_fakturisanja.split('.')[1] + "-" + datum_fakturisanja.split('.')[2];

		$.ajaxSetup({async: false});
		$.post("php/kursNaDan.php", {
			datum: novi_datum,
		}, function (data) {
			kursNaDanFakturisanja = data;
		});

		if (kursNaDanFakturisanja != null) {
			$("#dan_fakturisanja_kurs").val(parseFloat(kursNaDanFakturisanja));
			$.ajaxSetup({async: true});
			kursEUR = kursNaDanFakturisanja;
		}
	});

	$("#dan_fakturisanja_kurs").on('change', function () {
		if ($(this).val() != null)
			kursEUR = $(this).val();
	});

	// </Datumi>
	//

	// <Cene za Milsped>
	//
	$("#cena_u_celosti_eur").change(function () {
		var celost_eur = $(this).val();
		var celost_din = dveDecimale(+this.value * +kursEUR);
		$("#cena_u_celosti_din").val(celost_din);

		var domaci_eur = dveDecimale(celost_eur * 10 / 100);
		console.log("domaci_eur: " + domaci_eur);
		var domaci_din = dveDecimale(+domaci_eur * +kursEUR);
		$("#cena_domaci_deo_eur").val(domaci_eur);
		$("#cena_domaci_deo_din").val(domaci_din);

		var inostrani_eur = dveDecimale(celost_eur - domaci_eur);
		var inostrani_din = dveDecimale(+celost_din - +domaci_din);
		console.log("inostrani_eur: " + inostrani_eur);
		$("#cena_inostrani_deo_eur").val(inostrani_eur);
		$("#cena_inostrani_deo_din").val(inostrani_din);
	});
	// </Cene za Milsped>
	//

	$('input[type="radio"][name="vrsta_fakture"]').on('change', function () {
		if (this.value == "kla_faktura") {
			ava_faktura = false;
			$("#istovar").show();
			$("#valuta_placanja").parent().hide();
			$("#kurs").hide();
			$("#broj_ture").parent().show();
			$("#datum_prometa_usluge").parent().show();
		} else {
			ava_faktura = true;
			$("#istovar").hide();
			$("#kurs").show();
			$("#broj_ture").parent().hide();
			$("#datum_prometa_usluge").parent().show();
		}
	});

	$("#iznos").on('change', function () {
		iznos = $(this).val();
		if (id_nalogodavca == 11)
			$("#iznos_din").val(dveDecimale(Math.round(dveDecimale((+iznos * +kursEUR) - (10 * kursEUR)))));
		else
			$("#iznos_din").val(dveDecimale((+iznos * +kursEUR)));
	});

	$("#kurs_rucni").on('change', function () {
		kursEUR = $(this).val();
	});
});
