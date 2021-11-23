<?php
include '../services/connection.php';
$mail = $_POST['email'];
$pass = $_POST['password'];

try {
    $query = "select correo_usuario,password_usuario from tbl_usuario";
    $usuariosbbdd = $pdo->prepare($query);
    $usuariosbbdd -> execute();
    foreach ($usuariosbbdd as $userbbdd) {
        if ($userbbdd['correo_usuario']==$mail && $userbbdd['password_usuario']==$pass){
            header ("Location: view/home.php");
        }
    }
} catch (\Throwable $th) {
    //throw $th;
}
