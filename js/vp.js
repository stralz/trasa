var obj = {};

function clearModalBody() {
	$('.modal > .modal-dialog > .modal-content > .modal-body > form').empty();
}

$(".nav>li").each(function() {
	var navItem = $(this);
	if (navItem.find("a").attr("href") == location.pathname) {
		navItem.addClass("active");
	}
});

function vratiDatum(datepicker) {
	var tmp = document.getElementById(datepicker).value;
	var date = tmp.split('-');
	var day = date[2];
	var month = date[1];
	var year = date[0];
	return day + '.' + month + '.' + year;
}

$(function () {
	$("input").focus(function () {
		var def = $(this).val();
		$(this).keyup(function () {
			var cur1 = $(this).val();
			if(def != cur1) {
				$(this).blur(function () {
					$(this).css("background-color", "#adccff");
					$(this).css("color", "black");
					$(this).addClass("promenjen");
				});
			}
		});
	});
	
	$('.azuriraj').click(function () {
		$('.promenjen').each(function (index, item) {
			var vrednost = null;
			if($(this).is('select')) {
				vrednost = $('option:selected',this).text();
			} else {
				vrednost = $(this).val();
			}
			$(this).removeClass('promenjen');
			var kolona = $(this).attr('class');
			var id_entiteta = $(this).closest('tr').attr('id');
			var baza = $(this).closest('table').attr('id').replace('Tabela', '');
			if (baza == "prikolice") {
				baza = "pregledi_prikolice";
				$.post('php/azurirajTabelu.php', {
					'vrednost': vrednost,
					'kolona': kolona,
					'id_entiteta': id_entiteta,
					'baza': baza,
				});
			} else if (kolona == "lekarsko" && baza == "tegljaci") {
				baza = "vozaci";
				id_entiteta = $(this).attr('id');
				$.post('php/azurirajTabelu.php', {
					'vrednost': vrednost,
					'kolona': kolona,
					'id_entiteta': id_entiteta,
					'baza': baza,
				});
			} else {
				baza = "pregledi_tegljaci";
				$.post('php/azurirajTabelu.php', {
					'vrednost': vrednost,
					'kolona': kolona,
					'id_entiteta': id_entiteta,
					'baza': baza,
				});
			}
			
		});
	});
	
	$('.dodaj').click(function () {
		var tabela = $(this).closest('table').attr('id').replace('Tabela', '');
		tabela = tabela.substring(0, 1).toUpperCase() + tabela.substring(1, tabela.length);
		$('.modal > .modal-dialog > .modal-content > .modal-header > h2').html(tabela);
		
		var baza = $(this).closest('table').attr('id').replace('Tabela', '');
		if(baza == "prikolice")
			baza = "pregledi_prikolice";
		else(baza == "tegljaci")
			baza = "pregledi_tegljaci";
		obj["baza"] = baza;
		
		if(tabela == "Prikolice")
			tabela = "pregledi_prikolice";
		else if(tabela == "Tegljaci")
			tabela = "pregledi_tegljaci";
		
		$.post('php/uzmiKolone.php', {
				'tabela' : tabela,
			}, function (data) {
				if(data === null)
					console.error("error");
				else {
					tmpData = data;
					var modal_body = $('.modal > .modal-dialog > .modal-content > .modal-body > form');
					
					for(var x in data) {
						if(data.hasOwnProperty(x)) {
							var tmp = data[x].replace('_', ' ');
							tmp = tmp.toLowerCase().replace(/\b[a-z]/g, function(letter) {
								return letter.toUpperCase();
							});
							
							if(tmp == "U I") {
								tmp = "Uvoznik/Izvoznik";
								modal_body.html(modal_body.html() + "<div class=\"form-group\"><label for=\"" + data[x] + "\">" + tmp + ": " +
								"</label><select id=\"" + data[x] + "\" class=\"update\" style=\"margin-left: 10px;\"><option value=\"Oba\">Oba</option><option value=\"Uvoznik\">Uvoznik</option><option value=\"Izvoznik\">Izvoznik</option></select></div>");
							} else if (tmp == "Fk Prikolica") {
								tmp = "Prikolica";
								modal_body.html(modal_body.html() + "<div class=\"form-group\"><label for=\"" + data[x] + "\">" + tmp + ": " +
								"</label><input type=\"text\" id=\"" + data[x] + "\" class=\"update\" list=\"prikolice\" style=\"margin-left: 10px;\"></div>");
							} else if(tmp == "Fk Tegljac") {
								tmp = "Tegljac";
								modal_body.html(modal_body.html() + "<div class=\"form-group\"><label for=\"" + data[x] + "\">" + tmp + ": " +
								"</label><input type=\"text\" id=\"" + data[x] + "\" class=\"update\" list=\"tegljaci\" style=\"margin-left: 10px;\"></div>");
							} else if(tmp == "Fk Vozac") {
								tmp = "Vozac";
								modal_body.html(modal_body.html() + "<div class=\"form-group\"><label for=\"" + data[x] + "\">" + tmp + ": " +
								"</label><input type=\"text\" id=\"" + data[x] + "\" class=\"update\" list=\"vozaci\" style=\"margin-left: 10px;\"></div>");
							} else {
								modal_body.html(modal_body.html() + "<div class=\"form-group\"><label for=\"" + data[x] + "\">" + tmp + ": " +
								"</label><input type=\"date\" id=\"" + data[x] + "\" class=\"update\" style=\"margin-left: 10px;\"></div>");
							}
						}
					}
				}
		});
	});
	
	$('#dodaj').click(function () {
		var inputi = $('.update');
		
		for(var i = 0; i < inputi.length; i++) {
			var imeKolone = inputi[i].id;
			if(imeKolone == "registracija" || imeKolone == "sertifikat" || imeKolone == "sesto_mesecni" || imeKolone == "tahograf" || imeKolone == "lekarsko")
				obj[imeKolone] = vratiDatum(imeKolone);
			else
				obj[imeKolone] = inputi[i].value;
		}
		
		$.post('php/napraviNovi.php', obj);
	});
	
	$('.obrisi').click(function () {
		if(confirm("Da li ste sigurni da želite da izbrišete ovaj podatak?")){
			var red_id = $(this).closest('tr').attr('id');
			var baza = $(this).closest('table').attr('id').replace('Tabela', '');
			if(baza == "prikolice")
				baza = "pregledi_prikolice";
			
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