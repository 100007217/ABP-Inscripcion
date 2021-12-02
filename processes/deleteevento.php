<?php

    if (!isset($_GET['id'])) {
        header ("Location: ../view/home.php");
    }else{
        include '../services/connection.php';  
        echo $_GET['id'];
        $evento = $_GET['id'];
        try {
            $query = "delete from tbl_eventos where id_eve='$evento'";
            $deleteevento = $pdo->prepare($query);
            $deleteevento -> execute();
            header ("Location: ../view/admin.php");
        } catch (\Throwable $th) {
            throw $th;
        }
        
        

    }
?>