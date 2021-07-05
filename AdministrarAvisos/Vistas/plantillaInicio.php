<?php
session_start();
if($_SESSION["IngresoA"]){
    if(!isset($_GET["pag"])&&isset($_GET["tipo"])){
        $_GET["pag"]=1;
    }else if(!isset($_GET["pag"])&&!isset($_GET["tipo"])){
        $_GET=array("pag"=>1,"tipo"=>"todo");
    }
}else{
    header("Location:./index.php");
    exit();
}
?>
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
    <header class="fondoHeader rounded m-3 mt-0 p-2">
        <p class="d-inline text-light row-cols-3 fs-4">Ordenear por:</p>
        <br>
        <img src="Vistas/img/upem-logo.jpg" class="rounded float-end " alt="logo upem" width="200">
        <nav class="navbar navbar-expand-lg d-inline-block bg-light rounded w-50 h-50 me-3">
            <div class="container-fluid justify-content-center m-0" id="Nav">
                <?php
                $inicio = new InicioC();
                $inicio->DeterminarNavBar();
                ?>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-dark d-inline-block bg-light rounded w-25 h-50">
            <div class="container-fluid justify-content-center m-0 p-0" id="Nav">
                <a class="btn btn-primary bg-gradient rounded m-2" aria-current="page" href="./modificar.php?accion=agregar">Crear Anuncio+</a>
                <form method="post"><input class="btn btn-success bg-gradient" name="Cerrar" type="submit" value="Cerrar sesion"></form>
                <?php
                $inicio->cerrarSesion();
                ?>
            </div>
        </nav>
    </header>
    <main class="d-flex flex-column align-items-center w-100 col-6">
        <?php
        $inicio->BuscarAnunciosC();
        ?>
    </main>
    <footer>
        <?php
        $inicio->BuscarPaginacionC();
        ?>
    </footer>
</body>

</html>