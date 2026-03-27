<?php
    session_start();
    require'config/config.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $tipo = $_POST['tipo'];

    if($password !== $confirm){
        $_SESSION['erro'] = "Password não coencidem!!";
        header("Location: register.php");
        exit;
    }

    $check = $pdo->prepare("SELECT id FROM utilizadores WHERE email =?");
    $check->execute([$email]);

    if($check->rowCount() > 0){
        $_SESSION['erro'] ="Email já registado!";
        header("Location: register.php");
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO utilizadores (nome, email, password, tipo) VALUE (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $hash, $tipo]);

    header("Location: login.php");
    exit;
?>