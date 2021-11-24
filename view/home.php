<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    
    <?php
        session_start();
        //$_SESSION['mail']=2;
        if (!isset($_SESSION['correo'])) {
            echo "Sesion no iniciada";
            include "login.php";
        }else{
            echo "Bienvenido ".$_SESSION['nombre_user'];
            ?>
            <a href="../processes/destroytest.php">
                <button>Destroy session</button>
            </a>
        <?php
        }
        ?>
            <br>
            <h1>EVENTO 1</h1>
            <form action="detalles.php" method="get">
                <input type="hidden" name="id_eve" value="1">
                <input type="submit" value="Ver detalles">
            </form>
</body>
</html>