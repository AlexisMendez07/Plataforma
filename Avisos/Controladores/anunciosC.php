<?php

class AnunciosC {

    private function ObtenerTodoC(){
        //Los datos a ingresar es el incio que se resta 1 ya que debe empezar por 0 
        //se multiplica por 5 ya que la cuenta va de 5 en 5 
        //El fin es la misma operacion pero mas 5 ya que son 5 anuncios los que se muestran
        $datos = array("inicio"=>(($_GET["pag"]-1)*5),"fin"=>((($_GET["pag"]-1)*5)+5));
        $tablaBD = "anuncios";

        $respuesta = AnunciosM::ObtenerTodoM($datos,$tablaBD);
        //Se agregan los anuncios obtenidos en la consulta
        foreach($respuesta as $key =>$value){
            echo '<article class=" card m-3 w-75">
                    <div class="card-header">Tema del anuncio:
                        '.$value["tipo"].'
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">'.$value["titulo"].'</h5>
                        <p class="card-text">'.$value["contenido"].'</p>
                    </div>
                    <div class="card-footer text-muted">Fecha de publicacion:
                        '.$value["fecha"].'
                    </div>
                </article>';
        }
    }
    private function ObtenerCantidadTotalC(){
        $tablaBD = "anuncios";
        
        $respuesta = AnunciosM::ObtenerCantidadTotalM($tablaBD);
        //Se divide entre 5 que es la cantidad de anuncios por pagina y 
        //se redondea hacia arriba para obtener la cantidad de paginas totales
        $cantidadPaginas = ceil($respuesta["total_anuncios"]/5);

        return $cantidadPaginas;
    }
    private function ObtenerPaginacionTotalC(){
        $pagActual = $_GET["pag"];
        //Se obtiene la cantidad total de paginas posibles
        $cantPaginas = $this->ObtenerCantidadTotalC();

        $this->Paginar($pagActual,$cantPaginas);
    }
    private function Paginar($pagActual,$cantPaginas){
        //Se comienza a agregar la estructura para la paginacion
        echo'<p class="text-center text-muted">Esta pagina es solo informativa</p>
                <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">';
        
        //Se desactiva el link en caso de que ya no se pueda ir mas atras
        if($pagActual<=1){
            echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>';
        }else if($pagActual>1){
            echo '<li class="page-item"><a class="page-link" href="./index.php?pag='.($pagActual-1).'&tipo='.$_GET["tipo"].'" tabindex="-1" aria-disabled="true">Anterior</a>';
        }
        echo'</li>';

        //Se agrean las anclas y se activa la actual
        for($i = 1;$i<=$cantPaginas;$i++){
            if($i == $pagActual){
                echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
            }else{
                echo '<li class="page-item"><a class="page-link" href="./index.php?pag='.$i.'&tipo='.$_GET["tipo"].'">'.$i.'</a></li>';
            }
        }

        //Se desactiva el link en caso de no haber mas adelante
        if($pagActual>=$cantPaginas){
            echo '<li class="page-item disabled"><a class="page-link" href="#">Siguente</a>';
        }else if($pagActual < $cantPaginas){
            echo '<li class="page-item "><a class="page-link" href="./index.php?pag='.($pagActual+1).'&tipo='.$_GET["tipo"].'">Siguente</a>';
        }
        echo'</li>';
    }
    public function DeterminarNavBar(){
        //Se agregan las etiquetas que se usaran siempre
        echo '<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid bg-light rounded m-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav fs-5">';
        
        //Se compara uno por uno para agregar si esta activado o no
        echo ($_GET["tipo"]=="todo")?'<a class="nav-link active" href="#">Todo</a>' 
        : '<a class="nav-link" href="./index.php?tipo=todo">Todo</a>';
        echo ($_GET["tipo"]=="ss")?'<a class="nav-link active" href="#">Servicio social</a>' 
        : '<a class="nav-link" href="./index.php?tipo=ss">Servicio social</a>';
        echo ($_GET["tipo"]=="posgrado")? '<a class="nav-link active" href="#">Posgrado</a>' 
        : '<a class="nav-link" href="./index.php?tipo=posgrado">Posgrado</a>';
        echo ($_GET["tipo"]=="inscripciones")? '<a class="nav-link active" href="#">Inscripciones</a>' 
        : '<a class="nav-link" href="./index.php?tipo=inscripciones">Inscripciones</a>';
        echo ($_GET["tipo"]=="general")? '<a class="nav-link active" href="#">General</a>' 
        : '<a class="nav-link" href="./index.php?tipo=general">General</a>';
        //Etiquetas generales finales
        echo '</div>
        </div>
    </div>
    <img src="Vistas/img/upem-logo.jpg" class="rounded float-end m-2" alt="logo upem" width="200">';
    }
    private function ObtenerAnunciosC($tipo){
        $datos = array("tipo"=>$tipo,"inicio"=>(($_GET["pag"]-1)*5),"fin"=>((($_GET["pag"]-1)*5)+5));
        $tablaBD = "anuncios";

        $respuesta = AnunciosM::ObtenerAnunciosM($datos,$tablaBD);

        foreach($respuesta as $key =>$value){
            echo '<article class=" card m-3 w-75">
                    <div class="card-header">Tema del anuncio:
                        '.$value["tipo"].'
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">'.$value["titulo"].'</h5>
                        <p class="card-text">'.$value["contenido"].'</p>
                    </div>
                    <div class="card-footer text-muted">Fecha de publicacion:
                        '.$value["fecha"].'
                    </div>
                </article>';
        }
    }
    private function ObtenerCantidadC($tipo){
        $tablaBD = "anuncios";
        $datos = $tipo;
        
        $respuesta = AnunciosM::ObtenerCantidadM($datos,$tablaBD);
        //Se divide entre 5 que es la cantidad de anuncios por pagina y 
        //se redondea hacia arriba para obtener la cantidad de paginas totales
        $cantidadPaginas = ceil($respuesta["total_anuncios"]/5);

        return $cantidadPaginas;
    }
    private function ObtenerPaginacionC($tipo){
        $pagActual=$_GET["pag"];

        $cantPaginas= $this->ObtenerCantidadC($tipo);
        
        $this->Paginar($pagActual,$cantPaginas);
    }
    public function BuscarAnunciosC(){
        switch($_GET["tipo"]){
            case "todo":
                $this->ObtenerTodoC();
                break;
            case "ss":
                $this->ObtenerAnunciosC("Servicio social");
                break;
            case "posgrado":
                $this->ObtenerAnunciosC("posgrado");
                break;
            case "inscripciones":
                $this->ObtenerAnunciosC("inscripciones");
                break;
            case "general":
                $this->ObtenerAnunciosC("general");
                break;
        }
    }
    public function BuscarPaginacionC(){
        switch($_GET["tipo"]){
            case "todo":
                $this->ObtenerPaginacionTotalC();
                break;
            case "ss":
                $this->ObtenerPaginacionC("Servicio social");
                break;
            case "posgrado":
                $this->ObtenerPaginacionC("posgrado");
                break;
            case "inscripciones":
                $this->ObtenerPaginacionC("inscripciones");
                break;
            case "general":
                $this->ObtenerPaginacionC("general");
                break;
        }
    }
}

?>