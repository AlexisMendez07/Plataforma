<?php

class LoginC{
    public function ValidarLoginC(){
        if(isset($_POST["Usuario"])){
            $usuario = $_POST["Usuario"];
            $contrasennia = $_POST["Contra"];
            $tablaBD="usuarios";
            $datos = $usuario;

            $respuesta = LoginM::ValidarLoginM($datos,$tablaBD);

            if($respuesta["usuario"]==$usuario &&$respuesta["contrasennia"]==$contrasennia){
                session_start();

                $_SESSION["IngresoA"]=true;
                $_SESSION["Usuario"]=$usuario;

                header("Location:./inicio.php?tipo=todo");
                exit;
            }else{
                echo'Error al iniciar sesion';
            }

        }
    }
}

?>