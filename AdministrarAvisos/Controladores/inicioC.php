<?php

class InicioC{
    private function ObtenerTodoC(){
        //Los datos a ingresar es el incio que se resta 1 ya que debe empezar por 0 
        //se multiplica por 5 ya que la cuenta va de 5 en 5 
        //El fin es la misma operacion pero mas 5 ya que son 5 anuncios los que se muestran
        $datos = array("inicio"=>(($_GET["pag"]-1)*5),"fin"=>((($_GET["pag"]-1)*5)+5));
        $tablaBD = "anuncios";

        $respuesta = InicioM::ObtenerTodoM($datos,$tablaBD);
        //Se agregan los anuncios obtenidos en la consulta
        foreach($respuesta as $key =>$value){
            echo '<article class=" card m-3 w-75">
                    <div class="card-header">Tema del anuncio:
                        '.$value["tipo"].'
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">'.$value["titulo"].'</h5>
                        <p class="card-text">'.$value["contenido"].'</p>
                        <a class="btn btn-primary bg-gradient" href="./modificar.php?accion=editar&id='.$value["id_anuncio"].'">Editar</a>
                        <a class="btn btn-danger bg-gradient" href="./modificar.php?accion=eliminar&id='.$value["id_anuncio"].'">Eliminar</a>
                    </div>
                    <div class="card-footer text-muted">Fecha de publicacion:
                        '.$value["fecha"].'
                    </div>
                </article>';
        }
    }
    private function ObtenerCantidadTotalC(){
        $tablaBD = "anuncios";
        
        $respuesta = InicioM::ObtenerCantidadTotalM($tablaBD);
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
            echo '<li class="page-item"><a class="page-link" href="./inicio.php?pag='.($pagActual-1).'&tipo='.$_GET["tipo"].'" tabindex="-1" aria-disabled="true">Anterior</a>';
        }
        echo'</li>';

        //Se agrean las anclas y se activa la actual
        for($i = 1;$i<=$cantPaginas;$i++){
            if($i == $pagActual){
                echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
            }else{
                echo '<li class="page-item"><a class="page-link" href="./inicio.php?pag='.$i.'&tipo='.$_GET["tipo"].'">'.$i.'</a></li>';
            }
        }

        //Se desactiva el link en caso de no haber mas adelante
        if($pagActual>=$cantPaginas){
            echo '<li class="page-item disabled"><a class="page-link" href="#">Siguente</a>';
        }else if($pagActual < $cantPaginas){
            echo '<li class="page-item "><a class="page-link" href="./inicio.php?pag='.($pagActual+1).'&tipo='.$_GET["tipo"].'">Siguente</a>';
        }
        echo'</li>';
    }
    public function DeterminarNavBar(){
        
        //Se compara uno por uno para agregar si esta activado o no
        echo ($_GET["tipo"]=="todo")?'<a class="btn btn-danger bg-gradient rounded m-2" aria-current="page" href="#">Todo</a>' 
        : '<a class="btn btn-outline-danger m-2" aria-current="page" href="./inicio.php?tipo=todo">Todo</a>';
        echo ($_GET["tipo"]=="ss")?'<a class="btn btn-danger bg-gradient rounded m-2" aria-current="page" href="#">Servicio social</a>' 
        : '<a class="btn btn-outline-danger m-2" aria-current="page" href="./inicio.php?tipo=ss">Servicio social</a>';
        echo ($_GET["tipo"]=="posgrado")?'<a class="btn btn-danger bg-gradient rounded m-2" aria-current="page" href="#">Posgrado</a>' 
        : '<a class="btn btn-outline-danger m-2" aria-current="page" href="./inicio.php?tipo=posgrado">Posgrado</a>';
        echo ($_GET["tipo"]=="inscripciones")?'<a class="btn btn-danger bg-gradient rounded m-2" aria-current="page" href="#">Inscripciones</a>' 
        : '<a class="btn btn-outline-danger m-2" aria-current="page" href="./inicio.php?tipo=inscripciones">Incripciones</a>';
        echo ($_GET["tipo"]=="general")?'<a class="btn btn-danger bg-gradient rounded m-2" aria-current="page" href="#">General</a>' 
        : '<a class="btn btn-outline-danger m-2" aria-current="page" href="./inicio.php?tipo=general">General</a>';
        
    }
    private function ObtenerAnunciosC($tipo){
        $datos = array("tipo"=>$tipo,"inicio"=>(($_GET["pag"]-1)*5),"fin"=>((($_GET["pag"]-1)*5)+5));
        $tablaBD = "anuncios";

        $respuesta = InicioM::ObtenerAnunciosM($datos,$tablaBD);

        foreach($respuesta as $key =>$value){
            echo '<article class=" card m-3 w-75">
                    <div class="card-header">Tema del anuncio:
                        '.$value["tipo"].'
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">'.$value["titulo"].'</h5>
                        <p class="card-text">'.$value["contenido"].'</p>
                        <a class="btn btn-primary bg-gradient" href="./modificar.php?accion=editar&id='.$value["id_anuncio"].'">Editar</a>
                        <a class="btn btn-danger bg-gradient" href="./modificar.php?accion=eliminar&id='.$value["id_anuncio"].'">Eliminar</a>
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
        
        $respuesta = InicioM::ObtenerCantidadM($datos,$tablaBD);
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
    public function cerrarSesion(){
        if(isset($_POST["Cerrar"])){
            session_unset();
            session_destroy();
            header("location:index.php");
            exit;
        }
    }
}

?>