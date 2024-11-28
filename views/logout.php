
<?php
    session_start();
    if (!array_key_exists('logado', $_SESSION)) {
    
    } else {
        session_destroy();
        header('Location: ./login.php');
    }
    if (session_status() === PHP_SESSION_ACTIVE) {
    }
?>

