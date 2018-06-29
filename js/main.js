// Meni
var pathName = document.location.pathname;
pathName = pathName.substr(7, pathName.length);
if ($("nav ul li a") != null) {
	var currentLink = $("nav ul li a[href='" + pathName + "']");
	currentLink.addClass("trenutni");
}

function loadFile(url,callback){
	JSZipUtils.getBinaryContent(url,callback);
}

function refresh() {
	location.reload(true);
	location.reload(true);
	location.reload(true);
	location.reload(true);
	location.reload(true);
	location.reload(true);
	location.reload(true);
	location.reload(true);
	location.reload(true);
	location.reload(true);
	location.reload(true);
}