<?php
include_once 'App/Conexion.inc.php';
function sa($longitud){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio='';
    for ($i = 0; $i < $longitud; $i++){
        $string_aleatorio = $caracteres[rand(0, $numero_caracteres -1)];
    }
    return $string_aleatorio;
}