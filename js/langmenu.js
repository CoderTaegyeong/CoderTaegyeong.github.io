// Language Menu 1.0 by Blackbeard Softworks 2020


var menubtn;

function changeLang(){
	// Change language to one selected in the menu
	// Ugly hack, not recommended for new projects but this ensures compatibility
	var langsel = document.getElementById("langsel-sel");
	var url = window.location.href.split("/");
	var lang = langsel.options[langsel.selectedIndex].value;
	console.log(url);
	if (lang == "ko"){
		url.splice(url.length-1,0,"ko");
		console.log("Page language changed to Korean");
		window.location.href = url.join("/");
	} else {
		var removeWhat = url.indexOf("ko");
		url.splice(removeWhat,1);
		console.log("Page language changed to English");
		window.location.href = url.join("/");
	}
};

function currentLang(){
	// Change language selection on load (warning: ugly hack, not recommended for new projects)
	// This adds event listener for the menu button since I forgot to add that (sorry)
	var menubtn = document.getElementsByClassName("langsel-button")[0];
	menubtn.addEventListener('click', menu, false);
	var url = window.location.href;
	// Check if URL contains "kr" string
	if(window.location.href.indexOf("ko") != -1){
		var langsel = document.getElementById("langsel-sel");
		langsel.value = "ko";
	}
}

function menu(){
	// Show or hide menu
	var langmenu = document.getElementsByClassName("langmenu")[0];
	langmenu.classList.toggle("hidden");

}