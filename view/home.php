<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css"
      rel="stylesheet" type="text/css">
    <title>Home</title>
</head>
<body>
    <header>
        <div class="" id="section1">
            <a href="#section2">Down</a>
        </div>
    </header>
        <div class="rleft">

        </div>
        <div class="row container" id="section2">
            <div class="title">
                <h1>ABP</h1>
                <a href="#section1">Up</a>  
            </div>
            <?php
                require_once "../services/connection.php";        
                //El filtro consiste en mostrar solo los eventos cuya fecha sea hoy o el futuro, ya que hacemos un mayor o igual que hoy, se crea para no mostrar eventos que ya han pasado     
                
                try {
                    $query = $pdo->prepare("SELECT id_eve, nombre_eve, img_eve, fecha_inicio_eve, fecha_fin_eve, num_max_pers_eve FROM tbl_eventos WHERE DATE(fecha_inicio_eve) >= DATE(NOW())");
                    $query->execute();
                    $datas = $query->fetchAll(PDO::FETCH_ASSOC); //Tipp de extracción de datos

                    foreach ($datas as $row) {
                        echo "<div class='eventcards'>"; //Clase de la extracción de datos, en forma de cartas
                            echo "<h1>".$row['nombre_eve']."</h1>"; 
                            echo "<img width='250' height='170' src = '../media/".$row['img_eve']."'>";
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
            </br></br>
            <div class="slider" id="section1">
                    <ul>
                        <li><img src="../media/background2.png" alt=""></a></li>
                        <li><img src="../media/background3.jpg" alt=""></li>
                        <li><img src="../media/background5.jpg" alt=""></li>
                        <li><img src="../media/background4.jpg" alt=""></li>
                    </ul>
            </div>
        </div>
    </div>
<footer>

</footer>
</body>
</html>
