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
            $id_evento=$_GET['id_eve'];
            ?>
            <h1>Evento <?php echo $id_evento?></h1>
            <p>Detalles 1</p>
            <p>Detalles 2</p>
            <p>Detalles 3</p>

            <?php
            session_start();
            if (!isset($_SESSION['nombre_user'])) {
                # code...
            }


        }
        

    ?>
</body>
</html>
