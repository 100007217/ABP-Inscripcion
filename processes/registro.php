<?php
include '../services/connection.php';   
    if (!isset($_POST['correo'])) {
        header ("Location: ../view/home.php");
    } else {
        $mail = $_POST['correo'];
        $evento = $_POST['id_evento'];

        try {
            //CONSEGUIR DATOS USER
            $query = "select * from tbl_usuario where correo_use='$mail'";
            $usuariobbdd = $pdo->prepare($query);
            $usuariobbdd -> execute();
            $datosuser=$usuariobbdd->fetchAll(PDO::FETCH_ASSOC);

            //GENERAR INSERTS
            $generar_inscripcion = $pdo->prepare("INSERT INTO tbl_eventos_usuarios(id_eve_fk,id_use_fk)
            VALUES ( ?, ?)");
            $generar_inscripcion->bindParam(1, $evento);
            $generar_inscripcion->bindParam(2, $datosuser[0]['id_use']);
            
            $generar_inscripcion->execute();
            //header ("Location: ../view/home.php");
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
?>