<?php 
	require('./header.php');
?>
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Registration quizzes</h1>
    <p class="fs-5">This list is constantly updated.
	More quizzes coming soon.</p>

    <hr class="col-3 col-md-2">
	<h3>EV Class:</h3>
	<div class="container-fluid">
	<div class="row row-cols-auto">
		<div class="col">
			<p class="fs-5">FS Germany:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fsg/e/21v">2021 V2</a></li>
				<li><a href="/quiz/fsg/e/21">2021</a></li>
				<li><a href="/quiz/fsg/e/20">2020</a></li>
				<li><a href="/quiz/fsg/e/17">2017</a>*</li>
				<li><a href="/quiz/fsg/e/16">2016</a></li>
				<li><a href="/quiz/fsg/e/13">2013</a>*</li>
				<li><a href="/quiz/fsg/e/12">2012</a>*</li>
				<li><a href="/quiz/fsg/e/11">2011</a>*</li>
			</ul>
		</div>
		<div class="col">
			<p class="fs-5">FS Austria:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fsa/e/21">2021</a></li>
				<li><a href="/quiz/fsa/e/20">2020</a></li>
				<li><a href="/quiz/fsa/e/19">2019</a></li>
				<li><a href="/quiz/fsa/e/17">2017</a></li>
				<li><a href="/quiz/fsa/e/16">2016</a></li>
				<li><a href="/quiz/fsa/e/14">2014</a></li>
			</ul>
		</div>
		<div class="col">
			<p class="fs-5">FS Czech Republic:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fscz/e/21">2021</a></li>
				<li><a href="/quiz/fscz/e/20">2020</a></li>
				<li><a href="/quiz/fscz/e/19">2019</a>*</li>
				<li><a href="/quiz/fscz/e/17">2017</a></li>
				<li><a href="/quiz/fscz/e/16v">2016 V2</a></li>
				<li><a href="/quiz/fscz/e/16">2016</a></li>
			</ul>
		</div>
		<div class="col">
			<p class="fs-5">FS Spain:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fss/e/20">2020</a></li>
				<li><a href="/quiz/fss/e/19">2019</a></li>
				<li><a href="/quiz/fss/e/16">2016</a></li>
			</ul>
		</div>
		<div class="col">
			<p class="fs-5">FS East:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fseast/e/21">2021</a></li>
				<li><a href="/quiz/fseast/e/20">2020</a></li>
				<li><a href="/quiz/fseast/e/19">2019</a>*</li>
				<li><a href="/quiz/fseast/e/18">2018</a>*</li>
			</ul>
		</div>
		<div class="col">
			<p class="fs-5">FS Netherlands:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fsn/e/19">2019</a></li>
				<li><a href="/quiz/fsn/e/18t">2018 Test</a>*</li>
			</ul>
		</div>
		<div class="col">
			<p class="fs-5">FS Switzerland:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fsch/e/21">2021</a></li>
				<li><a href="/quiz/fsch/e/20t">2020 Test</a></li>
			</ul>
		</div>
	</div>
	<p>* not all solutions available</p>
	</div>
	<hr class="col-3 col-md-2">
	<h3>CV Class:</h3>
	<div class="container-fluid ">
	<div class="row row-cols-auto">
		<div class="col">
			<p class="fs-5">FS Austria:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fsa/c/21">2021</a></li>
				<li><a href="/quiz/fsa/c/20">2020</a></li>
				<li><a href="/quiz/fsa/c/19">2019</a></li>
				<li><a href="/quiz/fsa/c/17">2017</a></li>
			</ul>
		</div>
		<div class="col">
			<p class="fs-5">FS Netherlands:</p>
			<ul class="icon-list">
				<li><a href="/quiz/fsn/c/19">2019</a></li>
			</ul>
		</div>
		<div class="col">
			
		</div>
		<div class="col">
			
		</div>
	</div>
	</div>
	<hr class="col-3 col-md-2 mb-5">
	<h4>Changelog:</h4>
	<p id="changelog"></p>
	<p><a href="/changelog">More</a></p>
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
	require('./footer.php');
?>