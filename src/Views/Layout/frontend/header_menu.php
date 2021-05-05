<header class="header-section">
  <div class="top-nav">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <ul class="tn-left">
            <li><i class="fa fa-phone"></i> (12) 345 67890</li>
            <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
          </ul>
        </div>
        <div class="col-lg-6">
          <div class="tn-right">
            <a href='<?= linkTo(['Session'], ['ReturnUrl' => $_SERVER['REQUEST_URI']]) ?>' class="bk-btn">Reserva ahora!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="menu-item">
    <div class="container">
      <div class="row">
        <div class="col-lg-2">
          <div class="logo">
            <h2 class="logo-title">
              <a href="/">
                Eden Roc
              </a>
            </h2>
          </div>
        </div>
        <div class="col-lg-10">
          <div class="nav-menu">
            <nav class="mainmenu">
              <ul>
                <li><a href='<?= linkTo(["Rooms"]) ?>'>Habitaciones</a></li>
                <li><a href="./about-us.html">Nosotros</a></li>
                <li><a href="./contact.html">Contact</a></li>

                <?php if ($this->currentUser()) : ?>
                  <?php if ($this->isAdmin()) : ?>
                    <li><a href='<?= linkTo(['Admin', 'Rooms']) ?>'>
                        <i class="fa fa-key"> </i> Admin Panel</a></li>
                  <?php endif; ?>
                  <li><a href='<?= linkTo(['Session', 'destroy'], ['ReturnUrl' => $_SERVER['REQUEST_URI']]) ?>'><i class="fa fa-times"> </i> SALIR DE MI CUENTA</a></li>
                <?php else : ?>
                  <li><a href='<?= linkTo(['Session'], ['ReturnUrl' => $_SERVER['REQUEST_URI']]) ?>'><i class="fa fa-user"> </i> LOGIN</a></li>
                <?php endif; ?>
              </ul>
            </nav>
            <div class="nav-right search-switch">
              <i class="icon_search"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>