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
    <title>Home</title>
</head>
<body>
    <header>
        <div class="menu" id="section1">
            <nav>
                <ul>
                  <?php 
                    if (!isset($_SESSION['correo'])) {
                        echo "<li><a class='opcionesMenu' href='login.php'>¿Eres voluntario?</a></li>";
                    }else{
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
                require_once "../services/connection.php";        
                //El filtro consiste en mostrar solo los eventos cuya fecha sea hoy o el futuro, ya que hacemos un mayor o igual que hoy, se crea para no mostrar eventos que ya han pasado     
                
                try {
                    $query = $pdo->prepare("SELECT id_eve, nombre_eve, img_eve, fecha_inicio_eve, fecha_fin_eve, num_max_pers_eve FROM tbl_eventos WHERE DATE(fecha_inicio_eve) >= DATE(NOW())");
                    $query->execute();
                    $datas = $query->fetchAll(PDO::FETCH_ASSOC); //Tipo de extracción de datos

                    foreach ($datas as $row) {
                        echo "<div class='eventcards'>"; //Clase de la extracción de datos, en forma de cartas
                            echo "<h1>".$row['nombre_eve']."</h1>"; 
                            echo "<img width='220' height='170' src = '../media/".$row['img_eve']."'>";
                            echo "<p>"."Evento: ".$row['fecha_inicio_eve']."</p>";
                            echo "<p>"."Fin del evento: ".$row['fecha_fin_eve']."</p>";
                            echo "<p>"."Cantidad máxima de voluntarios: ".$row['num_max_pers_eve']."</p>";
                                $queryCantVol = $pdo->prepare("SELECT (e.num_max_pers_eve)-(COUNT(eu.id_eve_fk)) AS 'Plazas disponibles'
                                FROM tbl_eventos_usuarios eu 
                                INNER JOIN tbl_eventos e ON e.id_eve=eu.id_eve_fk 
                                WHERE id_eve_fk = ?");
                                $queryCantVol->bindParam(1, $row['id_eve']);
                                $queryCantVol->execute();
                                $datasCantVol = $queryCantVol->fetchAll(PDO::FETCH_ASSOC);
                            echo "<p>"."Cantidad actual de plazas: ".$datasCantVol[0]['Plazas disponibles']."</p>";
                            echo "<a href='detalles.php?id_eve=".$row['id_eve']."'>Cuéntame más</a>"; //Obtenemos el id de la base de datos, y lo pasamos por la url
                        echo "</div>";
                    }
                } catch (\Throwable $th) { //En caso de error te devolverá el error exacto
                    throw $th;
                }
            ?>
            <div class="belowtxt">
                <p>
                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                </p>
            </div>
            <div class="slider" id="section1">
                    <ul>
                        <li><img src="../media/background2.png" alt=""></li>
                        <li><img src="../media/background3.jpg" alt=""></li>
                        <li><img src="../media/background5.jpg" alt=""></li>
                        <li><img src="../media/background4.jpg" alt=""></li>
                    </ul>
            </div>
            <br>
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