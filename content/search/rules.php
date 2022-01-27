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
					<select onchange="searchRules()" class="form-select" id="eventSelect" aria-label="eventSelect">
						<option value="FSA22">Austria</option>
						<option value="fscz">Czech</option>
						<option value="fseast">East</option>
						<option selected value="FSG22">Germany</option>
						<option value="fsn">Netherland</option>
					</select>
					<label for="eventSelect">Event</label>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input onchange="searchRules()" id="textSearch" type="text" class="form-control" id="floatingInput" >
  					<label for="floatingInput">Text</label>
				</div>
			</div>
		</div>
		<hr class="col-3 col-md-2">
		<div class="row table-responsive">
			<table class="table table-striped table-bordered caption-top align-middle">
			<caption id="count"></caption>
				<thead>
					<tr>  
						<th style="cursor: pointer;" onclick="SortTable(this,0, false)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Book</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,1, false)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>ID</span>
						</th>
						<th style="cursor: pointer;" onclick="SortTable(this,2, false)" scope="col">
							<span style="display: flex; align-items:center;"><i style="margin-right: 0.4rem;" name="sort" class="fas fa-sort"></i>Rule</span>
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
	window.onload = function() {
		searchRules();
	}


</script>
<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>