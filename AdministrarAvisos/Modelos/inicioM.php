<?php

require_once "conexionBD.php";

class InicioM extends ConexionBD{
    static public function ObtenerTodoM($datos,$tablaBD){
        try {
            //Se hace la consulta usando limit
            $pdo = ConexionBD::cBD()->prepare("SELECT tipo, titulo, contenido, fecha, id_anuncio FROM $tablaBD ORDER BY fecha DESC LIMIT :inicio,:fin ");
            $pdo->bindParam(":inicio",$datos["inicio"],PDO::PARAM_INT);
            $pdo->bindParam(":fin",$datos["fin"],PDO::PARAM_INT);
            $pdo->execute();

            return $pdo->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
    static public function ObtenerCantidadTotalM($tablaBD){
        try {
            //Cuenta cuantos registros hay en la tabla
            $pdo = ConexionBD::cBD()->prepare("SELECT COUNT(*) as total_anuncios FROM $tablaBD");
            $pdo->execute();

            return $pdo->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
    static public function ObtenerAnunciosM($datos,$tablaBD){
        try {
            //Se hace la consulta usando limit
            $pdo = ConexionBD::cBD()->prepare("SELECT tipo, titulo, contenido, fecha, id_anuncio FROM $tablaBD WHERE tipo = :tipo ORDER BY fecha DESC LIMIT :inicio,:fin ");
            $pdo->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
            $pdo->bindParam(":inicio",$datos["inicio"],PDO::PARAM_INT);
            $pdo->bindParam(":fin",$datos["fin"],PDO::PARAM_INT);
            $pdo->execute();

            return $pdo->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
    static public function ObtenerCantidadM($datos,$tablaBD){
        try {
            //Cuenta cuantos registros hay en la tabla
            $pdo = ConexionBD::cBD()->prepare("SELECT COUNT(*) as total_anuncios FROM $tablaBD WHERE tipo = :tipo");
            $pdo->bindParam(":tipo",$datos,PDO::PARAM_STR);
            $pdo->execute();

            return $pdo->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
}

?>