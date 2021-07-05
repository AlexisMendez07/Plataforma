<?php

require_once "conexionBD.php";

class LoginM extends ConexionBD{
    static public function ValidarLoginM($datos,$tablaBD)
    {
        try {
            //Se hace la consulta usando limit
            $pdo = ConexionBD::cBD()->prepare("SELECT usuario,contrasennia FROM $tablaBD WHERE usuario = :usuario");
            $pdo->bindParam(":usuario",$datos,PDO::PARAM_STR);
            $pdo->execute();

            return $pdo->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>