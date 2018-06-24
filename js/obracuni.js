function clearModalBody() {
	$("#trosakModalBody").html(defaultTrosakModal);
	$("#gorivoModalBody").html(defaultGorivoModal);
}

function vratiDatum(datepicker) {
	var tmp = document.getElementById(datepicker).value;
	var date = tmp.split('-');
	var day = date[2];
	var month = date[1];
	var year = date[0];
	return day + '.' + month + '.' + year;
}

function obrisi() {
	$('.obrisi').unbind();
	$('.obrisi').click(function () {
		if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
			var red_id = $(this).closest('tr').attr('id');
			var baza = $(this).closest('table').attr('id').replace('table', '').toLowerCase();
			console.log(baza);
			
			$.post('php/obrisiRed.php', {
				'red_id': red_id,
				'baza': baza,
			});
			$("tr[id='" + red_id +"']").remove();
			iznosi();
			iznosiLitri();
		}
		else{
			return false;
		}
	});
}

function ostalo() {
	if(dveFakture) {
		var odlazna = $("#odlazak").text();
		
		if(odlazna.includes("EUR"))
			odlazna = parseFloat(parseFloat(odlazna.substr(14, odlazna.length))).toFixed(2);
		else {
			odlazna = parseFloat(odlazna.substr(14, odlazna.length));
			odlazna = parseFloat(odlazna / kursEUR).toFixed(2);
		}
		var povratna = $("#povratak").text();
		if(povratna.includes("EUR"))
			povratna = parseFloat(parseFloat(povratna.substr(15, povratna.length))).toFixed(2);
		else {
			povratna = parseFloat(povratna.substr(15, povratna.length));
			povratna = parseFloat(povratna / kursEUR).toFixed(2);
		}
		var plata = $("#plata").text();
		plata = parseFloat(plata.substr(7, plata.length));
		var troskoviGoriva = $("#troskoviGoriva").text();
		troskoviGoriva = parseFloat(troskoviGoriva.substr(17, troskoviGoriva.length));
		var ostaliTroskovi = $("#ostaliTroskovi").text();
		ostaliTroskovi = parseFloat(ostaliTroskovi.substr(17, ostaliTroskovi.length));
		$("#ostalo").text("Ostalo: " + parseFloat(+(+odlazna + +povratna - +plata - +troskoviGoriva - +ostaliTroskovi)).toFixed(2));
	} else {
		var odlazna = $("#odlazak").text();
		if(odlazna.includes("EUR"))
			odlazna = parseFloat(parseFloat(odlazna.substr(14, odlazna.length))).toFixed(2);
		else {
			odlazna = parseFloat(odlazna.substr(14, odlazna.length));
			odlazna = parseFloat(odlazna / kursEUR).toFixed(2);
		}
		var plata = $("#plata").text();
		plata = parseFloat(plata.substr(7, plata.length));
		var troskoviGoriva = $("#troskoviGoriva").text();
		troskoviGoriva = parseFloat(troskoviGoriva.substr(17, troskoviGoriva.length));
		var ostaliTroskovi = $("#ostaliTroskovi").text();
		ostaliTroskovi = parseFloat(ostaliTroskovi.substr(17, ostaliTroskovi.length));
		$("#ostalo").text("Ostalo: " + parseFloat(+(odlazna - plata - troskoviGoriva - ostaliTroskovi)).toFixed(2));
	}
}

function iznosi() {
	var zbirEUR = 0;
	var zbirKN = 0;
	var zbirRSD = 0;
	$(".troskoviIznos").each(function () {
		if($(this).text().includes("EUR")) {
			var x = $(this).text();
			x = x.substr(0, x.indexOf("EUR") - 1);
			zbirEUR = parseFloat(+zbirEUR + +x).toFixed(2);
		}
		if($(this).text().includes("KN")) {
			var x = $(this).text();
			x = x.substr(0, x.indexOf("KN") - 1);
			zbirKN = parseFloat(+zbirKN + +x).toFixed(2);
		}
		if($(this).text().includes("RSD")) {
			var x = $(this).text();
			x = x.substr(0, x.indexOf("RSD") - 1);
			zbirRSD = parseFloat(+zbirRSD + +x).toFixed(2);
		}
	});
	
	$("#troskoviTotalEUR").text("EUR: " + zbirEUR);
	$("#troskoviTotalKN").text("KN: " + zbirKN);
	$("#troskoviTotalRSD").text("RSD: " + zbirRSD);
	$("#ostaliTroskovi").text("Ostali troškovi: " + (+parseFloat(zbirRSD / kursEUR) + +zbirEUR + (zbirKN * kursKN) / kursEUR).toFixed(2) + " EUR");
	ostalo();
}

function iznosiLitri() {
	var zbirEUR = 0;
	var zbirRSD = 0;
	var zbirL = 0;
	
	var faktura1 = $("#faktura1").val().split('-')[0];
	var faktura2 = $("#faktura2").val().split('-')[0];
	
	$(".gorivoIznos" + faktura1).each(function () {if($(this).text().includes("EUR")) {
			var x = $(this).text();
			x = x.substr(0, x.indexOf("EUR") - 1);
			zbirEUR = parseFloat(+zbirEUR + +x).toFixed(2);
		}
		if($(this).text().includes("RSD")) {
			var x = $(this).text();
			x = x.substr(0, x.indexOf("RSD") - 1);
			zbirRSD = parseFloat(+zbirRSD + +x).toFixed(2);
		}
	});
	
	$(".gorivoIznos" + faktura2).each(function () {if($(this).text().includes("EUR")) {
			var x = $(this).text();
			x = x.substr(0, x.indexOf("EUR") - 1);
			zbirEUR = parseFloat(+zbirEUR + +x).toFixed(2);
		}
		if($(this).text().includes("RSD")) {
			var x = $(this).text();
			x = x.substr(0, x.indexOf("RSD") - 1);
			zbirRSD = parseFloat(+zbirRSD + +x).toFixed(2);
		}
	});
	
	$(".kolicinaLitara" + faktura1).each(function () {
		var x = $(this).text();
		zbirL = parseFloat(+zbirL + +x).toFixed(2);
	});
	
	$(".kolicinaLitara" + faktura2).each(function () {
		var x = $(this).text();
		zbirL = parseFloat(+zbirL + +x).toFixed(2);
	});
	
	$("#gorivoTotalEUR").text("EUR: " + zbirEUR);
	$("#gorivoTotalRSD").text("RSD: " + zbirRSD);
	$("#gorivoTotalL").text("L: " + zbirL);
	$("#troskoviGoriva").text("Troškovi goriva: " + (+parseFloat(zbirRSD / kursEUR) + +zbirEUR).toFixed(2) + " EUR");
	ostalo();
}

function ponderisana(i, brRac) {
	var litri = 0;
	brRac = brRac.split('-')[0];
	$(".kolicinaLitara" + brRac).each(function () {
		litri += +($(this).text());
	});
	
	var ukIznos = 0;
	$(".gorivoIznos" + brRac).each(function () {
		var x = $(this).text();
		if(x.includes("EUR")) {
			x = x.substr(0, x.length - 4);
			var kursEUR = parseFloat($("#kursEUR").text().trim().replace(',','.')).toFixed(2);
			ukIznos += +(x) * +(kursEUR);
		}
		x = x.substr(0, x.length - 4);
		ukIznos += +(x);
	});
	if(litri == 0)
		$("#ponderisana" + i).text("0 din.");
	else
		$("#ponderisana" + i).text(parseFloat(+ukIznos / +litri).toFixed(2) + " din.");
}

//******************************************************
//**********************GLOBALE*************************
//******************************************************

var dveFakture = false;
var brojTroskova = 0;
var brojGoriva = 0;
var plata = 0;
var defaultTrosakModal = "";
var defaultGorivoModal = "";
var odlazak = 0;
var povratak =  0;
var plataUEUR = 0;
var kursEUR = 0;
var kursKN = 0;
var strano = false;
var valuta = " din.";

$(function () {
	defaultTrosakModal = $("#trosakModalBody").html();
	defaultGorivoModal = $("#gorivoModalBody").html();
	
	kursEUR = parseFloat($("#kursEUR").text().trim().replace(',', '.')).toFixed(2);
	console.log("KursEUR: " + kursEUR);
	kursKN = parseFloat($("#kursKN").text().trim().replace(',', '.')).toFixed(2);
	console.log("KursKN: " + kursKN);
	
	$("#dodajFakturu").click(function () {
		if(dveFakture == false) {
			$(this).removeClass("btn-success");
			$(this).addClass("btn-danger");
			$(this).html('<i class="fas fa-minus">');
			dveFakture = true;
			$("#divFaktura2").show();
			$("#povratak").css("display", "block");
			$("#ponder2").css("display", "block");
		} else {
			$(this).removeClass("btn-danger");
			$(this).addClass("btn-success");
			$(this).html('<i class="fas fa-plus">');
			dveFakture = false;
			$("#divFaktura2").hide();
			$("#faktura2").val("");
			$("#povratak").css("display", "none");
			$("#ponder2").css("display", "none");
		}
	});
	
	$("#dodajTrosak").click(function () {
		brojTroskova = $(".troskoviRedniBroj").last().text().split('.')[0];
		brojTroskova++;
		var datum = vratiDatum("trosakDatum");
		var trosak = $("#trosak").val();
		var iznos = $("#trosakIznos").val();
		var valuta = document.getElementById("trosakValuta").options[document.getElementById("trosakValuta").selectedIndex].text;
		var faktura = "";
		
		if(dveFakture) {
			faktura = $("input:radio[name='optradio']:checked").closest('label').text();
			faktura = faktura.substr(1, faktura.length);
		}
		else
			faktura = $("#faktura1").val();
		
		$.post("php/troskovi.php", {
			faktura: faktura,
			trosak : trosak,
			iznos: iznos,
			valuta: valuta,
			datum: datum,
		}, function (data) {
			$("#tableTroskovi > tbody").append("<tr id=\"" + data + "\"><td class=\"troskoviRedniBroj\">" + brojTroskova + ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td><td>" + datum + "</td><td>" + trosak + "</td><td class=\"troskoviIznos\">" + iznos + " " + valuta + "</td></tr>");
			iznosi();
		});
		
		clearModalBody();
		obrisi();

		if(valuta == "EUR") {
			var trenutno = $("#troskoviTotalEUR").text().substr(4, $("#troskoviTotalEUR").text().length);
			iznos = parseFloat(iznos);
			$("#troskoviTotalEUR").text("EUR: " + (+trenutno + +iznos).toFixed(2));
		}
		if (valuta == "KN") {
			var trenutno = $("#troskoviTotalKN").text().substr(3, $("#troskoviTotalKN").text().length);
			iznos = parseFloat(iznos);
			$("#troskoviTotalKN").text("KN: " + (+trenutno + +iznos).toFixed(2));
		}
		if (valuta == "RSD") {
			var trenutno = $("#troskoviTotalRSD").text().substr(4, $("#troskoviTotalRSD").text().length);
			iznos = parseFloat(iznos);
			$("#troskoviTotalRSD").text("RSD: " + (+trenutno + +iznos).toFixed(2));
		}
	});
	
	$("#dodajGorivo").click(function () {
		brojGoriva = $(".gorivoRedniBroj").last().text().split('.')[0];
		if(brojGoriva == "")
			brojGoriva = 0;
		brojGoriva++;
		
		var datum = vratiDatum("gorivoDatum");
		var kilometraza = $("#kilometraza").val();
		var mestoTankiranja = $("#mestoTankiranja").val();
		var kolicinaLitara = parseFloat($("#kolicinaLitara").val()).toFixed(2);
		var cenaPoLitru = parseFloat($("#cenaPoLitru").val()).toFixed(2);
		var faktura = "";
		
		if(dveFakture) {
			faktura = $("input:radio[name='optradio']:checked").closest('label').text();
			faktura = faktura.substr(1, faktura.length);
		}
		else
			faktura = $("#faktura1").val();
		
		var valuta = $("input:radio[name='valuta']:checked").closest('label').text();
		valuta = valuta.substr(1, valuta.length);
		
		var iznos = parseFloat(+parseFloat(kolicinaLitara) * +parseFloat(cenaPoLitru)).toFixed(2);
		iznos = iznos + " " + valuta;
		
		$.post("php/gorivo.php", {
			faktura: faktura,
			datum: datum,
			kilometraza: kilometraza,
			mestoTankiranja: mestoTankiranja,
			kolicinaLitara: kolicinaLitara,
			cenaPoLitru: cenaPoLitru,
			brojGoriva: brojGoriva,
			iznos: iznos
		}, function (data) {
			$("#tableGorivo> tbody").append("<tr id=\"" + data + "\"><td class=\"gorivoRedniBroj\">" + brojGoriva + ". &nbsp;<a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td><td>" + datum + "</td><td>" + kilometraza + "</td><td>" + mestoTankiranja + "</td>" +"<td class=\"gorivoIznos" + faktura.split('-')[0] + "\">" + iznos + "</td><td class=\"kolicinaLitara" + faktura.split('-')[0] + "\">" + kolicinaLitara + "</td><td>" + cenaPoLitru + "</td></tr>").ready(function () {
				if(faktura == $("#faktura1").val()) {
					ponderisana(1, faktura);
				} else {
					ponderisana(2, faktura);
				}
				obrisi();
				iznosiLitri();
			});
			
			if(faktura == $("#faktura1").val()) {
				ponderisana(1, faktura);
			}
			if(faktura == $("#faktura2").val()) {
				ponderisana(2, faktura);
			}
		});
		
		clearModalBody();
	});
	
	$("#otvoriModal").click(function () {
		if(dveFakture) {
			var faktura1 = $("#faktura1").val();
			var faktura2 = $("#faktura2").val();
			$("#trosakModalBody > form").prepend("<div class=\"form-group\"><label for=\"kojaFaktura\">Faktura:</label><div class=\"radio\"><label><input type=\"radio\" name=\"optradio\"> " + faktura1 + "</label></div><div class=\"radio\"><label><input type=\"radio\" name=\"optradio\"> " + faktura2 + "</label></div></div>");
		}
	});
	
	$("#otvoriModalGorivo").click(function () {
		if(dveFakture) {
			var faktura1 = $("#faktura1").val();
			var faktura2 = $("#faktura2").val();
			$("#gorivoModalBody > form").prepend("<div class=\"form-group\"><label for=\"kojaFaktura\">Faktura:</label><div class=\"radio\"><label><input type=\"radio\" name=\"optradio\"> " + faktura1 + "</label></div><div class=\"radio\"><label><input type=\"radio\" name=\"optradio\"> " + faktura2 + "</label></div></div>");
		}
	});
	
	$("#faktura1").change(function () {
		if($(this).val() == "") {
			$("#tableTroskovi > tbody").empty();
			$("#tableGorivo > tbody").empty();
		}
		var brojRacuna = $(this).val();
		$("#racun_broj1").text(brojRacuna);
		var faktura = $(this).val();
		
		$.post("php/troskovi.php", {
			faktura: faktura,
			pomocni: 12,
		}, function (data) {
			odlazak = data;
			if(odlazak.includes("d.o.o."))
				valuta = " din.";
			else {
				valuta = " EUR";
				strano = true;
			}
			$("#odlazak").append(data).append(valuta);
			$.post('php/plata.php', {
				komplet: $("#faktura1").val().split('-')[1].split('/')[0],
			}, function (data) {
				if(odlazak.includes("d.o.o")) {
					plata += (parseFloat($("#odlazak").text().substr(14, $("#odlazak").text().length)) * +data / 100);
					plataUEUR += parseFloat(+plata / kursEUR).toFixed(2);
				}
				else {
					plata += (parseFloat($("#odlazak").text().substr(14, $("#odlazak").text().length)) * +data / 100) * kursEUR;
					plataUEUR = parseFloat(+plata / kursEUR).toFixed(2);
				}
				$("#plata").text("Plata: " + parseFloat(plataUEUR).toFixed(2)).append(" EUR");
				$("#procenat").text(data);
			});
		}).done(function () {
			$.post("php/troskovi.php", {
		    pomocni: "pomocni",
			faktura: faktura,
			brojTroskova: 0,
			}, function (data) {
				if (data == null) {
					console.log('Nešto si zeznuo');
				} else {
					$("#tableTroskovi > tbody").append(data);
					if(data != "")
						$("#pomocniRed1").remove();
					iznosi();
					obrisi();
				}
			});
			
			$.post("php/gorivo.php", {
				pomocni: "pomocni",
				faktura: faktura,
				brojGoriva: 1,
				brojRacuna: brojRacuna,
			}, function (data) {
				$("#tableGorivo > tbody").append(data).ready(function () {
					//
					// Ponderisana cena: 1
					//
					ponderisana(1, brojRacuna);
				});
					if(data != "")
						$("#pomocniRed2").remove();
					iznosiLitri();
					obrisi();
				});
			brojGoriva = $(".gorivoRedniBroj").last().text().split('.')[0];
			
			$.post("php/kip.php", {
				faktura: faktura,
				pomocni: "pomocni"
			}, function (data) {
				var pocetnaKilometraza = data.split(' ')[0];
				var zavrsnaKilometraza = data.split(' ')[1];
				var ukupnaKilometraza = +zavrsnaKilometraza - +pocetnaKilometraza;
				var potrosnja = data.split(' ')[2];
				
				$("#pocetnaKilometraza").val(pocetnaKilometraza);
				$("#zavrsnaKilometraza").val(zavrsnaKilometraza);
				$("#potrosnja").val(potrosnja);
				$("#ukupnoKilometara").val(isNaN(ukupnaKilometraza) ? "0" : ukupnaKilometraza);
				$("#ukupnoPotrosenoLitara").val(parseFloat((+potrosnja * (+zavrsnaKilometraza - +pocetnaKilometraza)) / 100).toFixed(2));
			});
		});
		
	});
	
	$("#faktura2").change(function () {
		if($(this).val() == "") {
			$("#tableTroskovi > tbody").empty();
			$("#tableGorivo > tbody").empty();
		}
		$("#racun_broj2").text($(this).val());
		var faktura = $(this).val();
		var brojRacuna = $(this).val();
		brojTroskova = $(".troskoviRedniBroj").last().text().split('.')[0];
		
		$.post("php/troskovi.php", {
			pomocni: "pomocni",
			faktura: faktura,
			brojTroskova: brojTroskova,
		}, function (data) {
			if (data == null) {
				console.log('Nešto si zeznuo');
			} else {
				$("#tableTroskovi > tbody").append(data);
				iznosi();
				obrisi();
			}
		});
		
		brojGoriva = $(".gorivoRedniBroj").last().text().split('.')[0];
		
		$.post("php/gorivo.php", {
			pomocni: "pomocni",
			faktura: faktura,
			brojGoriva: brojGoriva,
			brojRacuna: brojRacuna,
		}, function (data) {
			$("#tableGorivo > tbody").append(data);
				if(data != "")
					$("#pomocniRed2").remove();
				iznosiLitri();
				ponderisana(2, brojRacuna);
				obrisi();
		});
		
		$.post("php/troskovi.php", {
			faktura: faktura,
			pomocni: 12,
		}, function (data) {
			polazak = data;
			if(polazak.includes("d.o.o."))
				valuta = " din.";
			else {
				valuta = " EUR";
				strano = true;
			}
			$("#povratak").append(data).append(valuta);
			if(polazak.includes("d.o.o")) {
				plata += parseFloat($("#povratak").text().substr(15, $("#povratak").text().length)) * +($("#procenat").text()) / 100;
				plataUEUR += parseFloat(+plata / kursEUR).toFixed(2);
			}
			else {
				plata += (parseFloat($("#povratak").text().substr(15, $("#povratak").text().length)) * +($("#procenat").text()) / 100) * kursEUR;
				plataUEUR = parseFloat(+plata).toFixed(2);
			}
			plataUEUR = parseFloat(+plata / kursEUR).toFixed(2);
			$("#plata").text("Plata: " + parseFloat(plataUEUR).toFixed(2)).append(" EUR");
		}).done(function () {
			ostalo();
		});
	});
	
	$("#pocetnaKilometraza").change(function () {
		var pocetnaKilometraza = $(this).val();
		var zavrsnaKilometraza = $("#zavrsnaKilometraza").val();
		
		if(zavrsnaKilometraza != "" && pocetnaKilometraza != "") {
			$("#ukupnoKilometara").val(+zavrsnaKilometraza - +pocetnaKilometraza);
		}
	});
	
	$("#zavrsnaKilometraza").change(function () {
		var pocetnaKilometraza = $("#pocetnaKilometraza").val();
		var zavrsnaKilometraza = $(this).val();
		
		if(pocetnaKilometraza != "" && zavrsnaKilometraza != "") {
			$("#ukupnoKilometara").val(+zavrsnaKilometraza - +pocetnaKilometraza);
		}
	});
	
	$("#potrosnja").change(function () {
		var potrosnja = $(this).val();
		var ukupnoKilometara = $("#ukupnoKilometara").val();
		
		if(potrosnja != "" && ukupnoKilometara != "") {
			$("#ukupnoPotrosenoLitara").val(parseFloat((+potrosnja * +ukupnoKilometara) / 100).toFixed(2));
		}
	});
	
	$("#azurirajKiP").click(function (e) {
		e.preventDefault();
		if($(".kip").val() != "") {
			var pocetnaKilometraza = $("#pocetnaKilometraza").val();
			var zavrsnaKilometraza = $("#zavrsnaKilometraza").val();
			var potrosnja = $("#potrosnja").val();
			var faktura = $("#faktura1").val();
			
			$.post("php/kip.php", {
				faktura: faktura,
				pocKm: pocetnaKilometraza,
				zavKm: zavrsnaKilometraza,
				potrosnja: potrosnja,
			});
			
			alert("Azurirano.");
		} else {
			alert("Jedno od polja je prazno.");
		}
	});
	
	$("#sacuvaj").click(function () {
		if(dveFakture) {
			var odlazak = parseFloat($("#odlazak").text().substr(14, $("#odlazak").text().length));
			var povratak = parseFloat($("#povratak").text().substr(15, $("#povratak").text().length));
			var plata = parseFloat($("#plata").text().substr(7, $("#plata").text().length));
			var troskovi = parseFloat($("#ostaliTroskovi").text().substr(17, $("#ostaliTroskovi").text().length));
			var gorivo = parseFloat($("#troskoviGoriva").text().substr(17, $("#ostaliTroskovi").text().length));
			var ostalo = parseFloat($("#ostalo").text().substr(7, $("#ostalo").text().length));
			var obj = {
				racunbroj1: $("#faktura1").val(),
				racunbroj2: $("#faktura2").val(),
				odlazak: odlazak,
				povratak: povratak,
				ukupno_ture: parseFloat(+odlazak + +povratak).toFixed(2),
				plata: parseFloat(plata).toFixed(2) + "€",
				troskovi: parseFloat(troskovi).toFixed(2) + "€",
				gorivo: parseFloat(gorivo).toFixed(2) + "€",
				ukupni_troskovi: parseFloat(+plata + +troskovi + +gorivo).toFixed(2) + "€",
				ostalo: parseFloat(ostalo).toFixed(2),
			};
			
			$.post("php/plata.php", {
				faktura1: $("#faktura1").val(),
				faktura2: $("#faktura2").val(),
				komplet: $("#faktura1").val().split('-')[1].split('/')[0],
				pomocni: 12
			}, function (data) {
				var vozac = data.split('{')[1] + " " + data.split('{')[2];
				var komplet = data.split('{')[3] + " / " + data.split('{')[4] + " - " + data.split('{')[5];
				var od1 = data.split('{')[6];
				var zaj = data.split('{')[7];
				var do2 = data.split('{')[8];
				obj["vozac"] = vozac;
				obj["komplet"] = komplet;
				obj["od"] = od1;
				obj["zaj"] = zaj;
				obj["do"] = do2;
				loadFile("sabloni/DveFakture.docx",function(error,content){
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
					saveAs(out, $("#faktura1").val() + " i " + $("#faktura2").val() + ".docx")
				});
			});
		} else {
			var odlazak = parseFloat($("#odlazak").text().substr(14, $("#odlazak").text().length));
			if($("#odlazak").text().includes("d.o.o"))
				odlazak = parseFloat(odlazak / kursEUR).toFixed(2);
			var plata = parseFloat($("#plata").text().substr(7, $("#plata").text().length));
			var ostalo = parseFloat($("#ostalo").text().substr(7, $("#ostalo").text().length));
			var troskovi = parseFloat($("#ostaliTroskovi").text().substr(17, $("#ostaliTroskovi").text().length));
			var gorivo = parseFloat($("#troskoviGoriva").text().substr(17, $("#ostaliTroskovi").text().length));
			
			var obj = {
				racunbroj1: $("#faktura1").val(),
				odlazak: odlazak,
				plata: parseFloat(plata).toFixed(2) + "€",
				troskovi: parseFloat(troskovi).toFixed(2) + "€",
				gorivo: parseFloat(gorivo).toFixed(2) + "€",
				ukupni_troskovi: parseFloat(+plata + +troskovi + +gorivo).toFixed(2) + "€",
				ostalo: parseFloat(ostalo).toFixed(2),
			};
			$.post("php/plata.php", {
				faktura1: $("#faktura1").val(),
				komplet: $("#faktura1").val().split('-')[1].split('/')[0],
				pomocni: 12
			}, function (data) {
				var vozac = data.split('{')[1] + " " + data.split('{')[2];
				var komplet = data.split('{')[3] + " / " + data.split('{')[4] + " - " + data.split('{')[5];
				var od1 = data.split('{')[6];
				var do1 = data.split('{')[7];
				var drzava1 = data.split('{')[8];
				var drzava2 = data.split('{')[9];
				drzava1 = drzava1 == "SRB" ? "Srbija" : "Italija";
				drzava2 = drzava2 == "SRB" ? "Srbija" : "Italija";
				obj["vozac"] = vozac;
				obj["komplet"] = komplet;
				obj["od"] = od1;
				obj["do"] = do1;
				obj["drzava1"] = drzava1;
				obj["drzava2"] = drzava2;
				loadFile("sabloni/JednaFaktura.docx",function(error,content){
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
					saveAs(out, $("#faktura1").val() + ".docx")
				});
			});
		}
	});
});























