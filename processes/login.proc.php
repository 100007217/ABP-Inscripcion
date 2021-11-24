<?php
include '../services/connection.php';
$mail = $_POST['email'];

try {
    $query = "select correo_use,nom_use from tbl_usuario";
    $usuariosbbdd = $pdo->prepare($query);
    $usuariosbbdd -> execute();
    $login_success=0;
    session_start();
    foreach ($usuariosbbdd as $userbbdd) {
        if ($userbbdd['correo_use']==$mail){
            $_SESSION['nombre_user']=$userbbdd['nom_use'];
            $_SESSION['correo']=$mail;
            $login_success=1;
        }
    }
    if ($login_success==1) {
        header ("Location: ../view/home.php");
    }else{
        header ("Location: ../view/login.php");
    }
} catch (\Throwable $th) {
    //throw $th;
}
