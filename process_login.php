<?php

    session_start();
    require 'config./config.php';

    $email = $_POST['email'];
    $pasword = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM utilizadores WHERE EMAIL = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if($user && password_verify($pasword, $user['$password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['tipo'] = $user['tipo'];

        if($user['tipo'] == 'admin'){
            header("Location: dashboard_admin.php");
        }else{
            header("Location: dashboard_user.php");
        }

        exit;
    }else{
        $_SESSION['erro'] = "Credenciais Inválidas!";
        header("Location: login.php");
        exit;
    }

    ?>
