<?php 
include_once 'App/Conexion.inc.php';
$ppm=$_GET['ppm'];
$latitud=$_GET['lat'];
$longitud=$_GET['lon'];
$bateria=$_GET['bat'];

$stmt = $pdo->prepare('INSERT INTO equipo1 (ppm, latitud, longitud, bateria, fecha)'
        . 'VALUES(:ppm, :latitud, :longitud, :bateria, now())');
$stmt->execute([
    ':ppm'=>$ppm, 
    ':latitud'=>$latitud, 
    ':longitud'=>$longitud, 
    ':bateria'=>$bateria]);
if($ppm > 500){
    $stmt = $pdo->prepare('SELECT ppm FROM equipo1 WHERE id_measurement BETWEEN'
            . ' ((SELECT COUNT(*) FROM equipo1)-5) AND ((SELECT COUNT(*) FROM equipo1)-1)');
    $stmt->execute(array());
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $a=0;
    foreach ($row as $limit){
        if ($limit['ppm'] > 500){
            $a++;}
    }
    if ($a==0 || $a==5){
        $stmt = $pdo->prepare('SELECT email FROM usuarios');
        $stmt->execute(array());
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        foreach ($row as $result){
            include_once 'Scripts/EmailAlerta.inc.php';
        }
    }
}

?> 

