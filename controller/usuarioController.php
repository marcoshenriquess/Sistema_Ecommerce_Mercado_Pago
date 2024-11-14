<?php

require_once('C:/xampp/htdocs/project/models/usuario.php');

class UsuarioController{
    public function __construct(){

    }

    public function ListaUsuarioControll(){
        $usuario = new UsuarioModel();
        $listaUser = $usuario->ListaUsuarios();

        return $listaUser;
    }
    public function ObterUsuarioControll($id){
        $usuario = new UsuarioModel();
        $usu_selecionado = $usuario->ObterUsuario($id);
        
        return $usu_selecionado;
    }
    public function ExcluirController( $id){
        $usuario = new UsuarioModel();
        $usuario->ExcluirUsuario($id);
    }
    public function CadastroUsuarioControll($dadosUsuario){
        $usuario = new UsuarioModel();
        $usuario->CadastrarUsuario($dadosUsuario);
        header('Location: usuarios.php');
    }
    public function AlterarUsuarioControll($dadosUsuario, $id){
        $usuario = new UsuarioModel();
        $usuario->AlterarUsuario($dadosUsuario, $id);

        header('Location: usuarios.php');
    }
    
}

?>