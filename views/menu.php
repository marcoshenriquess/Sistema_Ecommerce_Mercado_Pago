<?php
// include_once('C:/xampp/htdocs/project/models/permissao.php');

//var_dump($_SESSION['usuario_taramps']);
if (isset($_REQUEST['sair'])) {
    // ***IMPLEMENTAR VERIFICAÇÃO DE SESSÕES DE PROCEDIMENTOS FUTUROS

    //REGISTRAR LOG

    //DESTRUIR SESSÕES
    session_destroy();
}

require_once('../controller/TipoUsuarioController.php');
require_once('../controller/logoutController.php');
require_once('../controller/produtoController.php');

// LISTANDO OS PRODUTOS EXISTENTES ARMAZENADO
$AuxListProd = new ProdutoControll();
$ListProd = $AuxListProd->ListaAllProduto();

if (isset($_SESSION['usuario_logado'])) {
    $AuxTipoUser = new TipoUserControll();
    $TipoUsuario = $AuxTipoUser->ObeterTipoUser($_SESSION['tipo_user']);
}

?>
<script>
    const listaProduto = <?= json_encode($ListProd) ?>;


    function FiltrarProduto() {
        const prodId = document.getElementById("produtosId").value.toLowerCase();
        const prodList = document.getElementById("produtoList");
        prodList.innerHTML = "";

        // Exibir resultados apenas se o usuário começar a digitar
        if (prodId.trim() === "") {
            prodList.style.display = "none";
            return;
        }

        const resultados = listaProduto.filter(item =>
            item.prod_nome && item.prod_nome.toLowerCase().includes(prodId)
        );

        if (resultados.length > 0) {
            prodList.style.display = "block";

            resultados.forEach(element => {
                const li = document.createElement('li');
                li.textContent = element.prod_nome;
                li.className = "list-group-item";
                li.onclick = function() {
                    prodList.style.display = "none";
                    document.getElementById("produtosId").value = element.prod_nome;
                };
                prodList.appendChild(li);
            });
        } else {
            prodList.style.display = "none";
        }
    }


    $('.dropdown-pers').hover(function() {
        $(this).find('.dropdown-menu').fadeIn();
        $(this).find('.fa-sort-up').fadeIn();
    }, function() {
        $(this).find('.dropdown-menu').fadeOut();
        $(this).find('.fa-sort-down').fadeOut();
    });
</script>
<style>
    .image {
        height: 198px;
        object-fit: cover;
        width: 100%;
        /* border-radius: 100px; */
    }

    #div-image {
        height: 200px;
        /* border-radius: 100px; */
    }

    .spinner {
        display: inline-block;
        /* Para permitir que a imagem ocupe espaço */
        width: 100%;
        /* Ocupa a largura total da div */
        height: 100%;
        /* Ocupa a altura total da div */
        position: relative;
        /* Para posicionar o spinner */
    }

    /* Spinner que gira */
    .spinner::after {
        content: '';
        position: absolute;
        top: 43%;
        left: 43%;
        width: 30px;
        /* Largura do spinner */
        height: 30px;
        /* Altura do spinner */
        border: 4px solid rgba(255, 255, 255, 0.3);
        /* Cor e transparência do spinner */
        border-top: 4px solid #3498db;
        /* Cor do topo do spinner */
        border-radius: 50%;
        animation: spin 1s linear infinite;
        /* Animação de rotação */
        transform: translate(-50%, -50%);
        /* Centraliza o spinner */
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #dados-usuario-cel {
        display: none;
    }

    @media screen and (max-width: 768px) {
        #dados-usuario-cel {
            display: block;
        }

        #dados-usuario-pc {
            display: none;
        }
    }

    .produtoList {
        display: none;
        position: absolute;
        z-index: 1000;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        background-color: #fff;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
    }


    .produtoList li {
        cursor: pointer;
    }

    .produtoList li:hover {
        background-color: #f1f1f1;
    }

    #tabela-container {
        height: 500px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .edit-ajust-itens {
        display: flex;
        justify-content: end;
        align-items: center;
        padding-top: 5px;
    }
</style>
<nav class="navbar navbar-expand navbar-light topbar static-top shadow bg-light">
    <div class="w-100 ">
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->
        <div class="w-100 d-flex" id="navbarSupportedContent">
            <div class="d-flex align-items-center organize-itens-nav w-75">
                <div class="logo-dv">
                    <a href="./index.php"><img src="../public/img/Logo/logo-da-loja.webp" style="width: 140px"></a>
                </div>
                <form class="navbar-search w-100 ml-5 d-flex justify-content-md-center align-itens-center" action="busca.php" method="POST">
                    <div class="input-group d-flex justify-content-md-center align-itens-center w-75">
                        <input type="text" id="produtosId" name="produto" onkeyup="FiltrarProduto()" onfocus="FiltrarProduto()" class="form-control shadow-sm bg-light border-0 small" placeholder="Pesquisar por..."
                            aria-label="Search" aria-describedby="basic-addon2">

                        <ul id="produtoList" class="produtoList list-group mt-5" style="display: none; position: absolute; z-index: 1000; width: 100%; height: auto; max-height: 500px;">
                            <!-- A lista de pastas será preenchida aqui -->
                        </ul>
                        <div class="input-group-append">
                            <button id="buscar" class="btn btn-danger-personalizado shadow-sm" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow m-2 d-flex align-items-center">
                    <a class="d-flex dropdown no-arrow align-items-center text-decoration-line-through" href="carrinho.php">
                        <button class="btn btn-light h-50" type="submit">
                            <i class="fas fa-shopping-cart fa-sm fa-fw text-danger-400"></i>
                        </button>
                    </a>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow  x-5 d-flex align-items-center">
                    <?php
                    if (isset($_SESSION['usuario_logado'])) {
                    ?>
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline small txt-black">
                                Olá
                                <b><?= $_SESSION['usuario_logado']['usu_nome'] ?></b>
                            </span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="meus_dados.php">
                                <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                                Meus Dados
                            </a>
                            <hr />
                            <a class="dropdown-item" href="pedidos.php">
                                <i class="fas fa-shopping-bag fa-sm fa-fw mr-2 text-gray-400"></i>
                                Meus Pedidos
                            </a>
                            <hr />
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Sair
                            </a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link active" href="login.php">Login &nbsp<i class="fas fa-sign-in-alt"></i></a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
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
                <button name="sair" id="sair" type="button" class="btn btn-primary" onclick="SairAll()">Sair</button>
            </div>
        </div>
    </div>
</div>
<script>
    function SairAll() {
        localStorage.clear();
        window.location.href = "logout.php";
    }
</script>
<!-- Bootstrap core JavaScript-->
<script src="../public/vendor/jquery/jquery.min.js"></script>
<script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../public/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../public/js/demo/chart-area-demo.js"></script>
<script src="../public/js/demo/chart-pie-demo.js"></script>