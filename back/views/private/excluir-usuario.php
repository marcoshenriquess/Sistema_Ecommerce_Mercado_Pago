
<?php


require_once('C:/xampp/htdocs/project/back/controller/usuarioController.php');
$UsuControll = new UsuarioController();
$UsuControll->ExcluirController($_POST['id']);

header("location: usuarios.php"); 
?>