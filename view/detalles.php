<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css"
      rel="stylesheet" type="text/css">
    <title>Home</title>
</head>
<body>
    <header>
        <div class="menu" id="section1">
            <nav>
                <ul>
                    <?php
                    if (!isset($_SESSION['correo'])) {
                        echo "<li><a class='opcionesMenu' href='login.php'>¿Eres voluntario?</a></li>";
                    }else{
                        echo "<li><a class='opcionesMenu' href='home.php'>Hola ".$_SESSION['nombre_user']."</a></li>";
                        echo "<li><a class='opcionesMenu' href='../processes/destroytest.php'>Logout</a></li>";
                        
                    }
                    ?>
                    
                </ul>
            </nav>
        </div>
            <a href="#section2">Down</a>
    </header>
            <?php
            $id_evento=$_GET['id_eve'];
            ?>
            <h1>Evento <?php echo $id_evento?></h1>
            <p>Detalles 1</p>
            <p>Detalles 2</p>
            <p>Detalles 3</p>

            <?php

            //COMPROBAR VIA PHP NO INSTARTAR CUANDO EVENTO ESTA FULL
            include '../services/connection.php';
            $query="SELECT (e.num_max_pers_eve)-(COUNT(eu.id_eve_fk)) AS 'Plazas disponibles',e.num_max_pers_eve,COUNT(eu.id_eve_fk) as 'cont' FROM tbl_eventos_usuarios eu INNER JOIN tbl_eventos e ON e.id_eve=eu.id_eve_fk WHERE id_eve_fk = ?";
            
            $plazas = $pdo->prepare($query);
            $plazas->bindParam(1, $id_evento);
            $plazas -> execute();
            $disp=$plazas->fetchAll(PDO::FETCH_ASSOC);

            if ($disp[0]['Plazas disponibles']==0 && isset($disp[0]['Plazas disponibles'])) {
                
                echo "El evento está lleno";
            }else {
                if (!isset($_SESSION['nombre_user'])) {
                    echo "Rellena el formulario e inscribete en el evento";
                    ?>
                    <form action="../processes/formulario.php" method="post">
                        <br><input type="text" name="nombre" required>Nombre
                        <br><input type="text" name="apellido" required>Apellido
                        <br><input type="date" name="fecha_nac" required>Fecha nacimiento
                        <br><input list="sexo" name="sexo">Sexo
                            <datalist id="sexo">
                                <option value="Hombre">
                                <option value="Mujer">
                            </datalist>
                        <br><input type="text" name="telefono">Movil
                        <br><input type="text" name="dni">DNI
                        <br><input type="text" name="email" required>Correo electronico
                        <input type="hidden" name="evento" value="<?php echo $id_evento?>">
                        <br><input type="submit" value="Registro">
                    </form>
                    <?php
                }else{
    
                    include '../services/connection.php';
                    $ver_disponible = $pdo->prepare("SELECT * FROM tbl_eventos_usuarios where (id_eve_fk=? and id_use_fk=?)");
                    $ver_disponible->bindParam(1, $id_evento);
                    $ver_disponible->bindParam(2, $_SESSION['id_use']);
                    $ver_disponible -> execute();
                    $user=$ver_disponible->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (count($user) == 0) {
                        echo $_SESSION['nombre_user']. " puedes registrarte clickando el siguiente botón";
                        ?>
                        <form action="../processes/registro.php" method="post">
                            <input type="hidden" name="id_evento" value="<?php echo $id_evento?>">
                            <input type="hidden" name="correo" value="<?php echo $_SESSION['correo']?>">
                            <input type="submit" value="Registrame por favor">
                        </form>
                    <?php
                    } else {
                        echo "Ya estas registrado";
                    }
                    
                }
            }

            
        
    ?>
</body>
</html>
