
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title> <?=$title?> </title>
  
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="./assets/js/fontawesome.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="Public/styles/User_Association/Mster.css">
  <!--
  <style>
      .loader {
      height: 15px;
      aspect-ratio: 4;
      --_g: no-repeat radial-gradient(farthest-side,#000 90%,#0000);
      background: 
        var(--_g) left, 
        var(--_g) right;
      background-size: 25% 100%;
      display: grid;
    }
    .loader:before,
    .loader:after {
      content: "";
      height: inherit;
      aspect-ratio: 1;
      grid-area: 1/1;
      margin: auto;
      border-radius: 50%;
      transform-origin: -100% 50%;
      background: #000;
      animation: l49 1s infinite linear;
    }
    .loader:after {
      transform-origin: 200% 50%;
      --s:-1;
      animation-delay: -.5s;
    }

    @keyframes l49 {
      58%,
      100% {transform: rotate(calc(var(--s,1)*1turn))}
    }
    </style>
    -->
</head>

<body class="g-sidenav-show bg-gray-100">
  
    <div class="position-fixed d-flex justify-content-center vh-100 col-12 align-items-center">
      <div class="loader"></div>
    </div>
  
  <?php include_once './App/Vue/Nav.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?=$title?></li>
          </ol>
        </nav>
        <?php if (isset($_GET["action"]) && $_GET["action"]=="Accueil") :?>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" id="inputrch" placeholder="Recherch">
            </div>
          </div>
        </div>
        <?php endif ;?>
      </div>
    </nav>
    
    <div class="container-fluid py-4">
      <?= $content ?>
    </div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  
  <!-- Github buttons -->
  <script async defer src="./assets/js/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  
</body>

</html>