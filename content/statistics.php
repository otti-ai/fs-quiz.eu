<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require('./header.php');

	$jsonViewsDay = json_decode(file_get_contents('https://api.fs-quiz.eu/2/statistic/2023-12-13/views'));
	$viewsDay = $jsonViewsDay->most_views;

?>
<script src="js/chart.js"></script>

<div class="col-lg-8 mx-auto p-3">
  <main>
    <h1>Statistic</h1>
	<hr class="col-3 col-md-2">
	<canvas id="myChart" style="width:100%;max-height:300px"></canvas>
	<h2>Website</h2>
    <div class="row">
		<div class="col-sm-4">
			<h5 class="text-center">Yesterday</h5>
			<table class="table table-striped table-bordered caption-top">
				<thead>
					<tr>
						<th scope="col">Site</th>
						<th scope="col">Views</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($viewsDay as $view){
						echo '<tr><td><a target="_blank" href="'.$view->path.'">'.$view->path.'</a></td><td>'.$view->views.'</td></tr>';
					}
				?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-4">
		</div>
	</div>
	<hr class="col-3 col-md-2">
	<h2>API</h2>
	<div class="row">
		<div class="col-sm-6">
		</div>
		<div class="col-sm-6">
		</div>
	</div>
  </main>
  </div> 
  <script>
	var xValues = [];
	var views = [];
	var calls = [];

	async function getStatistic() {
		const response = await fetch('https://api.fs-quiz.eu/2/statistic?days=30', {
			method: 'GET'
		});

		const responseText = await response.text();
		const jsonObj = JSON.parse(responseText);
		jsonObj.statistics.forEach((item) => {
			xValues.push(item.date);
			views.push(item.website_views);
			calls.push(item.api_calls);
		});
		console.log(jsonObj.statistics);
		createDiagram();
	}

	getStatistic();

	function createDiagram(){
		new Chart("myChart", {
			type: "line",
			data: {
				labels: xValues.reverse(),
				datasets: [{ 
					label: "Website views",
					data: views.reverse(),
					borderColor: "green",
					fill: false
					}, { 
					label: "API calls",
					data: calls.reverse(),
					borderColor: "blue",
					fill: false
				}]
			},
			options: {
				legend: {display: true},
				maintainAspectRatio: false
			}
		});
	}

</script>
<?php 
	require('./footer.php');
?>