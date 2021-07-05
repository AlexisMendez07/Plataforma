<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Vistas/css/colores.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <title>Inicio</title>
</head>

<body class="colorFondo">
  <header class="fondoHeader d-block rounded m-3 p-5">
    <p class="d-inline text-light fs-4">Bienvenido al administrador de anuncios</p>
    <img src="Vistas/img/upem-logo.jpg" class="rounded float-end " alt="logo upem" width="200">
  </header>
  <main class="d-flex justify-content-center">
    <div class="card text-center w-50">
      <div class="card-header">
        Iniciar sesion
      </div>
      <div class="card-body">
        <form method="post">
          <div class="mb-3 row">
            <label for="inputUsario" class="col-sm-2 col-form-label">Usuario</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputUsuario" name="Usuario" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputContrasennia" class="col-sm-2 col-form-label">Contraseña</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputContrasennia" name="Contra" required>
            </div>
          </div>
          <div class="col-row">
            <input type="submit" value="Iniciar Sesion" class="btn btn-danger bg-gradient mb-3">
          </div>
          <?php
          $login = new LoginC();
          $login->ValidarLoginC();
          ?>
        </form>
      </div>
      <div class="card-footer text-muted">
        Version 1.0
      </div>
    </div>
  </main>
  <footer>

  </footer>
</body>