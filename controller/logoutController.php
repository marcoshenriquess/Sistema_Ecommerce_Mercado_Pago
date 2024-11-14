<?php
    class LogoutController{
        
    
        public function __construct(){

        }
        public function LogOut(){
            session_destroy();
        }
    }

?>