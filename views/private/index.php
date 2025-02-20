<?php

include('C:/xampp/htdocs/project/models/permissao.php');

// use League\Csv\Writer;

require_once('../../public/vendor/autoload.php');
require_once('../../controller/GraficosController.php');


$CatbVenAux = new CatVen();
$CategoriasVenda = $CatbVenAux->CategoriasVenda();

// $csv = Writer::create

?>

<!-- Sidebar -->
<?php include_once('menu.php') ?>
<!-- End of Sidebar -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    window.onload = function() {
        ConsultaRendimentoMes();
    }

    function ConsultaRendimentoMes() {
        $.ajax({
            url: "../../controller/GraficosController.php",
            type: 'GET',
            data: {
                action: 'ConsultaMediaAnual'
            },
            success: function(res) {
                const parsedRes = JSON.parse(res);
                let Total = 0;

                parsedRes.forEach(element => {
                    const MediaBanco = parseFloat(element['Media_Anual']);
                    Total += MediaBanco;
                });

                document.getElementById('MediaRendidoAno').textContent = Total.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
            },
            error: function(err) {
                console.error("Erro na REQ:", err);
            }
        });
        $.ajax({
            url: "../../controller/GraficosController.php",
            type: 'GET',
            data: {
                action: 'RendimentoTotal'
            },
            success: function(res) {
                const parsedRes = JSON.parse(res);
                let Total = 0;
                let ValorVendaProd = 0;
                parsedRes.forEach(element => {
                    ValorVendaProd = parseFloat(element['TOTAL']);
                    QuantidadeProd = parseFloat(element['ven_quantidade']);
                    Total += (ValorVendaProd * QuantidadeProd);

                });

                document.getElementById('TotalRendido').textContent = Total.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
            },
            error: function(err) {
                console.error("Erro na REQ:", err);
            }
        });
        // $.ajax({
        //     url: "../../controller/GraficosController.php",
        //     type: 'GET',
        //     data: {
        //         action: 'ConsultaDados'
        //     },
        //     success: function(res) {
        //         const dados = JSON.parse(res);

        //         const xValues = [];
        //         const yValues = [];
        //         dados.forEach(element => {
        //             xValues.push(element['tipo_prod_nome']);
        //             yValues.push(element['Quantidade']);
        //         });
        //         // console.log(xValues);
        //         // console.log(yValues);
        //         new Chart("myChartPie", {
        //             type: "pie",
        //             data: {
        //                 labels: xValues,
        //                 datasets: [{
        //                     data: yValues,
        //                     backgroundColor: [
        //                         'rgba(255, 99, 132, 0.2)',
        //                         'rgba(255, 159, 64, 0.2)',
        //                         'rgba(255, 205, 86, 0.2)',
        //                         'rgba(75, 192, 192, 0.2)',
        //                         'rgba(54, 162, 235, 0.2)',
        //                         'rgba(153, 102, 255, 0.2)',
        //                         'rgba(153, 185, 255, 0.2)',
        //                         'rgba(102, 163, 156, 0.2)',
        //                         'rgba(249, 85, 245, 0.2)',
        //                         'rgba(201, 203, 207, 0.2)'
        //                     ],
        //                     borderColor: [
        //                         'rgb(255, 99, 132)',
        //                         'rgb(255, 159, 64)',
        //                         'rgb(255, 205, 86)',
        //                         'rgb(75, 192, 192)',
        //                         'rgb(54, 162, 235)',
        //                         'rgb(153, 102, 255)',
        //                         'rgba(153, 185, 255, 255)',
        //                         'rgba(102, 163, 156, 255)',
        //                         'rgba(249, 85, 245, 255)',
        //                         'rgb(201, 203, 207)'
        //                     ],
        //                     borderWidth: 1
        //                 }]
        //             },
        //             options: {
        //                 indexAxis: 'x', // Define o eixo do índice como 'y' para barras horizontais
        //                 legend: {
        //                     display: true // Oculta a legenda
        //                 }
        //             }
        //         });

        //     },
        //     error: function(err) {
        //         console.error("Erro na REQ:", err);
        //     }
        // });
        $.ajax({
            url: "../../controller/GraficosController.php",
            type: 'GET',
            data: {
                action: 'ConsultaValorVendaMes'
            },
            success: function(res) {
                const dados = JSON.parse(res);

                const xValues = [];
                const yValues = [];
                dados.forEach(element => {
                    const Valor = parseInt(element['ProdutosVendidos']); // Mantém o valor como número
                    xValues.push(element['Mes']);
                    yValues.push(Valor);
                });
                // console.log(xValues);
                // console.log(yValues);
                new Chart("myChart", {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [{
                            data: yValues,
                            backgroundColor: [
                                'transparent',

                            ],
                            borderColor: [
                                'rgb(255,127,80)',
                                '#CCCC00',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgba(153, 185, 255, 255)',
                                'rgba(102, 163, 156, 255)',
                                'rgba(249, 85, 245, 255)',
                                'rgb(102,205,170)',
                                'rgba(222, 71, 123, 255)',
                                'rgb(0,191,255)'
                            ],
                            borderWidth: 8
                        }]
                    },
                    options: {

                        indexAxis: 'y', // Define o eixo do índice como 'y' para barras horizontais
                        scales: {
                            x: {
                                grid: {
                                    offset: true
                                }
                            }
                        },
                        legend: {
                            display: false // Oculta a legenda
                        }
                    }
                });

            },
            error: function(err) {
                console.error("Erro na REQ:", err);
            }
        });
    }
</script>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <?php include_once('header.php') ?>
        <!-- End of Topbar -->
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Rendimento Total:</div>
                                    <div id="TotalRendido" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Média (Anual)</div>
                                    <div id="MediaRendidoAno" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7 h-100">
                    <div class="card shadow mb-4 h-100">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Vendas do Ano: </h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area h-auto">
                                <canvas id="myChart" class="ajuste-w-graf ajuste-h-graf"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5r">
                    <div class="ajuste-h-categoria shadow ">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Categorias Mais Vendidas:</h6>
                            <!-- <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div> -->
                        </div>
                        <!-- Card Body -->
                        <div class=" h-100">
                            <div class="chart-pie h-100 p-2">
                                <!-- <canvas id="myChartPie"></canvas> -->

                                <table class="table table-borderless table-hover  h-100">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Categoria</th>
                                            <th class="text-center" scope="col">Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($CategoriasVenda as $key => $CatVen): ?>
                                            <tr>
                                                <th scope="row"><?= 1 + $key ?></th>
                                                <td><?= $CatVen['catPai_nome'] ?></td>
                                                <td class="text-center"><?= $CatVen['Quantidade'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="C:/xampp/htdocs/project/public/vendor/jquery/jquery.min.js"></script>
<script src="C:/xampp/htdocs/project/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="C:/xampp/htdocs/project/public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="C:/xampp/htdocs/project/public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="C:/xampp/htdocs/project/public/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="C:/xampp/htdocs/project/public/js/demo/chart-area-demo.js"></script>
<script src="C:/xampp/htdocs/project/public/js/demo/chart-pie-demo.js"></script>



</body>

</html>