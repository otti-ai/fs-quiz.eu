<?php
	require($_SERVER['DOCUMENT_ROOT']. '/api/1/orginal_db.php');
	require($_SERVER['DOCUMENT_ROOT']. '/statistic.php');
?>
<!doctype html>
<html lang="en">
  <head>
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
	<base href="/">         <!--  https://fs-quiz.eu/ -->
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.min.js"></script>
	<?php 
		$menu = array(
			'./home' => 'Home',
			'./quizzes' => 'Quizzes',
			'./search' => 'Search',
			'http://api.fs-quiz.eu' => 'API',
			'./about' => 'About'
		);
	?>
	
    <title><?php echo $titel ?></title>
  </head>
  <body class="d-flex flex-column min-vh-100"> 

  <!--<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
  	<strong>Maintenance on 30 December!</strong> Due to the change of my hosting provider and a major update (yes, it's about the API) this site will be down for several hours.
  	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>-->

  <!-- Navigation -->
	<header class="p-3 bg-dark text-white">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid col-lg-8">
				<a class="navbar-brand" href="./home">FS-Quiz</a>
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
					<ul class="nav navbar-nav navbar-right">
						<li class="nav-item"><a target="_blank" href="https://github.com/otti-ai/fs-quiz.eu"><img src="/img/icons/github.svg" alt="Github Logo" width="25" height="25" style="filter: invert(1);" class="d-inline-block align-text-center"></a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	</body>