<?php
include '../services/connection.php';
$mail = $_POST['email'];

try {
    $query = "select correo_use,nom_use,id_use,tipo_usuario_fk from tbl_usuario";
    $usuariosbbdd = $pdo->prepare($query);
    $usuariosbbdd -> execute();
    $login_success=0;
    session_start();
    foreach ($usuariosbbdd as $userbbdd) {
        if ($userbbdd['correo_use']==$mail){
            $_SESSION['nombre_user']=$userbbdd['nom_use'];
            $_SESSION['correo']=$mail;
            $_SESSION['id_use']=$userbbdd['id_use'];
            $login_success=1;
            break;
        }
    }
    if ($login_success==1) {
        if ($userbbdd['tipo_usuario_fk']==1) {
            echo $userbbdd['tipo_usuario_fk'];
            header ("Location: ../view/admin.php");
        }else{
            echo $userbbdd['tipo_usuario_fk'];
            header ("Location: ../view/home.php");
        }
        
    }else{
        header ("Location: ../view/home.php");
    }
} catch (\Throwable $th) {
    //throw $th;
}
