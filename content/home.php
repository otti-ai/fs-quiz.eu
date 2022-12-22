<?php 
	require('./header.php');
?>
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Training for the registration quizzes</h1>
    <p class="fs-5">This page is for training for the European Formula Student Registration quizzes. Old quizzes can be worked through here in the original or an individual adapted mode.</p>

    <div class="mb-2">
      <a href="/quizzes" class="btn btn-primary btn-lg px-4">Old quizzes</a>
    </div>

    <hr class="col-3 col-md-2">
	<h2>Dates</h2>
	<?php require('./php/eventgraph.php'); ?>
	<p>Testquiz from FS Switzerland on 15th January, 13:00 (CET)</p>
	<hr class="col-3 col-md-2">
	
    <div class="row g-5">
      <div class="col-md-6">
        <h2>Registration</h2>
        <p>Information about the registration procedure</p>
        <ul class="icon-list">
		  <li><a target="_blank" href="/doc/reg/FSA-Registration-Procedure-2022_1-1.pdf">FS Austria (v1.1) (old)</a></li>
		  <li><a target="_blank" href="/doc/reg/FSEast_Registration_guide_v2.pdf">FS East Registration Guide (v2) (old)</a></li>
		  <li><a target="_blank" href="https://fseast.eu/get-ready-for-fs-east-2022">FS East (old)</a></li>
		  <li><a target="_blank" href="https://www.formula-ata.it/how-to-register">SAE Italy</a></li>
		  <li><a target="_blank" href="https://formulastudent.ch/registration2022">FS Switzerland (old)</a></li>
		  <li><a target="_blank" href="/doc/reg/FSAA_Registration_V2.pdf">FS Alpe-Adria Registration Procedure Guide (old)</a></li>
        </ul>
      </div>

      <div class="col-md-6">
        <h2>Documents</h2>
        <p>Important documents for the registration quizzes</p>
        <ul class="icon-list">
          <li><a target="_blank" href="/doc/23/FS-Rules_2023_v1.1.pdf">FSG Rules 2023 (v1.1)</a></li>
          <li><a target="_blank" href="/doc/fsg23/FSG23_Competition_Handbook_v1.0.pdf">FS Germany Competition Handbook 2023 (v1.0)</a></li>
		      <li><a target="_blank" href="/doc/23/FS-CV-Hybrid-Rules-Extension-2023-V1.1.pdf">FS Hybrid Rules 2023 (v1.1)</a></li>
		      <li><a target="_blank" href="/doc/fseast23/FS_East_2023_Rules_Formatted_v1.0.pdf">FS East Rules 2023 (v1.0)</a></li>
		      <li><a target="_blank" href="/doc/fsa23/FSA-Competition-Handbook-2023_1-1-0.pdf">FS Austria Competition Handbook 2023 (v1.1.0)</a></li>
          <li><a target="_blank" href="/doc/fsitaly23/FSAE-Italy-2023_Information-_Rules_v1.pdf">FSAE Italy Rules 2023 (v1)</a></li>
        </ul>
      </div>
    </div>
    <hr class="col-3 col-md-2 mb-5">
    <h3>Changelog</h3>
    <p id="changelog"></p>
	  <p><a href="/changelog">More</a></p>
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
	xmlHttp.open( "GET", "/php/getChangelog.php?type=0", true );
	xmlHttp.send( null );
}

</script>
  <?php 
	require('./footer.php');
?>