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
    
<?php
    session_start();
    if (!isset($_SESSION['correo'])) {
        header ("Location: ../view/home.php");
    }else{
       
    }?>
    <div class="banner"></div>
    <form action="genevento.php" method="post">
        <br> Nombre evento<input type="text" required name="nombre" >
        <br> Fecha incio<input type="date" required name="fecha_ini" >
        <br> Fecha final<input type="date" required name="fecha_fin" >
        <br>Numero maximo personas<input type="number" required name="num_max" > 
        <br>Edad minima<input type="number" required name="edad_min"> 
        <br>ID Barrio<input type="number" required name="id_barrio"> 
        <br><input type="submit" value="Enviar">
    </form>