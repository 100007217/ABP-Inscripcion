<?php
    session_start();
    if (!isset($_SESSION['correo'])) {
        header ("Location: ../view/home.php");
    }else{
       
    }?>
    <form action="genevento.php" method="post">
        <br><input type="text" name="nombre" > Nombre evento
        <br><input type="date" name="fecha_ini" > Fecha incio
        <br><input type="date" name="fecha_fin" > Fecha final
        <br><input type="number" name="num_max" > Numero maximo personas
        <br><input type="number" name="edad_min"> Edad minima
        <br><input type="number" name="id_barrio"> ID Barrio
        <br><input type="submit" value="Enviar">
    </form>