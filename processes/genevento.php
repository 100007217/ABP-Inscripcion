<?php
include '../services/connection.php';   
try {
    $pdo->beginTransaction();
            //RECOGER DATOS EVENTO
            $nombre=$_POST['nombre'];
            $fecha_ini=$_POST['fecha_ini'];
            $fecha_fin=$_POST['fecha_fin'];
            $num_max=$_POST['num_max'];
            $edad_min=$_POST['edad_min'];
            $id_barrio=$_POST['id_barrio'];


            //GENERAR INSERT
            $generar_evento = $pdo->prepare("INSERT INTO tbl_eventos (nombre_eve, fecha_inicio_eve, fecha_fin_eve, num_max_pers_eve, edad_min_eve, barrio_eve_fk) VALUES (?, ?, ?, ?, ?, ?)");
            $generar_evento->bindParam(1, $nombre);
            $generar_evento->bindParam(2, $fecha_ini);
            $generar_evento->bindParam(3, $fecha_fin);
            $generar_evento->bindParam(4, $num_max);
            $generar_evento->bindParam(5, $edad_min);
            $generar_evento->bindParam(6, $id_barrio);
            
            $generar_evento->execute();
    $pdo->commit();
            header ("Location: ../view/admin.php");
} catch (\Throwable $th) {
    $pdo->rollback();
    throw $th;
}

?>