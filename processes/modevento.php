<?php

    if (isset($_POST['id_evento'])) {
        $id_evento =$_POST['id_evento'];
        $nombre=$_POST['nombre'];
        $fecha_ini=$_POST['fecha_ini'];
        $fecha_fin=$_POST['fecha_fin'];
        $num_max=$_POST['num_max'];
        $edad_min=$_POST['edad_min'];

        include '../services/connection.php';  
        try {
            $query = "update tbl_eventos set nombre_eve='$nombre',fecha_inicio_eve='$fecha_ini',fecha_fin_eve='$fecha_fin',num_max_pers_eve='$num_max',edad_min_eve='$edad_min' where id_eve='$id_evento'";
            $update = $pdo->prepare($query);
            $update -> execute();
            header ("Location: ../view/admin.php");
        } catch (\Throwable $th) {
            throw $th;
        }
    }