<?php
session_start();
if (isset($_SESSION['name'])){
    unset($_SESSION['id_usuario']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    session_destroy();
    header('Location: index.php');
    return;
}
