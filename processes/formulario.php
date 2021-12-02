<?php
    include '../services/connection.php';   
    if (!isset($_POST['fecha_nac'])) {
        header ("Location: ../view/home.php");
    } else {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nac = $_POST['fecha_nac'];
        if ($_POST['sexo']=="") {
            $sexo = "Hombre";
        } else {
            $sexo = $_POST['sexo'];
        }
        if (!isset($_POST['telefono'])) {
            $telefono = "000000000";
        } else {
            $telefono = $_POST['telefono'];
        }
        if (!isset($_POST['dni'])) {
            $dni = "000000000";
        } else {
            $dni = $_POST['dni'];
        }
        $mail = $_POST['email'];
        $evento = $_POST['evento'];
        $tipo_user= "2";
        try {
            //INSERTAR USER EN BBDD
            $pdo->beginTransaction();
            
            $crear_user = $pdo->prepare("INSERT INTO tbl_usuario(nom_use,apellido_use,fecha_nac_use,sexo_use,num_movil_use,dni_use,correo_use,tipo_usuario_fk)
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $crear_user->bindParam(1, $nombre);
            $crear_user->bindParam(2, $apellido);
            $crear_user->bindParam(3, $fecha_nac);
            $crear_user->bindParam(4, $sexo);
            $crear_user->bindParam(5, $telefono);
            $crear_user->bindParam(6, $dni);
            $crear_user->bindParam(7, $mail);
            $crear_user->bindParam(8, $tipo_user);

            $crear_user -> execute(); 

            //OBTENER ID _USER RECIEN CREADO
            $query = "select * from tbl_usuario where correo_use='$mail'";
            $usuariobbdd = $pdo->prepare($query);
            $usuariobbdd -> execute();
            $datosuser=$usuariobbdd->fetchAll(PDO::FETCH_ASSOC);
            
            session_start();
            $_SESSION['nombre_user']=$nombre;
            $_SESSION['correo']=$mail;
            $_SESSION['id_use']=$datosuser[0]['id_use'];

            //COMPROBAR VIA PHP NO INSTARTAR CUANDO EVENTO ESTA FULL
            /*
            $query="SELECT (e.num_max_pers_eve)-(COUNT(eu.id_eve_fk)) AS 'Plazas disponibles',e.num_max_pers_eve FROM tbl_eventos_usuarios eu INNER JOIN tbl_eventos e ON e.id_eve=eu.id_eve_fk WHERE id_eve_fk = ?";
            $plazas = $pdo->prepare($query);
            $plazas -> execute();
            if ($plazas[0]['Plazas disponibles']==$plazas[0]['num_max_pers_eve']) {
                # code...
            }
            */
            //INSERTAR USER CREADO EN EL ID_EVENTO
            $inscribir_user = $pdo->prepare("INSERT INTO tbl_eventos_usuarios(id_eve_fk,id_use_fk)
            VALUES ( ?, ?)");
            
            $inscribir_user->bindParam(1, $evento);
            $inscribir_user->bindParam(2, $datosuser[0]['id_use']);

            $inscribir_user -> execute();

            //ejecutamos transaccion
            $pdo->commit();
            header ("Location: ../view/home.php");
        }
        catch (\Throwable $th) {
            //Hacemos rollback si va mal
            $pdo->rollback();
            throw $th;
        }
    }
?>