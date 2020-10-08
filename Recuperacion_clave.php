<?php
include_once 'Apertura.inc.php';
include_once 'App/UsersOperations.inc.php';
if (isset($_SESSION['name'])){
    header ('Location: Sesion.php');
    return;
}
if(isset($_GET['url'])){
    include_once 'App/Conexion.inc.php';
    $stmt = $pdo->prepare("SELECT id_usuario, estado, "
            . "DATE_ADD(fecha, INTERVAL 10 MINUTE) as fechaLim FROM "
            . "recuperacion WHERE urlSecret=:url");
    $stmt->execute(array( ':url' => $_GET['url']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row==FALSE){
        header ('Location: 404.php');
        return;
    }else{
        if ($row['estado']==0){
            if(isset($_POST['send'])){
                if (strlen($_POST['password'])<6){
                    $_SESSION['ErrorRecover']='La contraseña es muy corta';
                    header ('Location: Recuperacion_clave.php?url='.urlencode($_GET['url']));
                    return;
                }elseif ($_POST['password'] !== $_POST['password1']) {
                    $_SESSION['ErrorRecover']='Las contraseñas deben coincidir';
                    header ('Location: Recuperacion_clave.php?url='.urlencode($_GET['url']));
                    return;
                }elseif ($row['fechaLim'] < date("d-m-Y H:i:00",time())){
                        $_SESSION['ErrorRecover']='Tiempo expirado, debes generar otro'
                                . ' enlace para recuperar contraseña '
                                . '<a class="linked" href="Recuperacion.php">aquí</a>'
                                . '<br>'.$row.'<br>'.date("d-m-Y H:i:00",time());
                        header ('Location: Recuperacion_clave.php?url='.urlencode($_GET['url']));
                        return;
                }else{
                    $stmt = $pdo->prepare("SELECT id_usuario, email FROM usuarios "
                        . " WHERE id_usuario=:id_usuario");
                    $stmt->execute(array( ":id_usuario" => $row['id_usuario']));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $password=hash('md5', $row['email'].$_POST['password']);
                    $stmt = $pdo->prepare("UPDATE usuarios SET password=:password "
                        . "WHERE id_usuario=:id_usuario");
                    $stmt->execute(array( ":password" => $password,
                        ":id_usuario" => $row['id_usuario']));
                    $stmt->rowCount();
                    $stmt = $pdo->prepare("UPDATE recuperacion SET estado='1' "
                        . "WHERE urlSecret=:url");
                    $stmt->execute(array( ":url" => $_GET['url']));
                    $stmt->rowCount();
                    header ('Location: Clave_recuperada.php');
                    return;
                }
            }
        }else{
            header ('Location: 404.php');
            return;
        }
    }
}else{
    header ('Location: index.php');
    return;
}
?>
<div class="main">
    <div class="gap"></div>
    <div class="user">
        <form class="panel-data" method="POST" action="">
            <h2>Recuperacion de contraseña</h2>
            <?php flashMessages();?>
                <p class="input-data"><label>Nueva Contraseña:</label>
                <input class="text-input" type="password" name="password" placeholder="Contraseña"><p>
                <p class="input-data"><label>Confirmar contraseña:</label>
                <input class="text-input" type="password" name="password1" placeholder="Confirmar contraseña"><p>
            <button class="btn btn-danger btn-block btn btn-lg" type="submit" name="send">Actualizar</button>
        </form>
    </div>
    <div class="gap"></div>
</div>
<?php
include_once 'Cierre.inc.php';