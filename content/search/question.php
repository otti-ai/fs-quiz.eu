<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/header.php');
	$name = "";

?>
<div onload="load()" class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Search for Question</h1>
    <div class="container container-fluid">
		<div id="filter" class="row row-cols-auto">
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="eventSelect" aria-label="eventSelect">
						<option value="q" selected>Any</option>
						<option value="fsa">Austria</option>
						<option value="fscz">Czech</option>
						<option value="fseast">East</option>
						<option value="fsg">Germany</option>
						<option value="fsn">Netherland</option>
						<option value="fss">Spain</option>
						<option value="fsch">Switzerland</option>
					</select>
					<label for="eventSelect">Event</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="yearSelect" aria-label="yearSelect">
						<option value="q" selected>Any</option>
						<option value="14q">2014</option>
						<option value="16q">2016</option>
						<option value="17q">2017</option>
						<option value="19q">2019</option>
						<option value="20q">2020</option>
						<option value="21q">2021</option>
					</select>
					<label for="yearSelect">Year</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="classSelect" aria-label="classSelect">
						<option value="q" selected>Any</option>
						<option value="14q">EV</option>
						<option value="16q">CV</option>
					</select>
					<label for="classSelect">Class</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="categorySelect" aria-label="categorySelect">
						<option selected>Any</option>
						<option value="math">math</option>
						<option value="rule">rule</option>
						<option value="scoring">scoring</option>
					</select>
					<label for="categorySelect">Type</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="categorySelect" aria-label="categorySelect">
						<option selected>Any</option>
						<option value="electronic">electronic</option>
						<option value="mechanical">mechanical</option>
					</select>
					<label for="categorySelect">Category</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="categorySelect" aria-label="categorySelect">
						<option selected>Any</option>
						<option value="dynamic">dynamic</option>
						<option value="static">static</option>
					</select>
					<label for="categorySelect">Event part</label>
				</div>
			</div>
		</div>
		<hr class="col-3 col-md-2">
		<p id="count" style="margin-bottom: 0;"></p>
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Year</th>
						<th scope="col">Event</th>
						<th scope="col">Question</th>
					</tr>
				</thead>
				<tbody id="doc">
			
				</tbody>
			</table>
		</div>
	</div>
  </main>

  </div> 
<script src="/js/search.js" type="text/javascript"/></script>
<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>