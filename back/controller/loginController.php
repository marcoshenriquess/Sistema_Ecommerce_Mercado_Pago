<?php

require_once('C:/xampp/htdocs/project/back/models/usuario.php');

session_start();
class LoginControll {


    public function __construct() {
    }

    public function login($email, $senha) {
        $Aux = new UsuarioModel();
        $status = $Aux->LoginModel($email, $senha);
       
        
        
    }
}


?>