<header class="header-section">
  <div class="top-nav">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <ul class="tn-left">
            <li><a class="text-primary" href="tel:+18094697469"> <i class="fa fa-phone"></i> +1 809 469 7469</a></li>
            <li><a class="text-primary" href="mailto:info@edenroccapcana.com"> <i class="fa fa-envelope"></i> info@edenroccapcana.com</a></li>
          </ul>
        </div>
        <div class="col-lg-6">
          <div class="tn-right">
            <a href='/BookingCart' class="bk-btn">Reserva ahora!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="menu-item">
    <div class="container">
      <nav class="navbar navbar-expand-lg  navbar-dark" aria-label="Fifth navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">
            <div class="logo">
              <h2 class="logo-title">
                Eden Roc
              </h2>
            </div>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href='<?= linkTo(["Rooms"]) ?>'>Habitaciónes</a>
              </li>

              <?php if ($this->currentUser()) : ?>
                <li class="nav-item">
                  <a class="nav-link" href='<?= linkTo(['Bookings']) ?>'>Bookings</a>
                </li>
                <?php if ($this->isAdmin()) : ?>
                  <li class="nav-item">
                    <a class="nav-link" href='<?= linkTo(['Admin']) ?>'>
                      <i class="fa fa-key"> </i> Admin Panel</a>
                  </li>
                <?php endif; ?>
                <li class="nav-item">
                  <a class="nav-link" href='<?= linkTo(['Session', 'destroy'], ['ReturnUrl' => $_SERVER['REQUEST_URI']]) ?>'><i class="fa fa-times"> </i> SALIR DE MI CUENTA</a>
                </li>
              <?php else : ?>
                <li class="nav-item">
                  <a class="nav-link" href='<?= linkTo(['Session'], ['ReturnUrl' => $_SERVER['REQUEST_URI']]) ?>'><i class="fa fa-user"> </i> LOGIN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href='<?= linkTo(['Registrations', 'new'], ['ReturnUrl' => $_SERVER['REQUEST_URI']]) ?>'><i class="fa fa-key"> </i> REGISTRO</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>



    </div>
  </div>
</header>