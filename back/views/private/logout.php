<?php

    

    session_destroy();
    if(!array_key_exists('logado', $_SESSION)){
        header('Location: ../login.php');
    }
?>