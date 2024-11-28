<?php

//limpando a url
if (isset($_GET['_nocache'])) {
    // Redirecionar para a página de login
    header("Location: /project/views/login.php");
    exit();
}


require_once('C:/xampp/htdocs/project/controller/loginController.php');


$msg = "";
$err = "";

if (isset($_POST['logar'])) {

    $email =  $_POST['email'];
    $senha = $_POST['senha'];

    $AuxControll = new LoginControll();
    $err = $AuxControll->login($email, $senha);
    $msg =  "<img class='mb-4' src='../public/img/loading.gif' alt='' width='72' height='57'>";
}



include_once('head.php');
?>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-20 col-md-20">

                <div class="card o-hidden border-0 shadow-lg my-5 w-70">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <?php
                                        if ($msg == null) {
                                            echo "<img class='mb-4' src='../public/img/icon-login.gif' alt='' width='72' height='57'>";
                                        } else {
                                            echo $msg;
                                        }
                                        ?>
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <hr>
                                    <form action="" method="POST">
                                        <input type="hidden" id="METHOD" value="getStatus">
                                        <div class="form-floating">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                            <br />
                                        </div>
                                        <div class="form-floating">
                                            <label for="senha">Senha</label>
                                            <input type="password" class="form-control" name="senha" id="senha">
                                            <br />
                                        </div>

                                        <button name="logar" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($err == 404) {
                            ?>
                                <div class="w-100 d-flex justify-content-center ">
                                    <div
                                        class=" form-inline navbar-search">
                                        <div class="input-group">
                                            <div class="alert alert-danger" role="alert">
                                                Email ou senha inválidas!
                                                <script>
                                                // Recarregar a página após 10 segundos (10.000 milissegundos)
                                                setTimeout(function() {
                                                    const url = window.location.href.split('?')[0];
                                                    window.location.href = `${url}?_nocache=${new Date().getTime()}`;
                                                }, 1200);
                                            </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                            
                        } 
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>



    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../public/vendor/jquery/jquery.min.js"></script>
    <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../public/js/sb-admin-2.min.js"></script>

</body>

</html>