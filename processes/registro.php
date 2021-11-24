<?php
include '../services/connection.php';   
    if (!isset($_POST['correo'])) {
        header ("Location: ../view/home.php");
    } else {
        $mail = $_POST['correo'];
        echo $mail;

        try {
            $query = "select correo_use,nom_use from tbl_usuario";
            $usuariosbbdd = $pdo->prepare($query);
            $usuariosbbdd -> execute();
            $usuario_registrado = 0;

            foreach ($usuariosbbdd as $userbbdd) {
                if ($userbbdd['correo_use']==$mail){
                    $usuario_registrado=1;
                }
            }

            if ($usuario_registrado==1) {
                header ("Location: ../view/home.php");
            }else{
                header ("Location: ../view/login.php");
            }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    
?>