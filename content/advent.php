<?php
$calendarOrder = [4,15,22,1,8,11,18,13,12,23,2,7,10,19,24,14,20,3,9,16,6,17,5,21];
// question, correctAnswer, wrong1, wrong2 wrong3, tipp (The solution can be found in rule), link (https://doc.fs-quiz.eu/FS-Rules_2025_v1.0.pdf), category
$questions = [[
	"The length of the complete endurance is approximately?","22 km","18 km","26 km","25 km","D7.1.3","#Endurance%20Track%20Layout","Endurance"
],[
	"Which sequence of the VSV (Vehicle Status Video) doesn't have to be shown?","90° cornering", "straight driving", "standing still", "driving back to start point", "A5.6.3", "#Vehicle%20Status%20Video", "Documentation & Deadlines"
],[
	"What isn`t an official track condition?","foggy","dry","damp","wet","D3.1.1", "#Operating%20Conditions", "Operating Conditions"
],[
	"What is the penalty for DOO (Down or Out) in Acceleration?","2 s","1 s","3 s","5 s","D9.1.7","#General%20Penalties","Penalties"
],[
	"At what speed is energy recuperation permitted during braking?","unrestricted","5 km/h","10 km/h","20 km/h","EV2.2.2","#Power%20Limitation","Power Limitation"
],[
	"What time at the event are the officials allowed to check the compliance of the vehicle with the rules or to impound the vehicle?","Any time during event","only up to inspection","until the race begins","only at the beginning and end of the event","IN 12.1.1","#Post%20Inspection%20Procedure","Inspections"
],[
	"What is the maximum duration of a BBP?","10 minutes","15 minutes","20 minutes","no time limit","S2.2.1","#Business%20Plan%20Presentation%20Procedure","Static Events"
],[
	"The Brake System Plausibility Device (BSPD) should detect hard braking when.....?","There are no locked wheels and the brake pressure is more than or equal to 30 bar.","There are no locked wheels and the brake pressure is more than or equal to 50 bar.","All wheels are locked and the brake pressure is more than or equal to 30 bar.","All wheels are locked and the brake pressure is more than or equal to 50 bar.","T11.6.5","#Brake%20System%20Plausibility%20Device","Brake System "
],[
	"How is the keep-out-zone (where no part of the vehicle may enter) defined?","by two lines extending vertically from positions 75 mm in front of and 75 mm behind the outer diameter of the front and rear tires in the side view of the vehicle, with steering straight ahead","by two lines extending vertically from positions 60 mm in front of and 60 mm behind the outer diameter of the front and rear tires in the side view of the vehicle, with steering straight ahead","by one line extending horizontally from positions 70 mm above the outer diameter of the front and rear tires in the side view of the vehicle, with steering straight ahead","by two lines extending vertically from positions 70 mm in front of and 70 mm behind the inner diameter of the front and rear tires in the side view of the vehicle, with steering straight ahead","T2.1.3","#Vehicle%20Configuration","Satisfy"
],[
	"What is the minimum tread depth for wet tires?","2.4 mm","2.1 mm","3 mm","1.6 mm","T2.7.1","#Tires","Tires"
],[
	"How many straight tubes must brace the front hoop?","2","1","3","4","T3.11.1","#Front%20Hoop%20Bracing","Front Hoop"
],[ 
	"Which is not a requirement of a composite material test panel?","Must pass a Brinell Hardness Test","Must measure 275 mm x 500 mm","Core material must be visible","Must be tested using a 3-point bending test","T3.5.1","#Laminate%20Testing","Laminate Testing"
],[
	"What is the minimum required age of a team member?","18","16","21","No age limit","A4.2.9","#Team%20Members%20and%20Participants","Team Members and Participants"
],[
	"What must everybody in the dynamic area/working on the vehicle wear?","appropriate clossed-toed shoes","a vest","full gear","a boilersuit","A6.4.1","#Onsite%20Working%20Safety","Safety"
],[
	"What is the correct chronological skidpad lap procedure?","1 untimed lap in the right circle, 1 timed lap in the right circle, 1 untimed lap in the left circle, 1 timed lap in the left circle","1 untimed lap in the right circle, 1 timed lap in the right circle, 1 timed lap in the left circle","1 untimed lap in the left circle, 1 timed lap in the left circle, 1 timed lap in the right circle","1 timed lap in the right circle, 1 timed lap in the left circle","D4.2.1","#Skidpad%20Procedure","Skidpad"
],[
	"What is a TS (Tractive System)?","Every part that is electrically connected to the motor(s) and TS accumulators.","Every part that is connected to the motor(s) and TS accumulators.","Every part that is electrically connected to the motor(s).","Every part that is connected to the TS accumulators.","EV 1.1.1","#Tractive%20System","Tractive System"
],[
	"Are changes to the CRD (Cost Report Documents) permitted?","No","Yes","only with the judges permission","only 7 days after the deadline","S3.3.2","#Cost%20Report%20Documents","Cost Report Documents"
],[
	"What do you have to do with ungrounded terminals?","isulate","cover","remove","avoid","T11.7.6","#Low%20Voltage%20Batteries","Electrical components"
],[
	"What is the minimum bend radius of the roll hoops?","Three times the tube outside diameter","Two times the tube outside diameter","more than 50 mm","less than 50 mm","T3.7.2","#Roll%20Hoops","Roll Hoops"
],[
	"What is the minimum hight for the HVD to be mounted on the car?","350 mm","200 mm","150 mm","500 mm","EV4.8.1","#High%20Voltage%20Disconnect","High Voltage Disconnect"
],[
	"How many seconds do you have to attempt to continue drive after the vehicle comes to stillstand?","30 s","10 s","25 s","20 s","D2.7.1","#Vehicle%20Break%20Downs%20and%20Usage%20of%20RES%20during%20Autonomous%20Running","Autonomous Running"
],[
	"How large must a perimeter shear test sample be for composite materials?","100 mm x 100 mm","50 mm x 50 mm","50 mm x 100 mm","200 mm x 200 mm","T3.5.10","#Laminate%20Testing","Laminate Testing"
],[
	"What must be turned off in case the pushbar is attached on the vehicle?","the engine/tractive system","all the electronics","nothing","the gearbox","A6.6.6","#Vehicle%20Movement","Vehicle Movement"
],[
	"What modification would make a formula student car suitable for use in Santa's sleigh?","A silent electric motor to avoid waking children.","Regenerative braking to recover energy at every stop.","All-wheel steering to navigate tight turns around chimneys.","An efficient flight mode for delivering to remote areas.","","","Merry Christmas"
]
];


$taget = isset($_GET["day"]) ? $_GET["day"] : date('d');
?>

<!doctype html>
<html lang="en">
  <head>
  	<base href="/">         <!--  https://fs-quiz.eu/ -->
	<!-- ICONS-->
	<link rel="apple-touch-icon" sizes="57x57" href="img/icons/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/icons/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/icons/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/icons/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/icons/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/icons/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/icons/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/icons/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/icons/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="img/icons/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/icons/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon/favicon-16x16.png">
	<link rel="manifest" href="img/icons/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="img/icons/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/advent.css" rel="stylesheet">
	  <script src="js/bootstrap.min.js"></script>
	  <script src="js/advent.js"></script>
	  <script src="js/confetti.browser.js"></script>
	  <?php 
		$menu = array(
			'./home' => 'Home',
			'./quizzes' => 'Quizzes',
			'./search' => 'Search',
			'http://api.fs-quiz.eu' => 'API',
			'./about' => 'About'
		);
	?>
    <title>Advent Calendar</title>
  </head>
  <body class="d-flex flex-column min-vh-100"> 
	<header class="p-3 bg-dark text-white">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid col-lg-8">
				<a class="navbar-brand" href="./home"><img src="/img/icons/favicon/favicon-96x96.png" alt="" width="30" height="30" class="d-inline-block align-text-top me-2">FS-Quiz</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<?php foreach( $menu as $menpage => $menlabel ) : ?>
							<li class="nav-item">
								<a class="nav-link <?php if ($pagename == $menpage) {echo 'active';} ?>" href="<?php echo $menpage ; ?>"><?php echo $menlabel ; ?></a>
							</li>
						<?php endforeach ?>
					</ul>
					<ul class="nav  navbar-nav navbar-right align-items-center">
						<li class="nav-item"><a class="navbar-brand" target="_blank" href="https://github.com/otti-ai/fs-quiz.eu" style="vertical-align: super;"><img src="https://fs-quiz.eu/img/icons/github.svg" alt="Github Logo" width="30" height="30" style="filter: invert(1);" class="d-inline-block ms-2"></a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	</body>
	
<div class="mx-auto p-3 d-flex align-items-center flex-fill">
  <main>
    <h1 class="text-center">Advent Calendar</h1>

    <div class="container text-center">
      <div class="row row-cols-2 row-cols-sm-4 row-cols-md-4 row-cols-lg-6 row-cols-xl-6 row-cols-xxl-8">
	  <?php foreach($calendarOrder as $number){ 
		if($number == $taget){?>
		<div class="col adventDiv">
          <div class="adventBox">
		  	<a class="adventButton" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
				<div class="adventDoor">
					<p class="adventText">
						<?php echo $number; ?>
					</p>
				</div>
				<div class="adventItemFrame">
						<img class="img-fluid adventIcon" src="/img/advent/<?php echo $number; ?>.png" alt="Advent Icon">
				</div>
			</a>	
		  </div>
        </div>
		<?php }else{ ?>
			<div class="col adventDiv">
			<div class="adventBox">
				<div class="adventFrame">
					<p class="adventText <?php if($number<$taget){echo "adventClose";}?>">
					<?php echo $number; ?>
					</p>
				</div>	
		  	</div>
		</div>
		<?php } }?>
      </div>  
    </div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Door <?php echo $taget; ?>: <?php echo $questions[$taget-1][7]; ?></h1>
        <button id="adventCloseButton" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="adventBody">
	  <p><?php echo $questions[$taget-1][0]; ?></p>
	  <div class="row row-cols-md-2 gy-2">
		  	<?php
				$letter = ['A','B','C','D'];
				$answers = [
					'<div class="d-flex "><button class="col d-flex text-start btn btn-labeled  btn-primary text-white" type="button" data-solution="true"onclick="checkAnswer(this);"><span class="btn-label h-100 align-content-center">%%</span><p class="align-self-center mb-0">'.$questions[$taget-1][1].'</p></button></div>',
					'<div class="d-flex "><button class="col d-flex text-start btn btn-labeled  btn-primary text-white" type="button" data-solution="false"onclick="checkAnswer(this);"><span class="btn-label h-100 align-content-center">%%</span><p class="align-self-center mb-0">'.$questions[$taget-1][2].'</p></button></div>',
					'<div class="d-flex "><button class="col d-flex text-start btn btn-labeled  btn-primary text-white" type="button" data-solution="false"onclick="checkAnswer(this);"><span class="btn-label h-100 align-content-center">%%</span><p class="align-self-center mb-0">'.$questions[$taget-1][3].'</p></button></div>',
					'<div class="d-flex "><button class="col d-flex text-start btn btn-labeled  btn-primary text-white" type="button" data-solution="false"onclick="checkAnswer(this);"><span class="btn-label h-100 align-content-center">%%</span><p class="align-self-center mb-0">'.$questions[$taget-1][4].'</p></button></div>'
				];
				shuffle($answers);
				foreach ($answers as $index=>$ans) {?>
						<?php echo str_replace("%%", $letter[$index], $ans); ?>
				<?php } ?>
        </div>
			<p class="text-muted mb-0" id="adventTipp" style="display: none;"><?php if($taget!=24){ ?>Tipp: The solution can be found in rule <a href="https://doc.fs-quiz.eu/FS-Rules_2025_v1.0.pdf<?php echo $questions[$taget-1][6]; ?>" target="_blank"><?php echo $questions[$taget-1][5]; ?></a><?php } ?></p>
		</div>
    </div>
  </div>
</div>
<!-- Modal END -->
  </main>
  </div> 
  <?php 
	require('./footer.php');
?>