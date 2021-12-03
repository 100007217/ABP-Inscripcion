<?php

    if (isset($_POST['id_use'])) {
        $id_use =$_POST['id_use'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $fecha_nac=$_POST['fecha_nac'];
        $sexo=$_POST['sexo'];
        $telefono=$_POST['telefono'];
        $email=$_POST['email'];

        include '../services/connection.php';  
        try {
            $query = "update tbl_usuario set nom_use='$nombre',apellido_use='$apellido',fecha_nac_use='$fecha_nac',
            sexo_use='$sexo',num_movil_use='$telefono',correo_use='$email' where id_use='$id_use'";
            $update = $pdo->prepare($query);
            $update -> execute();
            header ("Location: ../view/admin.php");
        } catch (\Throwable $th) {
            throw $th;
        }
    }