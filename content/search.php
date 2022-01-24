<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/header.php');
?>
<link href="/css/all.css" rel="stylesheet">
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Search tools</h1>
    <p class="fs-5">On this page there are some search tools which give the possibility to find old questions or documents.</p>
	<hr class="col-3 col-md-2 mb-5">
    <div class="row g-5">
      <div class="col-md-6">
        <div class="mb-5">
			<h2>Search for questions</h2>
        	<p>Search by event, year, type and category for registration quiz Questions</p>
      		<a href="/search/question" class="btn btn-primary btn-lg px-4">	<i class="fas fa-search"></i></a>
    	</div>
      </div>

      <div class="col-md-6">
	  	<div class="mb-5">
			<h2>Search for Documents</h2>
        	<p>Search with the help of event, year to find the right rule documents</p>
      		<a href="/search/documents" class="btn btn-primary btn-lg px-4"><i class="fas fa-search"></i></a>
    	</div>
      </div>
    </div>
    <hr class="col-3 col-md-2 mb-5">
	<h4>Changelog:</h4>
	<p id="changelog"></p>
	<p><a href="/changelog">More</a></p>
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
	xmlHttp.open( "GET", "/php/getChangelog.php?type=2", true );
	xmlHttp.send( null );
}

</script>
  </main>
  </div> 
  <?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>