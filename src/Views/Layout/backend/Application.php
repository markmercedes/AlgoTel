<!DOCTYPE html>

<html lang='es' xml:lang='es'>

<head>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="/pickadate/picker.js"></script>
  <script src="/pickadate/picker.date.js"></script>
  <script src="/pickadate/translations/es_ES.js"></script>
  <link rel="stylesheet" href="/pickadate/themes/default.css" />
  <link rel="stylesheet" href="/pickadate/themes/default.date.css" />
  <link rel="stylesheet" href="/admin/styles.css" />
  <script src="/admin/scripts.js"></script>
  <meta name="theme-color" content="#7952b3">
  <title> <?= yieldContent('title') ?> </title>
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"><a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">Eden Roc</a><button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button><input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap"><a class="nav-link" href="/Session/destroy">Sign out</a></li>
    </ul>
  </header>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link text-primary" href="<?= linkTo(['Admin', 'Bookings']) ?>">
                <h5 class="text-primary">Bookings </h5>
              </a>
            </li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'Bookings'], ['order_status' => 'pending']) ?>">Pendientes</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'Bookings'], ['order_status' => 'processing']) ?>">En proceso</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'Bookings'], ['order_status' => 'cancelled']) ?>">Canceladas</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'Bookings'], ['order_status' => 'complete', 'checkin_date_submit' => date('Y-m-d')]) ?>">Checkin hoy</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'Bookings'], ['order_status' => 'complete', 'checkout_date_submit' => date('Y-m-d')]) ?>">Checkout hoy</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'Bookings']) ?>">Todos los bookings</a></li>
            <li class="nav-item">
              <a class="nav-link text-primary" href="<?= linkTo(['Admin', 'Rooms']) ?>">
                <h5 class="text-primary">Habitaciónes </h5>
              </a>
            </li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'RoomTypes']) ?>">Tipos de Habitaciónes </a></li>
            <li class="nav-item"><a class="nav-link" href="<?= linkTo(['Admin', 'RoomCapacities']) ?>">Capacidades de Habitaciónes </a></li>
            <li class="nav-item">
              <a class="nav-link" href="<?= linkTo(['Admin', 'Users']) ?>">
                <h5 class="text-primary">Usuarios </h5>
              </a>
            </li>
            <li class="nav-item">
              <h5 class="text-primary nav-link">Reportes </h5>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">Bookings por fecha </a></li>
            <li class="nav-item"><a class="nav-link" href="#">Habitaciónes ocupadas </a></li>
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