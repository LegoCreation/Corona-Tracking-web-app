<?php
// Basic database connection using PDO.
// Include this in every file that should interact with the database.

$host = 'localhost';
$db   = 'seteam20';
$charset = 'utf8mb4';

// These credentials must be updated for local development  
$user = 'shishir';
$pass = 'Xhacker@0000';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>
