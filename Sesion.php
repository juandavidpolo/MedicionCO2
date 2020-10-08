<?php
include_once 'App/Conexion.inc.php';
include_once 'Apertura.inc.php';
if(!isset($_SESSION['id_usuario'])){
    header ('Location: index.php');
    return;
}
$stmt = $pdo->prepare("SELECT ppm, latitud, longitud, bateria,"
        . " DATE_FORMAT(fecha, '%M/%d %H:%i') as FECHA FROM equipo1");
$stmt->execute(array());
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
        <div class="main">
            <div class="gap"></div>
            <div class="data1">
                <span class="fa fa-chart-area"></span>Lectura de dispositivo
                <div class="panel-body text-center">
                    <div><?php include_once 'Plantilla/Grafica.inc.php';?></div>
                </div>
            </div>
            <div class="gap"></div>
            <div class="data2">
                <span class="fa fa-map-marker"></span>Ubicacion de dispositivo
                <div class="panel-body">
                    <?php include_once 'Plantilla/Map.inc.php';?>
                </div>
            </div>
            <div class="gap"></div>
            <div class="data3">
                <span></span>Bateria del dispositivo remoto
                <div class="panel-body">
                    <?php include_once 'Plantilla/Batterybar.inc.php';?>
                </div>
            </div>
            <div class="gap"></div>
        </div>
<?php
include_once 'Cierre.inc.php';