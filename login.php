<?php
session_start();
require './config.php';
require 'classes/usuarios.class.php';
if (!empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));
    $usuarios = new Usuarios($pdo);
    if($usuarios->fazerLogin($email, $senha)){
        header("Location: ./");
        exit;
    }else{
        echo "<p>Usuários e/ou senha errados!</p>";
    }
}

if (!empty($_SESSION['logado'])) {
    header("Location: ./");
}
?>
<form method="POST">
    Email:<br/>
    <input type="email" name="email" required/><br/><br/>
    Senha:<br/>
    <input type="password" name="senha" required/><br/><br/>
    <input type="submit" value="Entrar"/>
</form>
