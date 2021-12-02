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
    <h1>USUARIOS
    <table>
        <tr>
            <th>Nombre user
            <th>Apellido user
            <th>Fecha nacimiento user
            <th>Sexo user
            <th>Numero movil user
            <th>DNI user
            <th>Correo user
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
            echo "<td><a href='../processes/moduserform.php?id={$user['id_use']}'>Modificar usuario</td>";
        echo "</tr>";
    }
    echo "</table>";
    //Query de eventos
    $query = "select * from tbl_eventos";
            $eventosbbddd = $pdo->prepare($query);
            $eventosbbddd -> execute();
            $eventos=$eventosbbddd->fetchAll(PDO::FETCH_ASSOC);
    //Listado eventos
    ?>
    <h1>EVENTOS
    <table>
        <tr>
            <th>Nombre evento
            <th>Fecha inicio evento
            <th>Fecha final evento
            <th>Sexo evento
            <th>Numero max personas evento
            <th>Edad minima
        </tr>
    <?php
    foreach ($eventos as $evento) {
        echo "<tr>";
            echo "<td>".$evento['nombre_eve']."</td>";
            echo "<td>".$evento['fecha_inicio_eve']."</td>";
            echo "<td>".$evento['fecha_fin_eve']."</td>";
            echo "<td>".$evento['num_max_pers_eve']."</td>";
            echo "<td>".$evento['edad_min_eve']."</td>";
            echo "<td><a href='../processes/modeventoform.php?id={$evento['id_eve']}'>Modificar evento</td>";
            echo "<td><a href='../processes/deleteevento.php?id={$evento['id_eve']}'>Borrar evento</td>";
        echo "</tr>";
    }
    echo "</table>";
?>