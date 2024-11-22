<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/header.php');
	$jsonEvents = file_get_contents('https://api.fs-quiz.eu/2/event');
	$eventList = json_decode($jsonEvents);
	$name = "";
	$event = isset($event) ? $event : '';
	$year = isset($year) ? $year : '';
	$type = isset($type) ? $type : '';

	$currentDate = new DateTime();
	$currentDate->modify('+3 months');
	$docYear = $currentDate->format('Y');
?>
<script src="/js/search.js?v1.2" type="text/javascript"></script>
<link href="/css/all.css" rel="stylesheet">
<div class="container-fluid col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Search for Documents</h1>
    <div class="container container-fluid">
		<div id="filter" class="row row-cols-auto">
			<div class="col">
				<div class="form-floating">
					<select onchange="documents()" class="form-select" id="eventSelect" aria-label="eventSelect">
						<option <?php if ($event == "") {echo 'selected';} ?> value="0">Any</option>
						<?php
						foreach($eventList->events as $e){
							echo '<option ';
							if($event == $e->id){echo 'selected';}
							echo ' value="'.$e->id.'">'.str_replace('Formula', '', str_replace('Formula Student', 'FS', $e->event_name)).'</option>';
						}
						?>
					</select>
					<label for="eventSelect">Event</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="documents()" class="form-select" id="yearSelect" aria-label="yearSelect">
						<option <?php if ($year == "") {echo 'selected';} ?> value="0">Any</option>
						<?php
						for($i = $docYear;$i >= 2011;$i--){
							echo '<option ';
							if ($year == $i) {echo 'selected';}
							echo ' value="'.$i.'">'.$i.'</option>';
						}
						?>
					</select>
					<label for="yearSelect">Year</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="documents()" class="form-select" id="typeSelect" aria-label="typeSelect">
						<option <?php if ($type == "") {echo 'selected';} ?> value="">Any</option>
						<option <?php if ($type == "rulebook") {echo 'selected';} ?> value="Rulebook">Rulebook</option>
						<option <?php if ($type == "hybrid") {echo 'selected';} ?> value="Hybrid Rules">Hybrid Rules</option>
						<option <?php if ($type == "additional") {echo 'selected';} ?> value="Additional Rules">Additional Rules</option>
						<option <?php if ($type == "handbook") {echo 'selected';} ?> value="Handbook">Handbook</option>
						<option <?php if ($type == "registration") {echo 'selected';} ?> value="Registration">Registration</option>
						<option <?php if ($type == "docs") {echo 'selected';} ?> value="Additional Documents">Additional Documents</option>
					</select>
					<label for="typeSelect">Type</label>
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
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Type</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,3, false)"  scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Version</span>
						</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody id="doc">
					<tr><td class='text-center' colspan='5'>
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
					</div></td></tr>
				</tbody>
			</table>
		</div>
	</div>
  </main>

  </div> 
 <script>
var eventData = <?php echo json_encode($eventList); ?>;
var event = "<?php echo $event; ?>";
var year = "<?php echo $year; ?>";
var type = '';
document.addEventListener('DOMContentLoaded', function() {
	loadDocuments();
}, false);
  </script>
<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>