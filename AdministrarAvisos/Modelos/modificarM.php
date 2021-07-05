<?php

require_once "conexionBD.php";

class ModificarM extends ConexionBD{
    static public function agregarAnuncioM($datos,$tablaBD){
        try {
            //Se hace la consulta usando limit
            $pdo = ConexionBD::cBD()->prepare("INSERT INTO $tablaBD (tipo,titulo,contenido,fecha) VALUES (:tipo,:titulo,:contenido,:fecha)");
            $pdo->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
            $pdo->bindParam(":titulo",$datos["titulo"],PDO::PARAM_STR);
            $pdo->bindParam(":contenido",$datos["contenido"],PDO::PARAM_STR);
            $pdo->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
            
            if($pdo->execute()){
                return "Bien";
            }else{
                return "Error";
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
    static public function obtenerDatosAnuncioM($datos,$tablaBD){
        try {
            //Se hace la consulta usando limit
            $pdo = ConexionBD::cBD()->prepare("SELECT id_anuncio,tipo,titulo,contenido,fecha FROM $tablaBD WHERE id_anuncio=:id_anuncio");
            $pdo->bindParam(":id_anuncio",$datos,PDO::PARAM_INT);
            
            $pdo->execute();

            return $pdo->fetch();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    static public function editarAnuncioM($datos,$tablaBD){
        try {
            //Se hace la consulta usando limit
            $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET tipo=:tipo,titulo=:titulo,contenido=:contenido,fecha=:fecha WHERE id_anuncio=:id_anuncio");
            $pdo->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
            $pdo->bindParam(":titulo",$datos["titulo"],PDO::PARAM_STR);
            $pdo->bindParam(":contenido",$datos["contenido"],PDO::PARAM_STR);
            $pdo->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
            $pdo->bindParam(":id_anuncio",$datos["id_anuncio"],PDO::PARAM_INT);
            
            if($pdo->execute()){
                return "Bien";
            }else{
                return "Error";
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
    static public function eliminarAnuncioM($datos,$tablaBD){
        try {
            //Se hace la consulta usando limit
            $pdo = ConexionBD::cBD()->prepare("DELETE FROM $tablaBD WHERE id_anuncio=:id_anuncio");
            $pdo->bindParam(":id_anuncio",$datos["id_anuncio"],PDO::PARAM_INT);
            
            if($pdo->execute()){
                return "Bien";
            }else{
                return "Error";
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
}

?>