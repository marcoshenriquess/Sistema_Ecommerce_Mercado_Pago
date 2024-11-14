<?php

define("BASE_URL", "http://".$_SERVER['HTTP_HOST']."/project");



$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

session_start();

$isLogRota = $pathInfo === '/login';
$isindRota = $pathInfo === './index.php';

if (!array_key_exists('logado', $_SESSION) && !$isindRota) {
   header('Location: ../login.php');
}

if (($_SESSION['tipo_user'] == 3) && !$isindRota){
     header('Location: ../index.php');exit();
} 


function Verificar_Permissão_Pag(){
   if($_SESSION['tipo_user'] == 2){
      header('Location: ./index.php');
   }
}
?> 