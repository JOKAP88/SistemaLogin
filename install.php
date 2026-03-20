<?php
#Bloquear a Reinstalação (bloqueio de ficheiro)

if (file_exists("intall.lock")) {
    die("<h2>Sistema já instalado</h2><p>Apague o ficheiro install.lock para reinstalar</p>"); # o pragrafo deve ser apagado 
}

$host = "127.0.0.1";
// $port = "3307";
$db = "SistemaLogin";
$user = "root";
$pass = "Admin";
$charset = "utf8mb4";


// Dados de Admin

$admin_nome = "Administrador";
$admin_email = "admin@email.com";
$admin_pass = "123456";


//Verificar Requesitos 

function checkRequirements()
{
    echo "
        <h2>Verificação de Requesitos</h2> ";

    if (version_compare(PHP_VERSION, '7.4', '<')) {
        die("PHP 7.4 ou Superior é necessário");
    }

    if (!extension_loaded("pdo")) {
        die("Extensão PDO não está ativa");
    }

     if (!extension_loaded("pdo_mysql")) {
        die("Extensão PDO MySQL não está ativa");
    }

    echo "PHP Ok(" . PHP_VERSION . ")<br>";
    echo "PDO Ativo<br>";
    echo "PDO MySQL Ativo<br><br>";
}

checkRequirements();

//ligação ao MySQL SEM BASE DE DADOS

$dsn = "mysql:host=$host;charset=$charset"; //caso necessario adicionar a porta (ex:3307)

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "<h3>Ligação ao MySql estabelecida</h3>";

    //criar base de dados

    $pdo->exec("
        CREATE DATABASE IF NOT EXISTS $db
        CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci
        ");

    echo "Base de dados já criada ou já existe<br>";

    // Ligar á BASE DE DADOS

    $pdo->exec("USE $db");
    //Criar Tabela

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS utilizadores(
            id  INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            avatar VARCHAR(255) DEFAULT 'uploads/avatars/default.png',
            tipo    ENUM ('user', 'admin') NOT NULL DEFAULT ('user'),
            data_registo DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");

    echo "Tabela Utilizadores Pronta<br>";


    // Criar um Admin se Não Exisitir (optional)

    $check = $pdo->prepare("SELECT id FROM utilizadores WHERE email = ?");
    $check->execute([$admin_email]);

    if ($check->rowCount() == 0) {
        $passwordHash = password_hash($admin_pass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("
            INSERT INTO utilizadores ( nome, email, password, avatar, tipo) VALUE(?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $admin_nome,
            $admin_email,
            $passwordHash,
            "uploads/avatars/default.png",
            "admin"
        ]);

        echo "Administrador Criado comm sucesso<br>";
    } else {
        echo "Administrador Já Existe<br>";
    }

    //Criar pasta de avatares nao existir

    if(!is_dir("uploads/avatars")){
        mkdir("uploads/avatars", 0777, true);
        echo"Pasta uploads/avatars criada com sucesso<br>";
    }else{
        echo"Pasta uploads/avatars já Existente<br>";
    }

    //criar o ficheiro Bloqueio
    file_put_contents("install.lock", "INSTALLED");
    ECHO"<h2>instalacao concluida com sucesso</h2>";
    echo"Por segurança apague o ficheiro<strong>install.php</strong></p>";


} catch (PDOException $e) {
    die("<h3>Erro na Instalação</h3><p>". $e->getMessage() . "</p>");
}
  