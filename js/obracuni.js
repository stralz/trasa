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
}

function iznosiLitri() {
	var zbirEUR = 0;
	var zbirRSD = 0;
	var zbirL = 0;
	
	var faktura1 = $("#faktura1").val();
	var faktura2 = $("#faktura2").val();
	
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
}

function ponderisana(i, brRac) {
	var litri = 0;
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
	
	$("#ponderisana" + i).text(parseFloat(+ukIznos / +litri).toFixed(2));
}

var dveFakture = false;
var brojTroskova = 0;
var brojGoriva = 0;
var plata = 0;
var defaultTrosakModal = "";
var defaultGorivoModal = "";

$(function () {
	defaultTrosakModal = $("#trosakModalBody").html();
	defaultGorivoModal = $("#gorivoModalBody").html();
	
	$("#dodajFakturu").click(function () {
		if(dveFakture == false) {
			$(this).removeClass("btn-success");
			$(this).addClass("btn-danger");
			$(this).html('<i class="fas fa-minus">');
			dveFakture = true;
			$("#divFaktura2").show();
			$("#povratak").css("display", "block");
		} else {
			$(this).removeClass("btn-danger");
			$(this).addClass("btn-success");
			$(this).html('<i class="fas fa-plus">');
			dveFakture = false;
			$("#divFaktura2").hide();
			$("#faktura2").val("");
			$("#povratak").css("display", "none");
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
		});
		
		clearModalBody();
		/*$('.obrisi').click(function () {
			if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
				var red_id = $(this).closest('tr').attr('id');
				
				$.post('php/obrisiRed.php', {
					'red_id': red_id,
					'baza': "troskovi"
				});
				$("tr[id='" + red_id +"']").remove();
			}
			else{
				return false;
			}
		});*/
		
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
			$("#tableGorivo> tbody").append("<tr id=\"" + data + "\"><td class=\"gorivoRedniBroj\">" + brojGoriva + ". &nbsp;<a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td><td>" + datum + "</td><td>" + kilometraza + "</td><td>" + mestoTankiranja + "</td>" +"<td class=\"gorivoIznos" + faktura + "\">" + iznos + "</td><td class=\"kolicinaLitara" + faktura + "\">" + kolicinaLitara + "</td><td>" + cenaPoLitru + "</td></tr>").ready(function () {
				if(faktura == $("#faktura1").val()) {
					ponderisana(1, faktura);
				} else {
					ponderisana(2, faktura);
				}
			});
			iznosiLitri();
			if(faktura == $("#faktura1").val()) {
				ponderisana(1, faktura);
			}
			if(faktura == $("#faktura2").val()) {
				ponderisana(2, faktura);
			}
		});
		
		clearModalBody();
		// **********************************************************************************************
		// ** Ovde treba stajati kod za brisanje svih "onclick" eventa za svaki element klase "obrisi" **
		// **********************************************************************************************
		/*$('.obrisi').click(function() {
			e.preventDefault();
			if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
				var red_id = $(this).closest('tr').attr('id');
				
				$.post('php/gorivo.php', {
					'red_id': red_id,
					'baza': "gorivo"
				});
				$("tr[id='" + red_id +"']").remove();
			}
			else{
				return false;
			}
		});*/
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
				/*$('.obrisi').click(function(e) {
					e.preventDefault();
					if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
						var red_id = $(this).closest('tr').attr('id');
						
						$.post('php/troskovi.php', {
							'red_id': red_id,
							'baza': "troskovi"
						});
						$("tr[id='" + red_id +"']").remove();
					}
					else{
						return false;
					}
				});*/
			}
		});
		
		$.post("php/gorivo.php", {
			pomocni: "pomocni",
			faktura: faktura,
			brojGoriva: 0,
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
				/*$('.obrisi').click(function(e) {
						e.preventDefault();
						if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
							var red_id = $(this).closest('tr').attr('id');
							
							$.post('php/gorivo.php', {
								'red_id': red_id,
								'baza': "gorivo"
							});
							$("tr[id='" + red_id +"']").remove();
						}
						else{
							return false;
						}
				});*/
			});
		brojGoriva = $(".gorivoRedniBroj").last().text().split('.')[0];
		
		$.post("php/kip.php", {
			faktura: faktura,
			pomocni: "pomocni"
		}, function (data) {
			var pocetnaKilometraza = data.split(' ')[0];
			var zavrsnaKilometraza = data.split(' ')[1];
			var potrosnja = data.split(' ')[2];
			
			$("#pocetnaKilometraza").val(pocetnaKilometraza);
			$("#zavrsnaKilometraza").val(zavrsnaKilometraza);
			$("#potrosnja").val(potrosnja);
			$("#ukupnoKilometara").val(+zavrsnaKilometraza - +pocetnaKilometraza);
			$("#ukupnoPotrosenoLitara").val(parseFloat((+potrosnja * (+zavrsnaKilometraza - +pocetnaKilometraza)) / 100).toFixed(2));
		});
		
		$.post("php/troskovi.php", {
			faktura: faktura,
			pomocni: 12,
		}, function (data) {
			$("#odlazak").append(data);
				$.post('php/plata.php', {
				komplet: $("#faktura1").val(),
			}, function (data) {
				plata += (parseFloat($("#odlazak").text().substr(14, $("#odlazak").text().length)) * +data / 100);
				$("#plata").text("Plata: " + plata);
				$("#procenat").text(data);
				console.log(data);
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
				/*$('.obrisi').click(function(e) {
					e.preventDefault();
					if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
						var red_id = $(this).closest('tr').attr('id');
						
						$.post('php/troskovi.php', {
							'red_id': red_id,
							'baza': "troskovi"
						});
						$("tr[id='" + red_id +"']").remove();
					}
					else{
						return false;
					}
				});*/
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
				/*$('.obrisi').click(function(e) {
						e.preventDefault();
						if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
							var red_id = $(this).closest('tr').attr('id');
							
							$.post('php/gorivo.php', {
								'red_id': red_id,
								'baza': "gorivo"
							});
							$("tr[id='" + red_id +"']").remove();
						}
						else{
							return false;
						}
				});*/
		});
		
		$.post("php/troskovi.php", {
			faktura: faktura,
			pomocni: 12,
		}, function (data) {
			$("#povratak").append(data);
			console.log($("#povratak").text());
			console.log("plata1: " + plata);
			console.log("dodatak: " + parseFloat($("#povratak").text().substr(15, $("#povratak").text().length)) * +($("#procenat").text()) / 100);
			plata += parseFloat($("#povratak").text().substr(15, $("#povratak").text().length)) * +($("#procenat").text()) / 100;
			console.log(plata);
			$("#plata").text("Plata: " + plata);
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
			var odlazak = parseFloat($("#odlazak").text().substr(9, $("#odlazak").text().length));
			var povratak = parseFloat($("#povratak").text().substr(10, $("#povratak").text().length));
			var plata = parseFloat($("#plata").text().substr(7, $("#plata").text().length));
			var ostalo = parseFloat($("#ostalo").text().substr(7, $("#ostalo").text().length));
			var obj = {
				faktura1: $("#faktura1").val(),
				faktura2: $("#faktura2").val(),
				odlazak: odlazak,
				povratak: povratak,
				plata: plata,
				ostalo: ostalo,
			};
			
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
		} else {
			var odlazak = parseFloat($("#odlazak").text().substr(9, $("#odlazak").text().length));
			var plata = parseFloat($("#plata").text().substr(7, $("#plata").text().length));
			var ostalo = parseFloat($("#ostalo").text().substr(7, $("#ostalo").text().length));
			
			var obj = {
				faktura1: $("#faktura1").val(),
				odlazak: odlazak,
				povratak: povratak,
				plata: plata,
				ostalo: ostalo,
			};
			
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
				saveAs(out, $("#faktura1").val() + ".docx")
			});
		}
	});
	
	$('.obrisi').click(function () {
		if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
			var red_id = $(this).closest('tr').attr('id');
			
			$.post('php/obrisiRed.php', {
				'red_id': red_id,
				'baza': "troskovi"
			});
			$("tr[id='" + red_id +"']").remove();
		}
		else{
			return false;
		}
	});
});























