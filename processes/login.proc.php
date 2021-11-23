<?php
include '../services/connection.php';
$mail = $_POST['email'];
$pass = $_POST['password'];

try {
    $query = "select correo_usuario,password_usuario from tbl_usuario";
    $usuariosbbdd = $pdo->prepare($query);
    $usuariosbbdd -> execute();
    $login_success=0;
    session_start();
    foreach ($usuariosbbdd as $userbbdd) {
        if ($userbbdd['correo_usuario']==$mail && $userbbdd['password_usuario']==$pass){
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
