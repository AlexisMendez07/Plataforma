<?php

class ModificarC{
    private function agregarAnuncioC(){
        if(isset($_POST["Tipo"])){
            $tablaBD = "anuncios";
            $datos = array("tipo"=>$_POST["Tipo"],"titulo"=>$_POST["Titulo"],"contenido"=>$_POST["Anuncio"],"fecha"=>$_POST["Fecha"]);

            $respuesta = ModificarM::agregarAnuncioM($datos,$tablaBD);
            if($respuesta == "Bien"){
                header("Location:inicio.php?tipo=todo");
            }else{
                echo'<script>alert("Error al agregar")</script>';
            }
        }
    }
    private function editarAnuncioC(){
        if(isset($_POST["Tipo"])){
            $tablaBD = "anuncios";
            $datos = array("id_anuncio"=>(int)$_POST["Id"],"tipo"=>$_POST["Tipo"],"titulo"=>$_POST["Titulo"],
            "contenido"=>$_POST["Anuncio"],"fecha"=>$_POST["Fecha"]);

            $respuesta = ModificarM::editarAnuncioM($datos,$tablaBD);

            if($respuesta=="Bien"){
                header("Location:inicio.php?tipo=todo");
            }else{
                echo'<script>alert("Error al modificar")</script>';
            }
        }
    }
    private function eliminarAnuncioC(){
        if(isset($_POST["Id"])){
            $tablaBD = "anuncios";
            $datos = array("id_anuncio"=>(int)$_POST["Id"]);

            $respuesta = ModificarM::eliminarAnuncioM($datos,$tablaBD);

            if($respuesta=="Bien"){
                header("Location:inicio.php?tipo=todo");
            }else{
                echo'<script>alert("Error al eliminar")</script>';
            }
        }
    }
    public function obtenerHeaderC(){
        switch($_GET["accion"]){
            case "agregar":
                echo 'Agregar Anuncio';
                break;
            case "editar":
                echo 'Editar Anuncio';
                break;
            case "eliminar":
                echo 'Elimnar Anuncio';
                break;
        }
    }
    public function obtenerFormularioC(){
        switch($_GET["accion"]){
            case "agregar":
                $this->formularioAgregar();
                break;
            case "editar":
                $this->formularioEditar();
                break;
            case "eliminar":
                $this->formularioEliminar();
                break;
        }
    }
    private function formularioAgregar(){
        $hoy = getdate();
        echo '<div class="mb-3">
                <label for="tipo">Seleccione el tipo de aviso:</label>
                <select class="form-select" name="Tipo" id="tipo" required>
                    <option selected disabled value="">Tipo de anuncio</option>
                    <option value="Servicio social">Servicio Social</option>
                    <option value="Posgrado">Posgrado</option>
                    <option value="Inscripciones">Inscripciones</option>
                    <option value="General">General</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo del anuncio:</label>
                <input type="text" name="Titulo" class="form-control" id="titulo" required>
            </div>
            <div class="mb-3">
                <label for="anuncio" class="form-label">Anuncio:</label>
                <textarea class="form-control" id="anuncio" rows="3" name="Anuncio" required></textarea>
                <span class="text-muted">Maximo 300 caracteres</span>
            </div>
            <div class="mb-3">
                <label for="fecha">Fecha que mostrara el anuncio:</label>
                <input class="form-control" type="text" value="'.$hoy["year"].'-'.$hoy["mon"].'-'.$hoy["mday"].'" aria-label="readonly input example" readonly id="fecha" name="Fecha">
            </div>
            <input type="submit" class="btn btn-primary mt-5" value="Publicar Anuncio">';
    }
    private function obtenerDatosAnuncioC(){
        $datos = (int)$_GET["id"];
        $tablaBD = "anuncios";

        $respuesta = ModificarM::obtenerDatosAnuncioM($datos,$tablaBD);
        return $respuesta;
    }
    private function compararTipo($tipo,$opcion){
        return ($tipo==$opcion)?'<option selected value="'.$opcion.'">'.$opcion.'</option>'
        :'<option value="'.$opcion.'">'.$opcion.'</option>';
    }
    private function formularioEditar(){
        $datosFormulario = $this->obtenerDatosAnuncioC();
        echo '<div class="mb-3">
                <input type="hidden" name="Id" value="'.$datosFormulario["id_anuncio"].'">
                <label for="tipo">Seleccione el tipo de aviso:</label>
                <select class="form-select" name="Tipo" id="tipo" required>
                    <option disabled value="">Tipo de anuncio</option>
                    '.$this->compararTipo($datosFormulario["tipo"],"Servicio social").'
                    '.$this->compararTipo($datosFormulario["tipo"],"Posgrado").'
                    '.$this->compararTipo($datosFormulario["tipo"],"Inscripciones").'
                    '.$this->compararTipo($datosFormulario["tipo"],"General").'
                </select>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo del anuncio:</label>
                <input type="text" name="Titulo" class="form-control" id="titulo" value="'.$datosFormulario["titulo"].'"  required>
            </div>
            <div class="mb-3">
                <label for="anuncio" class="form-label">Anuncio:</label>
                <textarea class="form-control" id="anuncio" rows="3" name="Anuncio" required>'.$datosFormulario["contenido"].'</textarea>
                <span class="text-muted">Maximo 300 caracteres</span>
            </div>
            <div class="mb-3">
                <label for="fecha">Fecha que mostrara el anuncio:</label>
                <input class="form-control" type="date" value="'.$datosFormulario["fecha"].'" id="fecha" required name="Fecha"">
            </div>
            <input type="submit" class="btn btn-primary mt-5" value="Editar Anuncio">';
    }
    private function formularioEliminar(){
        $datosFormulario = $this->obtenerDatosAnuncioC();
        echo '<div class="mb-3">
                <input type="hidden" name="Id" value="'.$datosFormulario["id_anuncio"].'">
                <label for="tipo">Seleccione el tipo de aviso:</label>
                <select class="form-select" name="Tipo" id="tipo" required disabled readonly>
                    <option disabled value="">Tipo de anuncio</option>
                    '.$this->compararTipo($datosFormulario["tipo"],"Servicio social").'
                    '.$this->compararTipo($datosFormulario["tipo"],"Posgrado").'
                    '.$this->compararTipo($datosFormulario["tipo"],"Inscripciones").'
                    '.$this->compararTipo($datosFormulario["tipo"],"General").'
                </select>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo del anuncio:</label>
                <input type="text" name="Titulo" class="form-control" id="titulo" value="'.$datosFormulario["titulo"].'"  required readonly>
            </div>
            <div class="mb-3">
                <label for="anuncio" class="form-label">Anuncio:</label>
                <textarea class="form-control" id="anuncio" rows="3" name="Anuncio" required readonly>'.$datosFormulario["contenido"].'</textarea>
                <span class="text-muted">Maximo 300 caracteres</span>
            </div>
            <div class="mb-3">
                <label for="fecha">Fecha que mostrara el anuncio:</label>
                <input class="form-control" type="date" value="'.$datosFormulario["fecha"].'" id="fecha" required readonly name="Fecha"">
            </div>
            <input type="submit" class="btn btn-primary mt-5" value="Eliminar Anuncio">';
    }
    public function realizarAccion(){
        switch($_GET["accion"]){
            case "agregar":
                $this->agregarAnuncioC();
                break;
            case "editar":
                $this->editarAnuncioC();
                break;
            case "eliminar":
                $this->eliminarAnuncioC();
                break;
        }
    }
}
