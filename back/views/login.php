<?php

include_once('C:/xampp/htdocs/project/back/controller/loginController.php');



if (isset($_POST['logar'])) {
    $email =  $_POST['email'];
    $senha = $_POST['senha'];

    $AuxControll = new LoginControll();
    $AuxControll->login($email, $senha);
}
?>





<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

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
                                    <img class="mb-4" src="../public/img/icon-login.gif" alt="" width="72" height="57">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <hr>
                                    <form action="" method="POST">

                                        <div class="form-floating">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" >
                                            <br/>
                                        </div>
                                        <div class="form-floating">
                                            <label for="senha">Senha</label>
                                            <input type="password" class="form-control" name="senha" id="senha" >
                                            <br/>
                                        </div>

                                        <button name="logar" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
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