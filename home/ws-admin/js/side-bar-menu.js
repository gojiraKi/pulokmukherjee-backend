function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
	var temp = document.getElementsByClassName("box");
	var container = temp[0];
	container.style.paddingLeft = "250px";
	//document.getElementById("overlay").style.width = "100%";
	//document.getElementById("overlay").style.opacity = "0.8";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
	var temp = document.getElementsByClassName("box");
	var container = temp[0];
	container.style.paddingLeft = "0";
	/* document.getElementById("overlay").style.width = "0";
	document.getElementById("overlay").style.opacity = "0"; */
}