<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>CO2measure</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Muli|Open+Sans|PT+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="Estilos/Estilo.css" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <nav class="topnav" id="myTopnav">
            <a href="index.php" title="Inicio" class="mytittle mybutton">Medición CO2</a>
            <a href="Info.php" title="Información" class="mybutton">Info</a>
            <?php
            if(isset($_SESSION['email'])){
                echo html_entity_decode('<a href="Usuario.php" title="Usuario" class="mybutton">Usuario</a>');
                echo html_entity_decode('<a href="Logout.php" title="Cerrar Sesión" class="mybutton">Cerrar sesión</a>');
            }
            ?>
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
        </nav>