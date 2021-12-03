<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <link rel="stylesheet" href="../css/admin.css">
  




    <title>Admin</title>
</head>
<body>
<center>
<?php
    session_start();
    if (!isset($_SESSION['correo'])) {
        header ("Location: ../view/home.php");
    }else{
        echo "Bienvenido ".$_SESSION['nombre_user'];
    }?>
    <a href="../processes/destroytest.php">
                <button>Logout</button>
    </a>
    <?php
    include '../services/connection.php'; 
    //Inicio query users
    $query = "select * from tbl_usuario where tipo_usuario_fk=2";
            $usuariobbdd = $pdo->prepare($query);
            $usuariobbdd -> execute();
            $datosuser=$usuariobbdd->fetchAll(PDO::FETCH_ASSOC);
    //Listado users no admin
    ?>
    <h1>USUARIOS</h1>
    <table>
        <tr>
            <th>Nombre user
            <th>Apellido user
            <th>Fecha nacimiento user
            <th>Sexo user
            <th>Numero movil user
            <th>DNI user
            <th>Correo user
            <th>Modificar user
        </tr>
    <?php
    foreach ($datosuser as $user) {
        echo "<tr>";
            echo "<td>".$user['nom_use']."</td>";
            echo "<td>".$user['apellido_use']."</td>";
            echo "<td>".$user['fecha_nac_use']."</td>";
            echo "<td>".$user['sexo_use']."</td>";
            echo "<td>".$user['num_movil_use']."</td>";
            echo "<td>".$user['dni_use']."</td>";
            echo "<td>".$user['correo_use']."</td>";
            echo "<td class='mod'><a href='../processes/moduserform.php?id={$user['id_use']}'>Modificar usuario</td>";
        echo "</tr>";
    }
    echo "</table>";
    //Query de eventos
    $query = "select * from tbl_eventos inner join tbl_barrio on tbl_eventos.barrio_eve_fk=tbl_barrio.id_bar";
            $eventosbbddd = $pdo->prepare($query);
            $eventosbbddd -> execute();
            $eventos=$eventosbbddd->fetchAll(PDO::FETCH_ASSOC);
    //Listado eventos
    ?>
    <h1>EVENTOS</h1>
    
    <table>
    <tr>
        <td class='gen' colspan="8" align="center" ><a href='../processes/generarform.php'>Generar evento</td>
    </tr>
        <tr>
            <th>Nombre evento
            <th>Fecha inicio evento
            <th>Fecha final evento
            <th>Numero max personas evento
            <th>Edad minima
            <th>Barrio
            <th>Modificar evento
            <th>Eliminar evento
        </tr>
    <?php
    foreach ($eventos as $evento) {
        echo "<tr>";
            echo "<td>".$evento['nombre_eve']."</td>";
            echo "<td>".$evento['fecha_inicio_eve']."</td>";
            echo "<td>".$evento['fecha_fin_eve']."</td>";
            echo "<td>".$evento['num_max_pers_eve']."</td>";
            echo "<td>".$evento['edad_min_eve']."</td>";
            echo "<td>".$evento['nombre_bar']."</td>";
            echo "<td class='mod'><a href='../processes/modeventoform.php?id={$evento['id_eve']}'>Modificar evento</td>";
            echo "<td class='del'><a href='../processes/deleteevento.php?id={$evento['id_eve']}'>Borrar evento</td>";
        echo "</tr>";
    }
    echo "</table>";
?>