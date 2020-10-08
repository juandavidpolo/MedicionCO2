<?php
include_once 'Apertura.inc.php';
?>
<div class="main">
    <div class="gap"></div>
    <div class="user user-narrow">
        <div class="panel-data">
            <div><span class="glyphicon glyphicon-ok-circle"></span>Registro correcto</div>
            <p>¡Bienvenido!</p>
            <p>Se ha enviado un correo electronico a 
                <b><?php if(isset($_SESSION['added'])){
                    echo $_SESSION['added'];
                    session_destroy();
                }else{header('Location: index.php');}?></b> para realizar la activación de tu cuenta.</p>
        </div>
    </div>
    <div class="gap"></div>
</div>
<?php
include_once 'Cierre.inc.php';