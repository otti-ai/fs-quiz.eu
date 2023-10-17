<?php 
	require('header.php'); 
	?>
<div class="col-lg-8 mx-auto p-3">
  <main>
  <h1>Contact</h1>
<h4>Address</h4>
Yannik Ottens<br>
Kirchweg 151<br>
28201 Bremen<br>
Germany</p>
<p>Telephone: +49 15227751021</p>

<h4>E-Mail for general informations</h4>
<p>info@fs-quiz.eu</p>

<h4>E-Mail for API</h4>
<p>api@fs-quiz.eu</p>

</main>
<script>
getChangelog();
function getChangelog(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
			var r = "";
			var r = xmlHttp.responseText;
			document.getElementById("changelog").innerHTML = r;
		}
	}
	xmlHttp.open( "GET", "/php/getChangelog.php?type=1", true );
	xmlHttp.send( null );
}

</script>
  </div> 
<?php 
	require('footer.php');
?>