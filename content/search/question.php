<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/header.php');
	$name = "";

?>
<script src="/js/search.js" type="text/javascript"></script>
<link href="/css/all.css" rel="stylesheet">
<div class="container-fluid col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Search for Question</h1>
    <div class="container container-fluid">
		<div id="filter" class="row row-cols-auto">
			<div class="col">
				<div class="form-floating">
					<input onchange="questions()" id="textSearch" type="text" class="form-control" id="floatingInput" >
  					<label for="floatingInput">Text</label>
				</div>
			</div>
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
						<option value="e">EV</option>
						<option value="c">CV</option>
						<option value="d">DV</option>
					</select> 
					<label for="classSelect">Class</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="typSelect" aria-label="typSelect">
						<option selected>Any</option>
						<option value="math">Math</option>
						<option value="rule">Rule</option>
						<option value="scoring">Scoring</option>
					</select>
					<label for="typSelect">Type</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="categorySelect" aria-label="categorySelect">
						<option selected>Any</option>
						<option value="electronic">Electronic</option>
						<option value="mechanical">Mechanical</option>
					</select>
					<label for="categorySelect">Category</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<select onchange="questions()" class="form-select" id="disSelect" aria-label="disSelect">
						<option selected>Any</option>
						<option value="dynamic">Dynamic</option>
						<option value="static">Static</option>
					</select>
					<label for="disSelect">Disciplines</label>
				</div>
			</div>
			<div class="col">
				<div class="form-check">
  					<input onchange="questions()" class="form-check-input" type="checkbox" value="" id="imgSelect">
  					<label class="form-check-label" for="imgSelect">only with image</label>
				</div>
			</div>
		</div>
		<hr class="col-3 col-md-2">
		<div class="row table-responsive">
			<table class="table table-striped table-bordered caption-top align-middle">
			<caption id="count"></caption>
				<thead>
					<tr>  
						<th style="cursor: pointer;" onclick="SortTable(this,0, true)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>ID</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,1, true)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Year</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,2, false)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Event</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,3, false)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Class</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,4, false)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Question</span>
						</th>
						<th scope="col"></th>
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
	window.onload = function() {
		questions();
	}
</script>
<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>