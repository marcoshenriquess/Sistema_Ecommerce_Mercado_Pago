<?php




require_once('C:/xampp/htdocs/project/models/usuario.php');

class LoginControll {
    

    public function __construct() {
    }

    public function login($email, $senha) {
        $Aux = new UsuarioModel();
        $usuario = $Aux->LoginModel($email, $senha);
        
        if (!$usuario) {
            $msg = 404;
            return $msg;
        }else {
            if ($usuario['usu_tipo'] == '1' || $usuario['usu_tipo'] == '2') {
                // echo "222222222222222222222";
                session_start();
                $_SESSION['logado'] = true;
                header('Refresh: 2;  private/index.php');
            } else {
                // echo "XXXXXXXXXXXXXXXXXXXXXXXXXXXX";
                session_start();
                $_SESSION['logado'] = true;
                header('Refresh: 2;  index.php');
            }
        }
        $_SESSION['usuario_logado'] = $usuario;
        $_SESSION['tipo_user'] = $usuario['usu_tipo'];
        return $usuario;
    }

    
}


?>