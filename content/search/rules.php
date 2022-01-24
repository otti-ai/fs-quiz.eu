<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/header.php');
	$name = "";

?>
<script src="/js/search.js" type="text/javascript"></script>
<link href="/css/all.css" rel="stylesheet">
<div class="container-fluid col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Search for Rules</h1>
    <div class="container container-fluid">
		<div id="filter" class="row row-cols-auto">
			<div class="col">
				<div class="form-floating">
					<select class="form-select" id="eventSelect" aria-label="eventSelect">
						<option <?php if ($event == "") {echo 'selected';} ?> value="q">Any</option>
						<option <?php if ($event == "fsa") {echo 'selected';} ?> value="fsa">Austria</option>
						<option <?php if ($event == "fscz") {echo 'selected';} ?> value="fscz">Czech</option>
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
					<select onchange="documents()" class="form-select" id="yearSelect" aria-label="yearSelect">
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
		<div class="row table-responsive">
			<table class="table table-striped table-bordered caption-top align-middle">
			<caption id="count"></caption>
				<thead>
					<tr>
						<th style="cursor: pointer;" onclick="SortTable(this,0, true)"  scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Year</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,1, false)"  scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Event</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,2, false)"  scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Document</span>
						</th>
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
	window.onload = function() {
		searchDocuments();
	}
  </script>
<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>