<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de evento</title>
</head>
<body>
    <?php
        if (!isset($_GET['id_eve'])) {
            header ("Location: ../view/home.php");
        } else {
            
        session_start();
        if (!isset($_SESSION['correo'])) {
            echo "Sesion no iniciada";
            include "login.php";
        }else{
            echo "Bienvenido ".$_SESSION['nombre_user'];
            ?>
            <a href="../processes/destroytest.php">
                <button>Logout</button>
            </a>
            <?php
        }

            $id_evento=$_GET['id_eve'];
            ?>
            <h1>Evento <?php echo $id_evento?></h1>
            <p>Detalles 1</p>
            <p>Detalles 2</p>
            <p>Detalles 3</p>

            <?php
            if (!isset($_SESSION['nombre_user'])) {
                echo "Rellena el formulario e inscribete en el evento";
                ?>
                <form action="../processes/formulario.php" method="post">
                    <br><input type="text" name="nombre">Nombre
                    <br><input type="text" name="apellido">Apellido
                    <br><input type="date" name="fecha_nac">Fecha nacimiento
                    <br><input list="sexo" name="sexo">Sexo
                        <datalist id="sexo">
                            <option value="Hombre">
                            <option value="Mujer">
                        </datalist>
                    <br><input type="text" name="telefono">Movil
                    <br><input type="text" name="dni">DNI
                    <br><input type="text" name="email">Correo electronico
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
                    echo $_SESSION['nombre_user']. " puedes registrarte clickando el seiguiente botón";
                    ?>
                    <form action="../processes/registro.php" method="post">
                        <input type="hidden" name="id_evento" value="<?php echo $id_evento?>">
                        <input type="hidden" name="correo" value="<?php echo $_SESSION['correo']?>">
                        <input type="submit" value="Registrame sisuplau">
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
