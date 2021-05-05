<!DOCTYPE html>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.20/lodash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="/admin/styles.css" />
  <script src="/admin/scripts.js"></script>
  <meta name="theme-color" content="#7952b3">
  <title> <?= yieldContent('title') ?> </title>
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"><a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a><button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button><input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap"><a class="nav-link" href="/Session/destroy">Sign out</a></li>
    </ul>
  </header>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span data-feather="home"></span>Dashboard </a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'Rooms']) ?>"><span data-feather="shopping-cart"></span>Rooms </a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'RoomTypes']) ?>"><span data-feather="shopping-cart"></span>Room Types </a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'RoomCapacities']) ?>"><span data-feather="shopping-cart"></span>Room Capacities </a></li>
          </ul>
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"><span>Saved reports</span><a class="link-secondary" href="#" aria-label="Add a new report"><span data-feather="plus-circle"></span></a></h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item"><a class="nav-link" href="#"><span data-feather="file-text"></span>Current month </a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span data-feather="file-text"></span>Last quarter </a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span data-feather="file-text"></span>Social engagement </a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span data-feather="file-text"></span>Year-end sale </a></li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        </div>
        <div><?php $this->yield($mainContent) ?></div>
      </main>
    </div>
  </div>
</body>

</html>