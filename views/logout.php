<?php
    session_start();
    // Verifica se a sessão já foi iniciada e, caso contrário, a inicia
    if (!array_key_exists('logado', $_SESSION)) {
    
    } else {
        session_destroy();
        header('Location: ./login.php');
    }

    // Exibe uma mensagem de teste
    // Destroi a sessão apenas se ela estiver ativa
    if (session_status() === PHP_SESSION_ACTIVE) {
    }
?>
