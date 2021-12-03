<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <title>Detalles</title>
</head>
<body>
    <header>
        <div class="menu" id="section1">
            <nav>
                <ul>
                    <?php

                    if (!isset($_SESSION['correo'])) {
                        echo "<li><a class='opcionesMenu' href='login.php'>¿Eres voluntario?</a></li>";
                        echo "<li><a class='opcionesMenu' href='home.php'>Home</a><li>";
                    }else{
                        echo "<li><a class='opcionesMenu' href='home.php'>Home</a><li>";
                        echo "<li><a class='opcionesMenu' href='home.php'>Hola ".$_SESSION['nombre_user']."</a></li>";
                        echo "<li><a class='opcionesMenu' href='../processes/destroytest.php'>Logout</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <center>
            <form action="#section2">
                <input type="submit" value="Empecemos" id="submit">
            </form>
        </center>
    </header>
        <div class="rleft">
            <center>
                <img src="../media/ajuntament-barcelona-logo.png" alt="">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5987.206062901622!2d2.1772792693115237!3d41.38270864917479!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x23821e1275bfee57!2sAyuntamiento%20de%20Barcelona!5e0!3m2!1ses!2ses!4v1638462743217!5m2!1ses!2ses" width="280" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <p>Para obtener mucha más información de este tipo de proyectos o incluso ir a más de manera voluntaria, puedes acercarte a las ofinas centrales, en este caso nuestro ayuntamiento, en el que se te solucionarán todo tipo de dudas, y incluso fidelizarte con la asociación.</p>
            </center>
        </div>
        <div class="row container" id="section2">
            <div class="title">
                <h1>ABP</h1>
            </div>
            <div class="toptext">
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
            </div>
            <?php
                $id_evento=$_GET['id_eve'];
                include '../services/connection.php';
                $query="select * from tbl_eventos inner join tbl_barrio on tbl_eventos.barrio_eve_fk=tbl_barrio.id_bar WHERE id_eve = ?";
                
                $detalles = $pdo->prepare($query);
                $detalles->bindParam(1, $id_evento);
                $detalles -> execute();
                $disp=$detalles->fetchAll(PDO::FETCH_ASSOC);
                $foto = "../media/".$disp[0]['img_eve'];
            ?>
                <center>
                    <div class="eventcards">
                        <h1><?php echo $disp[0]['nombre_eve']?></h1>
                        <img src="<?php echo $foto?>" width='220' height='170'>
                        Fecha inicial del evento: <?php echo $disp[0]['fecha_inicio_eve']?><br>
                        Fecha final del evento: <?php echo $disp[0]['fecha_fin_eve']?><br>
                        Numero maximo de personas: <?php echo $disp[0]['num_max_pers_eve']?><br>
                        Edad minima del evento: <?php echo $disp[0]['edad_min_eve']?><br>
                        Barrio donde se hace el evento: <?php echo $disp[0]['nombre_bar']?><br>
                        Descripción del evento: <?php echo $disp[0]['descripcion_eve']?><br>
                    </div>
                        <?php

                            //COMPROBAR VIA PHP NO INSTARTAR CUANDO EVENTO ESTA FULL
                            include '../services/connection.php';
                            $query="SELECT (e.num_max_pers_eve)-(COUNT(eu.id_eve_fk)) AS 'Plazas disponibles',e.num_max_pers_eve,COUNT(eu.id_eve_fk) as 'cont' FROM tbl_eventos_usuarios eu INNER JOIN tbl_eventos e ON e.id_eve=eu.id_eve_fk WHERE id_eve_fk = ?";
                            
                            $plazas = $pdo->prepare($query);
                            $plazas->bindParam(1, $id_evento);
                            $plazas -> execute();
                            $disp=$plazas->fetchAll(PDO::FETCH_ASSOC);
                            

                            if ($disp[0]['Plazas disponibles']==0 && isset($disp[0]['Plazas disponibles'])) {
                                
                                echo "El evento está lleno";
                            }else {
                                if (!isset($_SESSION['nombre_user'])) {
                        ?>
                            <br>
                            Rellena el formulario e inscribete en el evento
                            <form action="../processes/formulario.php" method="post">
                                <br><input type="text" name="nombre" required>Nombre
                                <br><input type="text" name="apellido" required>Apellido
                                <br><input type="date" name="fecha_nac" required>Fecha nacimiento
                                <br><input list="sexo" name="sexo">Sexo
                                    <datalist id="sexo">
                                        <option value="Hombre">
                                        <option value="Mujer">
                                    </datalist>
                                <br><input type="text" name="telefono">Movil
                                <br><input type="text" name="dni">DNI
                                <br><input type="text" name="email" required>Correo electronico
                                <input type="hidden" name="evento" value="<?php echo $id_evento?>">
                                <br><input type="submit" value="Registro">
                            </form>
                        </div>
                </center>
                            <?php
                            }else{
                
                                include '../services/connection.php';
                                $ver_disponible = $pdo->prepare("SELECT * FROM tbl_eventos_usuarios where (id_eve_fk=? and id_use_fk=?)");
                                $ver_disponible->bindParam(1, $id_evento);
                                $ver_disponible->bindParam(2, $_SESSION['id_use']);
                                $ver_disponible -> execute();
                                $user=$ver_disponible->fetchAll(PDO::FETCH_ASSOC);
                                
                                if (count($user) == 0) {
                                    echo $_SESSION['nombre_user']. " puedes registrarte clickando el siguiente botón";
                                    ?>
                                    <form action="../processes/registro.php" method="post">
                                        <input type="hidden" name="id_evento" value="<?php echo $id_evento?>">
                                        <input type="hidden" name="correo" value="<?php echo $_SESSION['correo']?>">
                                        <input type="submit" value="Registrame por favor">
                                    </form>
                                <?php
                                } else {
                                    echo "Ya estas registrado";
                                }
                                
                            }
                        }
                    ?>
            <center>
                <form action="#section1">
                    <input type="submit" value="Home" id="submit2">
                </form>
            </center>
        </div>
    <footer class="row">
        <div class="foottitle">
            <h1>Encuéntranos!</h1>
        </div>
        <div class="footcol">
            <h3>Creadores</h3>
            <p>Descúbrenos</p>
            <p>¿Más interés en nosotros?</p>
            <p>Participa</p>
        </div>
        <div class="footcol">
            <h3>Desarrolladores</h3>
            <p>Love events</p>
            <p>New technologies</p>
            <p>Growing</p>
        </div>
        <div class="footcol">
            <h3>Tiempo libre</h3>
            <p>Disfrutemos juntos</p>
            <p>Barcelona</p>
        </div>
        <img src="../media/logoloveevents.png" width="300" alt="">
        <form action="#section2">
                    <input type="submit" value="Body" id="submit2">
        </form>
    </footer>
</body>
</html>