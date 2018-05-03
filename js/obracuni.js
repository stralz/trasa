function clearModalBody() {
	$("#trosakModalBody").html(defaultTrosakModal);
}

function vratiDatum(datepicker) {
	var tmp = document.getElementById(datepicker).value;
	var date = tmp.split('-');
	var day = date[2];
	var month = date[1];
	var year = date[0];
	return day + '.' + month + '.' + year;
}

var dveFakture = false;
var brojTroskova = 0;
var defaultTrosakModal = "";

$(function () {
	defaultTrosakModal = $("#trosakModalBody").html();
	
	$("#dodajFakturu").click(function () {
		if(dveFakture == false) {
			$(this).removeClass("btn-success");
			$(this).addClass("btn-danger");
			$(this).html('<i class="fas fa-minus">');
			dveFakture = true;
			$("#divFaktura2").show();
		} else {
			$(this).removeClass("btn-danger");
			$(this).addClass("btn-success");
			$(this).html('<i class="fas fa-plus">');
			dveFakture = false;
			$("#divFaktura2").hide();
			$("#faktura2").val("");
		}
	});
	
	$("#dodajTrosak").click(function () {
		brojTroskova = $(".redni_broj").last().text().split('.')[0];
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
		
		var redni_broj = 0;
		
		$.post("php/troskovi.php", {
			faktura: faktura,
			trosak : trosak,
			iznos: iznos,
			valuta: valuta,
			datum: datum,
		}, function (data) {
			$("#tableTroskovi > tbody").append("<tr id=\"" + data.idTroska + "\"><td class=\"redni_broj\">" + brojTroskova + ". &nbsp; <a href=\"#\" class=\"obrisi\"><i class=\"fas fa-minus-circle\" style=\"color: red;\"></i></a></td><td>" + datum + "</td><td>" + trosak + "</td><td class=\"iznos\">" + iznos + " " + valuta + "</td></tr>");
			alert(data);
		});
		
		clearModalBody();
		
		$('.obrisi').click(function () {
			if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
				var red_id = $(this).closest('tr').attr('id');
				
				$(this).closest('tr').remove();
			}
			else {
				return false;
			}
			brojTroskova--;
		});
		
		if(valuta == "EUR") {
			var trenutno = $("#totalEUR").text().substr(4, $("#totalEUR").text().length);
			iznos = parseFloat(iznos);
			$("#totalEUR").text("EUR: " + (+trenutno + +iznos).toFixed(2));
		}
		if (valuta == "KN") {
			var trenutno = $("#totalKN").text().substr(3, $("#totalKN").text().length);
			iznos = parseFloat(iznos);
			$("#totalKN").text("KN: " + (+trenutno + +iznos).toFixed(2));
		}
		if (valuta == "RSD") {
			var trenutno = $("#totalRSD").text().substr(4, $("#totalRSD").text().length);
			iznos = parseFloat(iznos);
			$("#totalRSD").text("RSD: " + (+trenutno + +iznos).toFixed(2));
		}
	});
	
	$("#otvoriModal").click(function () {
		if(dveFakture) {
			var faktura1 = $("#faktura1").val();
			var faktura2 = $("#faktura2").val();
			$("#trosakModalBody > form").prepend("<div class=\"form-group\"><label for=\"kojaFaktura\">Faktura:</label><div class=\"radio\"><label><input type=\"radio\" name=\"optradio\"> " + faktura1 + "</label></div><div class=\"radio\"><label><input type=\"radio\" name=\"optradio\"> " + faktura2 + "</label></div></div>");
		}
	});
	
	$("#faktura1").change(function () {
		$("#racun_broj1").text($(this).val());
		var faktura = $(this).val();
		
		$.post("php/troskovi.php", {
			pomocni: "pomocni",
			faktura: faktura
		}, function (data) {
			if (data == null) {
				console.log('Nešto si zeznuo');
			} else {
				$("#tableTroskovi > tbody").append(data);
			}
		});
		
		$(".iznos").each(function (index) {
			console.log("ehej");
		});
	});
	
	$("#faktura2").change(function () {
		$("#racun_broj2").text($(this).val());
	});
});