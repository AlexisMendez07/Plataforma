<?php
session_start();
if($_SESSION["IngresoA"]){
    /*if(!isset($_GET["accion"])){
        $_GET["accion"]="agregar";
    }else if(isset($_GET["accion"])&&!isset($_GET["id"])){
        $_GET=array("accion"=>"agregar");
    }*/
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Vistas/css/colores.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Agregar</title>
</head>

<body class="colorFondo">
    <header class="fondoHeader d-block rounded m-3 p-5">
        <p class="d-inline text-light fs-4">
            <?php
            $modificar = new ModificarC();
            $modificar -> obtenerHeaderC();
            ?>
        </p>
        <img src="Vistas/img/upem-logo.jpg" class="rounded float-end " alt="logo upem" width="200">
    </header>
    <main class="d-flex justify-content-center">
        <section class="bg-light w-50 m-3 p-5">
            <form method="post">
                <?php
                $modificar->obtenerFormularioC();
                $modificar->realizarAccion();
                ?>
                <a class="btn btn-danger mt-5" href="./inicio.php?tipo=todo">Cancelar</a>
            </form>
        </section>
    </main>
</body>

</html>