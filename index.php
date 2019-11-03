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

$documentos = new Documentos($pdo);
$lista = $documentos->getDocumentos();
?>
<h1>Sistema</h1>
<?php if ($usuarios->temPermissao('ADD')) { ?>
    <a href="">Adicionar Documento</a><br/><br/>
<?php } ?>
<?php if ($usuarios->temPermissao('SECRET')) { ?>
    <a href="secreto.php">Página Secreta</a>
<?php } ?>
<table border='1' width='50%'>
    <tr>
        <th>Nome do Arquivo</th>
        <th>Ações</th>
    </tr>
    <?php
    foreach ($lista as $item) {
        ?>
        <tr>
            <td><?php echo $item['titulo']; ?></td>
            <td>
                <?php if ($usuarios->temPermissao('EDIT')) { ?>
                    <a href="">[ EDITAR ]</a>
                <?php } ?>
                <?php if ($usuarios->temPermissao('DEL')) { ?>    
                    <a href="">[ EXCLUIR ]</a>
                <?php } ?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>