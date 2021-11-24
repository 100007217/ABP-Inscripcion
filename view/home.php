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
            echo "Bienvenido ".$_SESSION['correo'];
            ?>
            <a href="../processes/destroytest.php">
                <button>Destroy session</button>
            </a>
            <?php
        }
    ?>
    AQUI HAY MUCHOS PORYECTOS SOLIDARIOS
    @if (Session::get('nombre'))
        <p>{{Session::get('nombre')}}</p>
</body>
</html>