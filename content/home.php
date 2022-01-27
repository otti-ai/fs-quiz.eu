<?php 
	require('./header.php');
?>
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Training for the registration quizzes</h1>
    <p class="fs-5">This page is for training for the European Formula Student Registration quizzes. Old quizzes can be worked through here in the original or an individual adapted mode.</p>

    <div class="mb-5">
      <a href="/quizzes" class="btn btn-primary btn-lg px-4">Old quizzes</a>
    </div>

    <hr class="col-3 col-md-2 mb-5">
	<h2>Dates</h2>
	<img class="mx-auto d-block img-fluid" src="/img/dates.jpg">
	<hr class="col-3 col-md-2 mb-5">
	
    <div class="row g-5">
      <div class="col-md-6">
        <h2>Registration</h2>
        <p>Information about the registration procedure</p>
        <ul class="icon-list">
		  <li><a target="_blank" href="/doc/reg/FSA-Registration-Procedure-2022_1-1.pdf">FS Austria (v1.1)</a></li>
		  <li><a target="_blank" href="/doc/reg/FSAA_Registration_V2.pdf">FS East Registration Guide (v2)</a></li>
		  <li><a target="_blank" href="https://fseast.eu/get-ready-for-fs-east-2022">FS East</a></li>
		  <li><a target="_blank" href="https://www.formula-ata.it/how-to-register">SAE Italy</a></li>
		  <li><a target="_blank" href="https://formulastudent.ch/registration2022">FS Switzerland</a></li>
		  <li><a target="_blank" href="https://fs-alpeadria.com/fs-alpe-adria-event/registration">FS Alpe-Adria</a></li>
		  <li><a target="_blank" href="/doc/reg/FSAA_Registration_V2.pdf">FS Alpe-Adria Registration Procedure Guide</a></li>
        </ul>
      </div>

      <div class="col-md-6">
        <h2>Documents</h2>
        <p>Important documents for the registration quizzes</p>
        <ul class="icon-list">
          <li><a target="_blank" href="/doc/22/FS-Rules_2022_v1.0.pdf">FSG Rules 2022 (v1.0)</a></li>
		  <li><a target="_blank" href="/doc/21/FS-Rules_2020_V1.0.pdf">FSG Rules 2021 (v1.0)</a></li>
		  <li><a target="_blank" href="/doc/22/FS_2022_CV_Hybrid_Rules.pdf">FS Hybrid Rules 2022 (v0.9)</a></li>
		  <li><a target="_blank" href="/doc/fseast22/FS_East_2022_Rules_v0.9.pdf">FS East Rules 2022 (v0.9)</a></li>
		  <li><a target="_blank" href="/doc/fseast22/FS_East_Alumni_Rules_v1.0.pdf">FS East Alumni Cup Rules 2022 (v1.0)</a></li>
		  <li><a target="_blank" href="/doc/fsg22/FSG22_Competition_Handbook_v1.1.pdf">FSG Handbook 2022 (v1.1)</a></li>
		  <li><a target="_blank" href="/doc/fsn22/FSN-Competition-Handbook-2022-V1.0.pdf">FSN Handbook 2022 (v1.0)</a></li>
		  <li><a target="_blank" href="/doc/fsa22/FSA-Competition-Handbook-2022_1-4-0-1.pdf">FSA Handbook 2022 (v1.4.0)</a></li>
		  <li><a target="_blank" href="/doc/datalog/FSG-FSA-Datalogger-Datasheet-v0.1.pdf">FSG & FSA Datalogger 2022 (v0.1)</a></li>
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