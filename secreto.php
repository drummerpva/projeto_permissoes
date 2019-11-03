<?php
session_start();
require './config.php';
require './classes/usuarios.class.php';
require './classes/documentos.class.php';
if (empty($_SESSION['logado'])) {
    header("Location: login.php");
    die();
}
$usuarios = new Usuarios($pdo);
$usuarios->setUsuarios($_SESSION['logado']);
if(!$usuarios->temPermissao('SECRET')){
    header("Location: ./");
}
?>

<h1>Página Secreta</h1>