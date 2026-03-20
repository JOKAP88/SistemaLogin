<?php

$host = "127.0.0.1"; //ip associado ao local host, todos os pc tem este ip associado ao localHost
$db = "SistemaLogin";
$user = "root";
$pass = "Admin";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; //port=3307


$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Erro de Ligação" . $e->getMessage());
}
 