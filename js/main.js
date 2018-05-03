// Meni
var pathName = document.location.pathname;
pathName = pathName.substr(7, pathName.length);
if ($("nav ul li a") != null) {
	var currentLink = $("nav ul li a[href='" + pathName + "']");
	currentLink.addClass("trenutni");
}

