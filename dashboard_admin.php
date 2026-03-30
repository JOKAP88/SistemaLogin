<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'admin') {
    header("Location: login.php");
    exit;
}

require 'config/config.php';


/*Estatisticas*/
$totalUsers = $pdo->query("SELECT COUNT(*) FROM utilizadores")->fetchColumn();
$totalAdmin = $pdo->query("SELECT COUNT(*) FROM utilizadores WHERE tipo = 'admin'")->fetchColumn();
$totalNormalUsers = $pdo->query("SELECT COUNT(*) FROM utilizadores WHERE tipo = 'user'")->fetchColumn();
$registosHoje = $pdo->query("SELECT COUNT(*) FROM utilizadores WHERE DATE(data_registo) = CURDATE()")->fetchColumn();


/* Ultimos Utilizadores */

$stmt = $pdo->query("SELECT nome,email, tipo, data_registo FROM utilizadores ORDER BY data_registo DESC LIMIT 5");
$ultimoUsers = $stmt->fetchALL();

?>

<link rel="stylesheet" href="css/dashboard.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="sidebar">
    <h2>ADMIN</h2>
    <ul>
        <li><a href="dashboard_admin.php">Dashboard</a></li>
        <li><a href="Utilizadores.php">Utilizadores</a></li>
        <li><a href="#">Relatorios</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
    </ul>
</div>

<div class="main">
    <div class="topbar">
        <h3>Bem Vindo! <?php echo $_SESSION['nome']; ?></h3>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>

    <div class="cards">
        <div class="card-box">
            <i class="fa-solid fa-users"></i>
            <h4>Total Utilizadores</h4>
            <p><?php echo $totalUsers; ?></p>
        </div>

        <div class="card-box">
            <i class="fa-solid fa-user-shield"></i>
            <h4>Total Admin</h4>
            <p><?php echo $totalAdmin; ?></p>
        </div>

        <div class="card-box">
            <i class="fa-solid fa-user"></i>
            <h4>Total Users</h4>
            <p><?php echo $totalNormalUsers; ?></p>
        </div>

        <div class="card-box">
            <i class="fa-solid fa-calendar-day"></i>
            <h4>Registos Hoje</h4>
            <p><?php echo $registosHoje; ?></p>
        </div>
    </div>

        <div class="chart-container">
            <h3>Distribuição de Utilizadores</h3>
            <canvas id="userChart"></canvas>
        </div>
        <h3 style="margin-top: 40px;">ÚLtimos Utilizadores Resgistados</h3>
        <table class="users-table">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Data</th>
            </tr>
            <?php foreach ($ultimoUsers as $user): ?>
                <tr>
                    <td><?php echo $user['nome']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['tipo']; ?></td>
                    <td><?php echo $user['data_registo']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
</div>

<script>
    const ctx = document.getElementById('userChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Admins', 'Users'],
            datasets: [{
                label: 'Utilizadores',
                data: [<?php echo $totalAdmin; ?>, <?php echo $totalNormalUsers; ?>],
                backgroundColor: [
                    '#8E44AD)',
                    '#3498DB'
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            }
        }
    });
</script>