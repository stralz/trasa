var tabela = "fakture";
var id_fakture = 0;
var obj = {};
var obj1 = {};
var domaci = false;
var dveTure = false;
var sablon = "";
var pocetnaForma = "";
var pocetnaFormaPrebaci = "";
var faktura = {};

function clearModalBody() {
	$('.modal > .modal-dialog > .modal-content > .modal-body > form').empty();
	$('.modal > .modal-dialog > .modal-content > .modal-body > form').html(pocetnaForma);

	$('#prebaciModal > .modal-dialog > .modal-content > .modal-body > form').empty();
	$('#prebaciModal > .modal-dialog > .modal-content > .modal-body > form').html(pocetnaFormaPrebaci);
}

function vratiDecimalu(decimala) {
	if (decimala > 0 && decimala < 10)
		return "0" + decimala + "/100";
	else if (decimala == "")
		return "00/100";
	else
		return decimala + "/100";
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

function dveDecimale(x) {
	return parseFloat(x).toFixed(2);
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
	pocetnaForma = $('.modal > .modal-dialog > .modal-content > .modal-body > form').html();
	pocetnaFormaPrebaci = $('#prebaciModal > .modal-dialog > .modal-content > .modal-body > form').html();

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
				$("#ang_tegljac").val(data.ang_tegljac);
				$("#ang_prikolica").val(data.ang_prikolica);
				$("#od").val(data.od);
				$("#do").val(data.do);
				$("#cmr").val(data.cmr);
				$("#vrsta_robe").val(data.vrsta_robe);
				$("#tezina").val(data.tezina);
				$("#iznos").val(data.iznos);
				$("#mesto_utovara").val(data.mesto_utovara);
				$("#mesto_istovara").val(data.mesto_istovara);
				$("#komplet_racun_broj").val(data.komplet_racun_broj);

				var date = data.datum_izdavanja;
				var day = date.substr(0, 2);
				var month = date.substr(3, 2);
				var year = date.substr(6, 4);
				date = year + "-" + month + "-" + day;
				$("#datum_izdavanja").val(date);

				date = data.datum_prometa;
				day = date.substr(0, 2);
				month = date.substr(3, 2);
				if(month >= 10)
					month = "0" + month;
				year = date.substr(6, 4);
				date = year + "-" + month + "-" + day;
				$("#datum_prometa").val(date);

				if(data.ang_tegljac != "" && data.ang_prikolica != "") {
					$("#ang_kamion").show();
					$("#nas_kamion").hide();
				} else {
					$("#ang_kamion").hide();
					$("#nas_kamion").show();
				}

				// End ubacivanja u inpute
				if(data.sablon.includes("1")) {
					if(data.sablon.includes("Dinarski")) {
						// Sakrije broj naloga 1
						$("#broj_naloga").parent().hide();
						$("label[for='broj_naloga']").hide();

						// Ubacuje Posiljaoca 1
						$("#mesto_utovara").val(data.mesto_utovara);
						// Ubacuje Primaoca 1
						$("#mesto_istovara").val(data.mesto_istovara);
					} else {
						// Sakrije mesto istovara 1
						$("#mesto_istovara").hide();
						$("label[for='mesto_istovara']").hide();
						// Sakrije mesto utovara 1
						$("#mesto_utovara").hide();
						$("label[for='mesto_utovara']").hide();

						// Ubacuje Broj naloga 1
						$("#broj_naloga").val(data.broj_naloga);
					}
				} else {
					if(data.sablon.includes("Dinarski")) {
						// Sakrije broj naloga 1
						$("#broj_naloga").parent().hide();
						$("label[for='broj_naloga']").hide();
					} else {
						// Sakrije mesto istovara 1
						$("#mesto_istovara").hide();
						$("label[for='mesto_istovara']").hide();
						// Sakrije mesto utovara 1
						$("#mesto_utovara").hide();
						$("label[for='mesto_utovara']").hide();

						// Ubacuje Broj naloga 1
						$("#broj_naloga").val(data.broj_naloga);
					}
				}
		});
	});

	$(".prebaci_dugme").click(function () {
		var idFakture = $(this).closest('tr').attr('id');
		id_fakture = idFakture;
		$.post('php/uzmiKolone.php', {
				'id' : idFakture,
			}, function (data) {
				faktura = data;
				if (data.ang_tegljac == "" && data.ang_prikolica == "")
					$("#p_broj_ture").show();
				else
					$("#p_broj_ture").parent().hide();
		});
	});

	$("#prebaci").click(function () {
		if (ang_prikolica != "" && ang_tegljac != "") {
			faktura["racun_broj"] = $("#p_broj_fakture").val() + "/" + $("#p_broj_ture").val() + "-" + faktura["racun_broj"].split("/")[1] + "/" + faktura["racun_broj"].split("/")[2];
			faktura["komplet_racun_broj"] = $("#p_broj_fakture").val() + "/" + $("#p_broj_ture").val() + "-" + faktura["komplet_racun_broj"].split("/")[1] + "/" + faktura["racun_broj"].split("/")[2];
		} else {
			faktura["racun_broj"] = $("#p_broj_fakture").val() + "/AK/" + faktura["racun_broj"].split("/")[2];
			faktura["komplet_racun_broj"] = $("#p_broj_fakture").val() + "/AK/" + faktura["komplet_racun_broj"].split("/")[2];
		}

		var brojFakture = $("#p_broj_fakture").val();
		var brojTure = $("#p_broj_ture").val();

		faktura["datum_prometa"] = vratiDatum("p_datum_prometa_usluge");
		faktura["datum_izdavanja"] = vratiDatum("p_datum_izdavanja");
		faktura["cmr"] = $("#p_cmr").val();
		faktura["tezina"] = $("#p_tezina").val();
		faktura["avansna"] = 0;

		$.post('php/napraviFakturu.php', faktura);

		var iznos = faktura["iznos"].replace(',', '');
		var intPart = parseInt(iznos);
		var decimala = iznos - Math.floor(iznos);
		decimala = Math.round(decimala * 100) / 100;
		decimala = decimala.toString().substr(2, 2);

		faktura["iznos"] = format_novac(dveDecimale(faktura["iznos"]), 2);
		faktura["kursEUR"] = format_novac(faktura["kursEUR"], 4, ',', '.');
		faktura["tezina"] = format_novac(faktura["tezina"], 2, ',', '.') + " kg";

		faktura["slovima"] = izBrojaUSlova(parseInt(iznos), 2, 1);
		faktura["slovima"] = faktura["slovima"] + " dinara i " + vratiDecimalu(decimala);

		/*
			Da bi se u sablonu videlo da to nije avansna faktura,
			vec da je to klasicna faktura.
		*/
		faktura["racun_broj"] = "Račun br. " + faktura["racun_broj"];

		var sablon = "";
		var nazivDokumenta = "";

		if (faktura["uvoz"] == 1) {
			sablon = "Milsped_uvoz";
			if (faktura["ang_prikolica"] == "" && faktura["ang_tegljac"] == "")
				nazivDokumenta = brojFakture + " Mn uvoz";
			else
				nazivDokumenta = brojFakture + " M uvoz";
		} else {
			sablon = "Milsped_izvoz";
			if (faktura["ang_prikolica"] == "" && faktura["ang_tegljac"] == "")
				nazivDokumenta = brojFakture + " Mn";
			else
				nazivDokumenta = brojFakture + " M";
		}

		$.post('php/ucitajNalogodavce.php', {
			ime: faktura["nalogodavac_ime"],
		}, function (data) {
			faktura["adresa"] = data["adresa"];
			faktura["pak"] = data["pak"];
			faktura["ime_nalogodavca"] = faktura["nalogodavac_ime"];
			faktura["pib_nalogodavca"] = data["pib"];

			$.post('php/kompleti.php', {
				tegljac_id: faktura["fk_tegljac"],
				prikolica_id: faktura["fk_prikolica"]
			}, function (data) {
				if (faktura["fk_tegljac"] == null) {
					faktura["tegljac"] = faktura["ang_tegljac"];
					faktura["prikolica"] = faktura["ang_prikolica"];
				} else {
					faktura["tegljac"] = data.split('|')[0];
					faktura["prikolica"] = data.split('|')[1];
				}

				loadFile("sabloni/" + sablon + ".docx",function(error,content){
					if (error) { throw error };
					var zip = new JSZip(content);
					var doc = new Docxtemplater().loadZip(zip)
					doc.setData(faktura);
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

		var racunBroj = $("#komplet_racun_broj").val();
		var imeNalogodavca = document.getElementById("nalogodavac").options[document.getElementById("nalogodavac").selectedIndex].text;
		obj1["ime_nalogodavca"] = imeNalogodavca;
		obj1["kursEUR"] = $("#pomocniKurs").text().substr(0, $("#pomocniKurs").text().length - 2);

		if(imeNalogodavca.includes("d.o.o"))
			domaci = true;
		else
			domaci = false;

		var iznos = 0;

		if(domaci && dveTure) {
			sablon = "DinarskiSablon2Ture";
			iznos = obj1["iznos"];
			obj1["iznos"] = iznos;
		} else if(domaci && !dveTure) {
			sablon = "DinarskiSablon1Tura";
			iznos = obj1["iznos"];
			obj1["iznos"] = iznos;
		} else if(!domaci && dveTure) {
			sablon = "DevizniSablon2Ture";
			iznos = obj1["iznos"];
			obj1["iznos"] = iznos;
		} else if(!domaci && !dveTure) {
			sablon = "DevizniSablon1Tura";
			iznos = obj1["iznos"]
			obj1["iznos"] = iznos;
		}

		obj1["iznosEUR"] = parseFloat(obj1["iznos"] / parseFloat(obj1["kursEUR"]).toFixed(2)).toFixed(2);
		obj1["racun_broj"] = racunBroj;
		var intPart = parseInt(iznos);
		var decimala = parseInt(Math.floor(100 * (iznos - intPart)));
		obj1["slovima"] = izBrojaUSlova(intPart, 1, 1) + " dinara i " + vratiDecimalu(decimala);

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

		var imeNalogodavca = document.getElementById("nalogodavac").options[document.getElementById("nalogodavac").selectedIndex].text;
		console.log("ime nalogodavca: " + imeNalogodavca);

		$.post('php/ucitajNalogodavce.php', {
			'ime': imeNalogodavca,
		}, function(data) {
			if (data === null) {
				console.error('Došlo je do greške.');
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

	$("#otvori").click(function () {
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

		if($("#racun_broj").val().includes("/AK/")) {
			obj1["tegljac"] = $("#ang_tegljac").val();
			obj1["prikolica"] = $("#ang_prikolica").val();
		}

		if(imeNalogodavca.includes("d.o.o"))
			domaci = true;
		else
			domaci = false;

		dveTure = false;

		var iznos = 0;

		if(domaci && dveTure) {
			sablon = "DinarskiSablon2Ture";
			iznos = obj1["iznos"];
			obj1["iznos"] = iznos;
		} else if(domaci && !dveTure) {
			sablon = "DinarskiSablon1Tura";
			iznos = obj1["iznos"];
			obj1["iznos"] = iznos;
		} else if(!domaci && dveTure) {
			sablon = "DevizniSablon2Ture";
			iznos = obj1["iznos"];
			obj1["iznos"] = iznos;
		} else if(!domaci && !dveTure) {
			sablon = "DevizniSablon1Tura";
			iznos = obj1["iznos"]
			obj1["iznos"] = iznos;
		}

		obj1["iznosEUR"] = parseFloat(obj1["iznos"] / parseFloat(obj1["kursEUR"]).toFixed(2)).toFixed(2);
		obj1["racun_broj"] = racunBroj;
		var intPart = parseInt(iznos);
		var decimala = parseInt(Math.floor(100 * (iznos - intPart)));
		obj1["slovima"] = izBrojaUSlova(intPart, 1, 1) + " dinara i " + vratiDecimalu(decimala) + "";

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

		var imeNalogodavca = document.getElementById("nalogodavac").options[document.getElementById("nalogodavac").selectedIndex].text;
		console.log("ime nalogodavca: " + imeNalogodavca);

		$.post('php/ucitajNalogodavce.php', {
			'ime': imeNalogodavca,
		}, function(data) {
			if (data === null) {
				console.error('Došlo je do greške.');
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
				console.error('Došlo je do greške.');
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
