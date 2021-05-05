<main class="form-signin">
  <form action="/Session/create" method="post">
    <h1 class="h3 mb-3 fw-normal text-center">Credenciales de acceso</h1>

    <?php foreach ($this->errors as $error) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $error ?>
      </div>
    <?php endforeach; ?>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" />
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" />
      <input type="hidden" class="form-control" name="ReturnUrl" value="<?= Web\Params::get('ReturnUrl') ?>" />
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Acceder</button>
  </form>
</main>


<style>
  html,
  body {
    height: 100%;
  }

  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
  }

  .form-signin .checkbox {
    font-weight: 400;
  }

  .form-signin .form-floating:focus-within {
    z-index: 2;
  }

  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
</style>