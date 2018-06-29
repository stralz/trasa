function clearModalBody() {
	$('.modal > .modal-dialog > .modal-content > .modal-body > form').empty();
}

$(".nav>li").each(function() {
	var navItem = $(this);
	if (navItem.find("a").attr("href") == location.pathname) {
		navItem.addClass("active");
	}
});

var tmpData = null;
var obj = {};

$(function () {
	var hash = document.URL;
	if(hash.includes("#")) {
		console.log("usao");
		var x = hash.substr(39, hash.length).replace('#', '');
		console.log(x);
		$('a[href="#' + x + '"]').click();
	}
	
	$(".nav-link").click(function () {
		window.location.href = hash + $(this).attr("href");
	});
	
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
	
	$("select").change(function () {
		$(this).blur(function () {
			$(this).css("background-color", "#adccff");
			$(this).css("color", "black");
			$(this).addClass("promenjen");
		});
	});
	
	$('.azuriraj').click(function () {
		$('.promenjen').each(function (index, item) {
			var vrednost = null;
			if($(this).is('select')) {
				vrednost = $('option:selected',this).text();
			} else {
				vrednost = $(this).val();
			}s
			$(this).removeClass('promenjen');
			var kolona = $(this).attr('class');
			var id_entiteta = $(this).closest('tr').attr('id');
			var baza = $(this).closest('table').attr('id').replace('Tabela', '');
			
			$.post('php/azurirajTabelu.php', {
				'vrednost': vrednost,
				'kolona': kolona,
				'id_entiteta': id_entiteta,
				'baza': baza,
			}).done(function () {
				refresh();
			});
		});
	});
	
	$('.dodaj').click(function () {
		var tabela = $(this).closest('table').attr('id').replace('Tabela', '');
		tabela = tabela.substring(0, 1).toUpperCase() + tabela.substring(1, tabela.length);
		$('.modal > .modal-dialog > .modal-content > .modal-header > h2').html(tabela);
		
		var baza = $(this).closest('table').attr('id').replace('Tabela', '');
		obj["baza"] = baza;
		
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
							} else {
								modal_body.html(modal_body.html() + "<div class=\"form-group\"><label for=\"" + data[x] + "\">" + tmp + ": " +
								"</label><input type=\"text\" id=\"" + data[x] + "\" class=\"update\" style=\"margin-left: 10px;\"></div>");
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
			obj[imeKolone] = inputi[i].value;
		}
		
		$.post('php/napraviNovi.php', obj).done(function () {
				refresh();
		});
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