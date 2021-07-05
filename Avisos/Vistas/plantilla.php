<?php
if(!isset($_GET["pag"])&&isset($_GET["tipo"])){
    $_GET["pag"]=1;
}else if(!isset($_GET["pag"])&&!isset($_GET["tipo"])){
    $_GET=array("pag"=>1,"tipo"=>"todo");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Avisos</title>
</head>
<body class="colorFondo">
    <header class="fondoHeader rounded m-3 p-4">
        <?php
        $anuncios = new AnunciosC();
        $anuncios->DeterminarNavBar();
        ?>
    </header>
    <main class="d-flex flex-column align-items-center w-100">
        <?php
        $anuncios->BuscarAnunciosC();
        ?>
    </main>
    <footer>
        <?php
        $anuncios->BuscarPaginacionC();
        ?>
    </footer>
</body>
</html>