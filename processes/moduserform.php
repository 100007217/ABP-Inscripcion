<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fomrulario user</title>
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
        $id_user = $_GET['id'];
        try {
            $query = "select * from tbl_usuario where id_use='$id_user'";
            $veruser = $pdo->prepare($query);
            $veruser -> execute();
            $users=$veruser->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            throw $th;
        }
        ?>
        <form action="moduser.php" method="post">
            <input type="hidden" name="id_use" value="<?php echo $id_user?>">
            <br>Nombre persona<input type="text" name="nombre" value="<?php echo $users[0]['nom_use']?>">
            <br>Apellido persona<input type="text" name="apellido" value="<?php echo $users[0]['apellido_use']?>">
            <br>Fecha nacimiento<input type="date" name="fecha_nac" value="<?php echo $users[0]['fecha_nac_use']?>">
            <br>Sexo<input list="sexo" name="sexo" value="<?php echo $users[0]['sexo_use']?>">
                        <datalist id="sexo">
                            <option value="Hombre">
                            <option value="Mujer">
                        </datalist>
            <br>Movil<input type="text" name="telefono" value="<?php echo $users[0]['num_movil_use']?>">
            <br>Correo electronico<input type="text" name="email" value="<?php echo $users[0]['correo_use']?>">
            <br><input type="submit" value="Enviar">
        </form>
    <?php
    }
?>