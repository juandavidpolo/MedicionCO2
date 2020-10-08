<?php
include_once 'App/Conexion.inc.php';
include_once 'App/UsersOperations.inc.php';
include_once 'Scripts/recuperacionURL.inc.php';
include_once 'Apertura.inc.php';
if (isset($_SESSION['name'])){
    header ('Location: Sesion.php');
    return;
}elseif (isset($_POST['cancel'])){
    header ('Location: index.php');
    return;
}elseif (isset($_POST['recover'])){
    $email = $_POST['email'];
    $stmt = $pdo->prepare('SELECT id_usuario FROM usuarios WHERE email=:email');
    $stmt->execute(array( ":email" => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row['id_usuario'] == TRUE){
        $string_aleatorio = sa(15);
        $url=hash('sha256',$string_aleatorio.$email);
        $stmt = $pdo->prepare('INSERT INTO recuperacion (id_usuario, '
                . 'urlSecret, estado, fecha) VALUES (:id_usuario, '
                . ':urlSecret, "0", now())');
        $stmt->execute([
            ':id_usuario'=>$row['id_usuario'],
            ':urlSecret'=>$url
        ]);
        include_once 'Scripts/EmailRecuperacion.inc.php';
        header('Location: Recuperacion_enviado.php');
        return;
    }else{
        $_SESSION['ErrorRecover']='El email escrito no existe en nuestros registros';
        header('Location: Recuperacion.php');
        return;
    }
}
?>
<div class="main">
    <div class="gap"></div>
    <div class="user user-narrow">
        <form class="panel-data" method="POST" autocomplete="off">
            <h2>Recuperar acceso</h2>
            <?php flashMessages(); ?>
            <p>Ingresa tu correo electrónico para recuperar tu contraseña.</p>
            <p class="input-data"><label for="email">Email:</label>
            <input class="text-input" type="text" name="email" placeholder="Correo Electrónico"><p>
            <button type="submit" name="recover">Enviar</button>
            <button type="submit" name="cancel">Cancelar</button>
        </form> 
    </div>
    <div class="gap"></div>
</div>
<?php
include_once 'Cierre.inc.php';