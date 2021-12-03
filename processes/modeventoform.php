<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fomrulario evento</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="../css/forms.css">
</head>
<body>
<div class="banner"></div>
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
            <br>Nombre evento<input type="text" name="nombre" value="<?php echo $eventos[0]['nombre_eve']?>">
            <br>Fecha incio<input type="date" name="fecha_ini" value="<?php echo $eventos[0]['fecha_inicio_eve']?>">
            <br>Fecha final<input type="date" name="fecha_fin" value="<?php echo $eventos[0]['fecha_fin_eve']?>">
            <br>Numero maximo personas<input type="number" name="num_max" value="<?php echo $eventos[0]['num_max_pers_eve']?>"> 
            <br>Edad minima<input type="number" name="edad_min" value="<?php echo $eventos[0]['edad_min_eve']?>"> 
            <br><input type="submit" value="Enviar">
        </form>
    <?php
    }
?>