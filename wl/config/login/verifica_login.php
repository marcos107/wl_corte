<?php
function verifica_login($categoria)
{
    session_start();
    if (!$_SESSION['usuario']) {
        alert('qwe');
        session_destroy();
        header('Location: ../index.php');
       
        
        exit();
    } else {
        if($_SESSION['categoria_usuario']!=$categoria){
            alert('ewq');
            session_destroy();
            header('Location: ../index.php');
            
            
            exit();
        }
    }
}

?>