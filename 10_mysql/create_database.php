<?php
require_once 'env.php';

$dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=utf8mb4";

try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    throw $e;
}

$sql = "CREATE DATABASE IF NOT EXISTS " . DB_DATABASE;
$pdo->exec($sql);

$sql = "USE " . DB_DATABASE;
$pdo->exec($sql);

$sqlFile = "docs/schema.sql";
if (file_exists($sqlFile)) {
    $sql = file_get_contents($sqlFile);
    $pdo->exec($sql);
    $message = "Database schema created successfully" . PHP_EOL;
} else {
    $message = "SQL file not found: " . $sqlFile . PHP_EOL;
}

$sqlFile = "docs/insert_data.sql";
if (file_exists($sqlFile)) {
    $sql = file_get_contents($sqlFile);
    $pdo->exec($sql);
    $message .= "Database data inserted successfully" . PHP_EOL;
} else {
    $message .= "SQL file not found: " . $sqlFile . PHP_EOL;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">Database Created Successfully</h1>
        <p><?= nl2br($message); ?></p>
        <a href="./" class="text-blue-500">Home</a>
    </div>
</body>

</html>