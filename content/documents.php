<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/header.php');
	$name = "";

?>
<div onload="load()" class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Search for Documents</h1>
    <div class="container container-fluid">
		<div id="filter" class="row row-cols-auto">
			<div class="col">
				<div class="form-floating">
					<select onchange="search()" class="form-select" id="eventSelect" aria-label="eventSelect">
						<option <?php if ($event == "") {echo 'selected';} ?> value="q">Any</option>
						<option <?php if ($event == "fsa") {echo 'selected';} ?> value="fsa">Austria</option>
						<!-- <option <?php //if ($event == "fscz") {echo 'selected';} ?> value="fscz">Czech</option> -->
						<option <?php if ($event == "fseast") {echo 'selected';} ?> value="fseast">East</option>
						<option <?php if ($event == "fsg") {echo 'selected';} ?> value="fsg">Germany</option>
						<option <?php if ($event == "fsn") {echo 'selected';} ?> value="fsn">Netherland</option>
						<option <?php if ($event == "fss") {echo 'selected';} ?> value="fss">Spain</option>
						<option <?php if ($event == "fsch") {echo 'selected';} ?> value="fsch">Switzerland</option>
					</select>
					<label for="eventSelect">Event</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="search()" class="form-select" id="yearSelect" aria-label="yearSelect">
						<option <?php if ($year == "") {echo 'selected';} ?> value="q">Any</option>
						<option <?php if ($year == "22") {echo 'selected';} ?> value="22">2022</option>
						<option <?php if ($year == "21") {echo 'selected';} ?> value="21">2021</option>
						<option <?php if ($year == "20") {echo 'selected';} ?> value="20">2020</option>
						<option <?php if ($year == "19") {echo 'selected';} ?> value="19">2019</option>
						<option <?php if ($year == "18") {echo 'selected';} ?> value="18">2018</option>
						<option <?php if ($year == "17") {echo 'selected';} ?> value="17">2017</option>
						<option <?php if ($year == "16") {echo 'selected';} ?> value="16">2016</option>
						<option <?php if ($year == "15") {echo 'selected';} ?> value="15">2015</option>
						<option <?php if ($year == "14") {echo 'selected';} ?> value="14">2014</option>
						<option <?php if ($year == "13") {echo 'selected';} ?> value="13">2013</option>
						<option <?php if ($year == "12") {echo 'selected';} ?> value="12">2012</option>
						<option <?php if ($year == "11") {echo 'selected';} ?> value="11">2011</option>
					</select>
					<label for="yearSelect">Year</label>
				</div>
			</div>
		</div>
		<hr class="col-3 col-md-2">
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th scope="col">Year</th>
						<th scope="col">Event</th>
						<th scope="col">Document</th>
					</tr>
				</thead>
				<tbody id="doc">
			
				</tbody>
			</table>
		</div>
	</div>
  </main>

  </div> 
 <script>
var event = "<?php echo $event; ?>";
var year = "<?php echo substr($year,0,2); ?>";
load();

function search(){
	year = document.getElementById("yearSelect").value;
	event = document.getElementById("eventSelect").value;
	window.history.pushState({ additionalInformation: 'Search Documents' }, "FS-Quiz - Documents'", "https://fs-quiz.eu/documents/"+event+"/"+year);
	load();
}

function load(){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
			var r = "";
			var r = xmlHttp.responseText;
			var links = r.split(';');
			var html = "";
			links.forEach(function(item){
				var info = item.split("@");
				var row = "<tr>";
				row += "<td>"+info[1].slice(-2)+"</td>";
				if(info[1].includes("fs")){
					row += "<td>"+info[1].slice(0,-2).toUpperCase()+"</td>";
				}else{
					row += "<td>All</td>";
				}
				row += "<td>"+info[0]+"</td>";
				row += "</tr>";
				html += row;
			});
			document.getElementById("doc").innerHTML = html;
		}
	xmlHttp.open( "GET", "/php/getDocuments.php?y="+year+"&e="+event, true );
	xmlHttp.send( null );
}
  </script>
<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>