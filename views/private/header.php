<?php

include_once('C:/xampp/htdocs/project/models/permissao.php');

require_once('../../controller/TipoUsuarioController.php');
require_once('../../controller/logoutController.php');

$AuxTipoUser = new TipoUserControll();
$TipoUsuario = $AuxTipoUser->ObeterTipoUser($_SESSION['tipo_user']);
if (isset($_REQUEST['sair'])) {
    // ***IMPLEMENTAR VERIFICAÇÃO DE SESSÕES DE PROCEDIMENTOS FUTUROS

    //REGISTRAR LOG

    //DESTRUIR SESSÕES
    session_destroy();
}
?>

<style>
    .margin-top {
        margin-top: 15px !important;
    }
</style>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Olá<b> <?= $_SESSION['usuario_logado']['usu_nome'] ?></b></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Sair
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- Modal de Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmar Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja sair?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button name="sair" id="sair" type="button" class="btn btn-primary" onclick="window.location.href = '<?php echo BASE_URL ?>/logout.php';">Sair</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="../../public/vendor/jquery/jquery.min.js"></script>
<script src="../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../../public/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../../public/js/demo/chart-area-demo.js"></script>
<script src="../../public/js/demo/chart-pie-demo.js"></script>