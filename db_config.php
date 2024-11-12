<?php
// db_config.php

$host = 'localhost';  // Veritabanı sunucusu
$db   = 'webinar_db'; // Veritabanı adı
$user = 'root';       // Kullanıcı adı
$pass = '';           // Parola

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Hata yönetimi için
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantısı sağlanamadı: " . $e->getMessage());
}
