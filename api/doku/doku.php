<?php
$v = isset($api_version) ? $api_version : 1;
require($_SERVER['DOCUMENT_ROOT']. '/2/orginal_db.php');
require($_SERVER['DOCUMENT_ROOT']. '/2/statistic.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- ICONS-->
    <link rel="apple-touch-icon" sizes="57x57" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://fs-quiz.eu/img/icons/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="https://fs-quiz.eu/img/icons/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://fs-quiz.eu/img/icons/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://fs-quiz.eu/img/icons/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://fs-quiz.eu/img/icons/favicon/favicon-16x16.png">
    <link rel="manifest" href="https://fs-quiz.eu/img/icons/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="https://fs-quiz.eu/img/icons/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <base href="https://api.fs-quiz.eu/doku/">
    <title>FS-Quiz API Documentation</title>
    <!-- Embed elements Elements via Web Component -->
    <script src="./web-components.min.js"></script>
    <link rel="stylesheet" href="./styles.min.css">
    <script type="text/JavaScript">  
      function selectVersion() {
        var v = document.getElementById("version").value;
        location.replace('https://api.fs-quiz.eu/'+v+'/info');
      }
    </script>
    <link rel="stylesheet" href="./customStyle.css">

    <!-- Bootstrap -->
    <link href="https://fs-quiz.eu/css/bootstrap.min.css" rel="stylesheet">
	  <script src="https://fs-quiz.eu/js/bootstrap.min.js"></script>
  </head>
  <body>
    <header class="p-3 bg-dark text-white">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="https://api.fs-quiz.eu/"> <img src="https://fs-quiz.eu/img/icons/favicon/favicon-96x96.png" alt="" width="30" height="30" class="d-inline-block align-text-top me-2">FS-Quiz - API</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
            </ul>
            <ul class="nav  navbar-nav navbar-right align-items-center">
              <li class="nav-item">
                <a class="nav-link" href="" data-bs-target="#myModal" data-bs-toggle="modal">Version</a>
              </li>
              <li class="nav-item">
                <select class="form-select form-select-sm" id="version" onchange="selectVersion()">
                  <option <?php echo(($v == 2) ? 'selected' : '') ?> value="2" disabled>2</option>
                  <option <?php echo(($v != 2) ? 'selected' : '') ?> value="1">1</option>  
                </select>
              </li>


              <li class="nav-item"><a class="navbar-brand" target="_blank" href="https://github.com/otti-ai/fs-quiz.eu" style="vertical-align: super;"><img src="https://fs-quiz.eu/img/icons/github.svg" alt="Github Logo" width="30" height="30" style="filter: invert(1);" class="d-inline-block ms-2"></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div id="v1">
      <elements-api id="docs"
        router="hash"
        layout="sidebar"
        hideSchemas="true"
        apiDescriptionURL="<?php echo(($v != 2) ? './fs-quiz-api-v1.json' : './fs-quiz-api-v2.json') ?>"
      />
    </div>

    <footer class="footer mt-auto bg-light">
  <div class="col-lg-8 mx-auto p-3 text-dark">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <a href="https://fs-quiz.eu/contact" class="text-muted" style="text-decoration: none;">Contact</a>
    </div>
    <div class="col-md-auto">
      <a href="https://fs-quiz.eu/legal-notice" class="text-muted" style="text-decoration: none;">Legal notice</a>
    </div>
    <div class="col-md-auto">
      <a href="https://fs-quiz.eu/privacy" class="text-muted" style="text-decoration: none;">Privacy Policy</a>
    </div>
  </div>
  <div class="row justify-content-md-center">
  <div class="col-md-auto text-muted mt-2">
      <a> Created by Yannik Ottens · © <?php echo date('Y'); ?></a>
    </div>
  </div>
  </div>
</footer>
 </body>
</html>