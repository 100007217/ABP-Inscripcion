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
            <br><input type="text" name="nombre" value="<?php echo $users[0]['nom_use']?>">Nombre persona
            <br><input type="text" name="apellido" value="<?php echo $users[0]['apellido_use']?>">Apellido persona
            <br><input type="date" name="fecha_nac" value="<?php echo $users[0]['fecha_nac_use']?>">Fecha nacimiento
            <br><input list="sexo" name="sexo" value="<?php echo $users[0]['sexo_use']?>">Sexo
                        <datalist id="sexo">
                            <option value="Hombre">
                            <option value="Mujer">
                        </datalist>
            <br><input type="text" name="telefono" value="<?php echo $users[0]['num_movil_use']?>">Movil
            <br><input type="text" name="email" value="<?php echo $users[0]['correo_use']?>">Correo electronico
            <br><input type="submit" value="Enviar">
        </form>
    <?php
    }
?>