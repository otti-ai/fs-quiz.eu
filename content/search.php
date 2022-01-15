<?php 
	require($_SERVER['DOCUMENT_ROOT']. '/header.php');
?>
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>Search tools</h1>
    <p class="fs-5">On this page there are some search tools which give the possibility to find old questions or documents.</p>
	<hr class="col-3 col-md-2 mb-5">
    <div class="row g-5">
      <div class="col-md-6">
        <div class="mb-5">
			<h2>Search for questions</h2>
        	<p>Search by event, year, type and category for registration quiz Questions</p>
      		<a href="/search/question" class="btn btn-primary btn-lg px-4">	&#x1F50E</a>
    	</div>
      </div>

      <div class="col-md-6">
	  	<div class="mb-5">
			<h2>Search for Documents</h2>
        	<p>Search with the help of event, year to find the right rule documents</p>
      		<a href="/search/documents" class="btn btn-primary btn-lg px-4">&#x1F50E</a>
    	</div>
      </div>
    </div>
  </main>
  </div> 
  <?php 
	require($_SERVER['DOCUMENT_ROOT']. '/footer.php');
?>