<?php
header($_SERVER['SERVER_PROTOCOL'].'404 NOT FOUND', true, 404);
include_once 'Apertura.inc.php';
?>

<div class="main">
    <div class="gap"></div>
    <div class="user-narrow">
        <div class="panel-data">
            <span class="glyphicon glyphicon-ban-circle"></span>ERROR 404
            <p>La pagina a la que intentas entrar no existe</p>
        </div>
    </div>
    <div class="gap"></div>
</div>
<?php
include_once 'Cierre.inc.php';