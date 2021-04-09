<!DOCTYPE html>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/styles.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.20/lodash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <header>
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
                <div class="top-social">
                  <a href="#"><i class="fab fa-facebook"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-tripadvisor"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <a href="#" class="bk-btn">Reserva ahora!</a>
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
                  <a href="./index.html">
                    Eden Roc
                  </a>
                </h2>
              </div>
            </div>
            <div class="col-lg-10">
              <div class="nav-menu">
                <nav class="mainmenu">
                  <ul>
                    <li class="active"><a href="./index.html">Home</a></li>
                    <li><a href="./rooms.html">Rooms</a></li>
                    <li><a href="./about-us.html">About Us</a></li>
                    <li><a href="./pages.html">Pages</a>
                      <ul class="dropdown">
                        <li><a href="./room-details.html">Room Details</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                        <li><a href="#">Family Room</a></li>
                        <li><a href="#">Premium Room</a></li>
                      </ul>
                    </li>
                    <li><a href="./blog.html">News</a></li>
                    <li><a href="./contact.html">Contact</a></li>
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
  </header>

  <div class="hero-section home-entry">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-none d-lg-block">
          <div class="hero-text">
            <h1>Eden Roc</h1>
            <h2 class="text-light">en Cap Cana</h2>
            <p>Tu mejor opción a la hora de visitar la exclusiva zona de Cap Cana.</p>
          </div>
        </div>
        <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
          <div class="booking-form">
            <form action="#">
              <div class="check-date">
                <label for="date-in">Check In:</label>
                <input type="date" class="date-input hasDatepicker" id="date-in">
                <i class="icon_calendar"></i>
              </div>
              <div class="check-date">
                <label for="date-out">Check Out:</label>
                <input type="date" class="date-input hasDatepicker" id="date-out">
                <i class="icon_calendar"></i>
              </div>
              <div class="select-option">
                <label for="guest">Adultos:</label>
                <select id="guest" class="form-select">
                  <option value="1">1 adulto</option>
                  <option selected="selected" value="2">2 adultos</option>
                  <option value="3">3 adultos</option>
                  <option value="4">4 adultos</option>
                  <option value="5">5 adultos</option>
                  <option value="6">6 adultos</option>
                  <option value="7">7 adultos</option>
                </select>
              </div>
              <div class="select-option">
                <label for="room">Niños:</label>
                <select id="room" class="form-select">
                  <option selected="selected" value="0">0 niño</option>
                  <option value="1">1 niño</option>
                  <option value="2">2 niños</option>
                  <option value="2">2 niños</option>
                  <option value="3">3 niños</option>
                  <option value="4">4 niños</option>
                  <option value="5">5 niños</option>
                </select>
              </div>
              <button type="submit">Revisar disponibilidad</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-xs-12">
        <h3 class="py-5">Amenidades</h3>
        <div class="row amenities-list">
          <div class="col-sm-4">
            parque acuático
          </div>
          <div class="col-sm-4">wi-fi</div>
          <div class="col-sm-4">mini bar</div>
          <div class="col-sm-4">Smart TV</div>
          <div class="col-sm-4">Caja de Seguridad</div>
          <div class="col-sm-4">Aire acondicionado</div>
          <div class="col-sm-4">Gimnasio</div>
          <div class="col-sm-4">club para niños</div>
          <div class="col-sm-4">Discoteca</div>
          <div class="col-sm-4">zonas de deporte</div>
          <div class="col-sm-4">Bares</div>
          <div class="col-sm-4">restaurantes</div>
        </div>
      </div>
      <div class="col-md-4 col-xs-12">
        <h4 class="py-5">CHECKIN & CHECKOUT</h4>
        <ul class="list-unstyled">
          <li>
            <h5>CHECKIN</h5>
          </li>
          <li>15:00 PM</li>
          <li>
            <h5>CHECKOUT</h5>
          </li>
          <li>12:00 PM</li>
        </ul>
      </div>
    </div>


    <div class="container">
      <hr />
      <div class="row">
        <div class="col-sm-6 py-3">
          <h4>LO QUE TE GUSTA</h4>
          Los más pequeños pueden disfrutar de un spa para niños, un parque acuático, carritos chocones, entre otras opciones.
        </div>

        <div class="col-sm-6 py-3">
          <h4>LO QUE DEBES SABER</h4>
          Uno de los más modernos y lujosos dentro del complejo Bahia Principe en Bávaro.
        </div>
      </div>
    </div>
    <div class="container">
      <hr />
      <div class="row">
        <div class="col-sm-6 py-3">
          <h4>DESCRIPCIÓN GENERAL DEL HOTEL
          </h4>
          Eden Roc en Cap Cana combina los impecables estándares de los grandes complejos hoteleros a lo largo de las Riberas Francesas e Italianas, con la calidez y relajados encantos del Caribe.
        </div>

        <div class="col-sm-6 py-3">
          <h4>LO QUE DEBES SABER</h4>
          <ul class="list-unstyled">
            <li>Internet inalámbrico incluido</li>
            <li>Se admiten niños de todas las edades</li>
            <li>No se admite mascota</li>
          </ul>
        </div>
      </div>
    </div>

    <main class="container">
      <?php $this->yield($mainContent) ?>
    </main>
</body>

</html>