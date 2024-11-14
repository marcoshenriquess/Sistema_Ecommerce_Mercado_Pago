
<?php

require_once("../../models/permissao.php");

Verificar_Permissão_Pag();

require_once('C:/xampp/htdocs/project/controller/usuarioController.php');
$UsuControll = new UsuarioController();
$UsuControll->ExcluirController($_POST['id']);

header("location: usuarios.php"); 
?>