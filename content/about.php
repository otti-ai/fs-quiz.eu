<?php 
	require('./header.php');
?>
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <main>
    <h1>About me</h1>
    <div class="row">
		<div class="col-sm-4">
			<img class="img-fluid" src="/img/me.jpg" alt="Me">
		</div>
		<div class="col-sm-8">
			<p class="fs-5">My name is Yannik Ottens and I study computer science at the University of Bremen in Germany. I have been 
			a member of Bremergy since 2016 and I am currently part of the team leadership. From the beginning one of my tasks was to 
			prepare the team for the registration quizzes. For this I programmed some helpful tools and collected a lot of 
			data from the past quizzes. As my time at Bremergy is coming to an end, not at last because of the new rules (<a href="#" data-bs-toggle="modal" id="rule">FSG A 4.2.8</a>), 
			I want to make this data available to all teams. Therefore this page displays the collected data and offers a 
			possibility to train with it.</p>
		</div>
	</div>
	<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Rule FSG22 A 4.2.8</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>
  </main>
<script>
var myModal = document.getElementById('Modal');
var myInput = document.getElementById('rule');

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
</script>
  </div> 
<?php 
	require('./footer.php');
?>