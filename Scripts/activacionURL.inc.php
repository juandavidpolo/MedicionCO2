<?php
include_once '../App/Conexion.inc.php';
session_start();
function sa($longitud){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio='';
    for ($i = 0; $i < $longitud; $i++){
        $string_aleatorio = $caracteres[rand(0, $numero_caracteres -1)];
    }
    return $string_aleatorio;
}
if (isset($_SESSION['added'])){
    $email = $_SESSION['added'];
    $stmt = $pdo->prepare('SELECT id_usuario FROM usuarios WHERE email=:email');
    $stmt->execute(array( ":email" => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['id_usuario'] == TRUE){
        $string_aleatorio = sa(15);
        $url=hash('sha256',$string_aleatorio.$email);
        $stmt = $pdo->prepare('INSERT INTO cuentausuario (id_usuario, '
                . 'urlConfirmacion, estado) VALUES (:id_usuario, '
                . ':urlConfirmacion, 0)');
        $stmt->execute([
            ':id_usuario'=>$row['id_usuario'],
            ':urlConfirmacion'=>$url
        ]);
        include_once 'EmailCreada.inc.php';
        header('Location: ../Registro_correcto.php');
        return;
        }
}else{
    $_SESSION['ErrorRegister']='Oops! Tenemos un problema. Intenta nuevamente'
            . ' en un momento';
    header ('Location: ../Recuperacion.php');
    return;
}