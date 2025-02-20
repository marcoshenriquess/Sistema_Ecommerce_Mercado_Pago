<?php

define("BASE_URL", "http://" . $_SERVER['HTTP_HOST'] . "/project");

$URL_ATUAL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// echo $URL_ATUAL;


$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

session_start();

$isLogRota = $pathInfo === '/login';
$isindRota = $pathInfo === './index.php';

if (!array_key_exists('logado', $_SESSION) && !$isindRota) {
   header('Location: ../login.php');
}

if (($_SESSION['tipo_user'] == 3) && !$isindRota) {
   header('Location: ../index.php');
   exit();
}


function Verificar_Permissão_Pag()
{ // PARA PAG ADM
   if ($_SESSION['tipo_user'] == 3) {
      header('Location: ./index.php');
   }
}
