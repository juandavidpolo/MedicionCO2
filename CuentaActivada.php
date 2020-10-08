<?php
include_once 'App/Conexion.inc.php';
include_once 'Apertura.inc.php';
if(isset($_GET['activar'])){
    $stmt = $pdo->prepare('UPDATE cuentausuario SET estado="1" WHERE '
            . ' urlConfirmacion=:urlConfirmacion');
    $stmt->execute(array( ':urlConfirmacion' => $_GET['activar']));
}  else {
    header('Location: 404.php');
}
?>
<div class="main">
    <div class="gap"></div>
    <div class="user-narrow">
        <div class="panel-data">
            <h2>Cuenta activada</h2>
            <p>Tu cuenta ha sido activada.</p>
            <p>Para iniciar sesion haz clic <a class="linked" href="index.php">aqui</a></p>
        </div>
    </div>
    <div class="gap"></div>
</div>
<?php
include_once 'Cierre.inc.php';