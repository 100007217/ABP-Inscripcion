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
        foreach ($eventos as $evento) {
            print_r($evento);
        }
        ?>
        <form action="modevento.php" method="post">
            <input type="hidden" name="id_evento" value="<?php echo $id_evento?>">
            <br><input type="text" name="nombre">Nombre evento
            <br><input type="date" name="fecha_ini" value=21-01-03>Fecha incio
            <br><input type="date" name="fecha_fin">Fecha final
            <br><input type="number" name="num_max"> Numero maximo personas
            <br><input type="number" name="edad_min"> Edad minima
            <br><input type="submit" value="Enviar">
        </form>
    <?php
    }
?>