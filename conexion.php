<?php
$host = 'localhost';
$user = 'root';
$db = 'eventos';
$pass = '';
$pdo = "mysql:host=".$host.";dbname=" . $db;
try {
    $con = new PDO($pdo, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexion: " . $e->getMessage();
}
?>