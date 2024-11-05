<?php

require_once('C:/xampp/htdocs/project/back/models/usuario.php');

class LoginControll {


    public function __construct() {
    }

    public function login($email, $senha) {
        $Aux = new UsuarioModel();
        $Aux->LoginModel($email, $senha);
    }
}


?>