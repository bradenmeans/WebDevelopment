<!-- 
This is the home page for Final Project, Quotation Service. 
It is a PHP file because later on you will add PHP code to this file.

File name quotes.php 
    
Authors: Rick Mercer and Braden Means
-->

<!DOCTYPE html>
<html>
<head>
<title>Quotation Service</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body onload="showQuotes()" id="show">
<?php 
session_set_cookie_params(0);
session_start();
?>
<h1>Quotation Service</h1>
<div id="quotes"></div>

<script>
var element = document.getElementById("quotes");
var getQuotes = document.getElementById("show");
function showQuotes() {
  	var anObj = new XMLHttpRequest();
	anObj.open("GET","controller.php?todo=getQuotes", true);
	anObj.send();
	
	anObj.onreadystatechange = function() {
		if (anObj.readyState == 4 && anObj.status == 200) {
			//alert(anObj.responseText)
			
			element.innerHTML = anObj.responseText;
		}
	}

}

function logout() {
	var userLogout = document.getElementById('loggedout');
	var anObj = new XMLHttpRequest();
	anObj.open("GET","controller.php?logout=userLogout", true);
	anObj.send();
	
	anObj.onreadystatechange = function() {
		if (anObj.readyState == 4 && anObj.status == 200) {
			//alert(anObj.responseText)
			
			element.innerHTML = anObj.responseText;
		}
	}
}

</script>

</body>
</html>