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
        foreach ($users as $user) {
            print_r($user);
        }
        ?>
        <form action="moduser.php" method="post">
            <input type="hidden" name="id_use" value="<?php echo $id_user?>">
            <br><input type="text" name="nombre">Nombre persona
            <br><input type="text" name="apellido">Apellido persona
            <br><input type="date" name="fecha_nac">Fecha nacimiento
            <br><input list="sexo" name="sexo">Sexo
                        <datalist id="sexo">
                            <option value="Hombre">
                            <option value="Mujer">
                        </datalist>
            <br><input type="text" name="telefono">Movil
            <br><input type="text" name="email">Correo electronico
            <br><input type="submit" value="Enviar">
        </form>
    <?php
    }
?>