<?php

    session_start();

    if(!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'user'){
        header("Location: login.php");
        exit;
    }

?>

<link rel="stylesheet" href="css/dashboard.css">

<div class="sidebar">
    <h2>User</h2>
    <ul>
        <li><a href="#">Daschboard</a></li>
        <li><a href="#">Perfil</a></li>
        <li><a href="#">Configurações</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main">
    <div class="topbar">
    <h3>Bem Vindo, <?php echo $_SESSION['nome'];?></h3>
    <a class="logout-btn" href="logout.php">Logout</a>
    </div>
    <div class="cards">
        <div class="card-box">
            <h4>Minha Conta</h4>
            <p>Ativa</p>
        </div>
        <div class="card-box">
            <h4>Tipo</h4>
            <p><?php echo $_SESSION['tipo']; ?></p>
        </div>
    </div>
</div>