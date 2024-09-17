<?php
$host = '31.11.39.173';
$db = 'Sql1813933_1';
$user = 'Sql1813933';
$pass = 'UL2?ctufxg$sJ39';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database Connesso";
} catch (PDOException $e) {
    die("Errore nella connessione al database: " . $e->getMessage());
}
?>
