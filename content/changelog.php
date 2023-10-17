<?php 
	require('./header.php');
?>
<div class="col-lg-8 mx-auto p-3">
  <main>
    <h1>Changelog</h1>
    <p class="fs-5" id=changelog></p>
  </main>
  </div> 
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
	xmlHttp.open( "GET", "/php/getChangelog.php?type=-1", true );
	xmlHttp.send( null );
}

</script>
  <?php 
	require('./footer.php');
?>