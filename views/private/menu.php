<?php
include_once("../../models/permissao.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../public/css/sb-admin-2.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="../login.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Loja Esportiva</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
    <i class="fas fa-chart-line"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link" href="produtos.php">
    <i class="fas fa-boxes"></i>
        <span>Produtos</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="venda.php">
    <i class="fas fa-money-bill-wave"></i>
        <span>Vendas</span></a>
</li>

<?php

if($_SESSION['tipo_user'] == 1){

?>
<li class="nav-item">
    <a class="nav-link" href="usuarios.php">
    <i class="fas fa-users"></i>
        <span>Usuarios</span></a>
</li>
<?php

}else{

?>

<hr/>

<?php

}

?>
<!-- Divider --> 

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
   
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
   
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>