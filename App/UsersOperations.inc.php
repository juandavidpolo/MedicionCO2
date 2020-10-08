<?php
ob_start();
include_once 'App/Conexion.inc.php';
function flashMessages(){
    if(isset($_SESSION['ErrorRegister'])){
        echo html_entity_decode($_SESSION['ErrorRegister']);
        unset($_SESSION['ErrorRegister']);
    }elseif(isset($_SESSION['ErrorEmail'])){
        echo html_entity_decode($_SESSION['ErrorEmail']);
        unset($_SESSION['ErrorEmail']);
    }elseif(isset($_SESSION['ErrorPassword'])){
        echo html_entity_decode($_SESSION['ErrorPassword']);
        unset($_SESSION['ErrorPassword']);
    }elseif(isset($_SESSION['Edited'])){
        echo html_entity_decode($_SESSION['Edited']);
        unset($_SESSION['Edited']);
    }elseif(isset($_SESSION['ErrorLogin'])){
        echo html_entity_decode($_SESSION['ErrorLogin']);
        unset($_SESSION['ErrorLogin']);
    }elseif(isset($_SESSION['ErrorRecover'])){
        echo html_entity_decode($_SESSION['ErrorRecover']);
        unset($_SESSION['ErrorRecover']);
    }
}