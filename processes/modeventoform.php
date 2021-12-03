<?php

    if (!isset($_GET['id'])) {
        header ("Location: ../view/home.php");
    }else{
        include '../services/connection.php';  
        $id_evento = $_GET['id'];
        try {
            $query = "select * from tbl_eventos where id_eve='$id_evento'";
            $verevento = $pdo->prepare($query);
            $verevento -> execute();
            $eventos=$verevento->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            throw $th;
        }
        ?>
        <form action="modevento.php" method="post">
            <input type="hidden" name="id_evento" value="<?php echo $id_evento?>">
            <br><input type="text" name="nombre" value="<?php echo $eventos[0]['nombre_eve']?>">Nombre evento
            <br><input type="date" name="fecha_ini" value="<?php echo $eventos[0]['fecha_inicio_eve']?>">Fecha incio
            <br><input type="date" name="fecha_fin" value="<?php echo $eventos[0]['fecha_fin_eve']?>">Fecha final
            <br><input type="number" name="num_max" value="<?php echo $eventos[0]['num_max_pers_eve']?>"> Numero maximo personas
            <br><input type="number" name="edad_min" value="<?php echo $eventos[0]['edad_min_eve']?>"> Edad minima
            <br><input type="submit" value="Enviar">
        </form>
    <?php
    }
?>