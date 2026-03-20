<?php
session_start();

# apoontar caminho consoante o tipo, controlo de acesso.
# Ficheiro servira apenas para controlador de sessao redericionara para a vista/docomento conrrespondente fechando no final com o exit

if (!empty($_SESSION['user_id']) && !empty($_SESSION['tipo'])) {

    switch ($_SESSION['tipo']) {
        case 'admin':
            header("Location: dashboard_admin.php");            #Ficheiro a fazer 
            break;
        case 'user':
            header("Location:dawshboard_user.php");             #Ficheiro a fazer
            break;
        default:
            session_destroy();
            header("Location: login.php");                      #Ficheiro a fazer
    }
} else {
    header("Location: login.php");
}


exit(); #optional

?>