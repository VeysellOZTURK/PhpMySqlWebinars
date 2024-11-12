<?php
// webinars.php

// Hata mesajları için sabitler
const ERR_INVALID_APIKEY = 'Geçersiz API Anahtarı';
const ERR_INVALID_STATUS = 'Geçersiz status değeri. Sadece 0 veya 1 olabilir.';
const ERR_NO_WEBINARS = 'Hiçbir webinar bulunamadı.';
const ERR_DB_PREFIX = 'Veritabanı hatası: ';

// JSON formatında yanıt döneceğimizi belirtelim
header("Content-Type: application/json");

// Veritabanı bağlantısını dahil et
require_once 'db_config.php';

// API Anahtarı Kontrolü
$api_key = '12345'; // Burada kendi API anahtarınızı belirleyin

// API Anahtarı kontrolü
if (!isset($_GET['api_key']) || $_GET['api_key'] !== $api_key) {
    echo json_encode(['error' => ERR_INVALID_APIKEY]);
    exit;
}

// Gelen 'status' parametresini alalım
$status = null;
if (isset($_GET['status'])) {
    $status = $_GET['status'];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['status'])) {
        $status = $input['status'];
    }
}

// 'status' parametresinin geçerliliğini kontrol edelim
if ($status !== null && !in_array($status, ['0', '1'], true)) {
    echo json_encode(['error' => ERR_INVALID_STATUS]);
    exit;
}

// SQL sorgusunu hazırlayalım
try {
    // Durum parametresi varsa, ona göre filtrele
    if ($status !== null) {
        $stmt = $pdo->prepare("SELECT * FROM webinars WHERE status = :status");
        $stmt->execute(['status' => $status]);
    } else {
        // Eğer 'status' parametresi yoksa, tüm webinarları getir
        $stmt = $pdo->query("SELECT * FROM webinars");
    }

    // Sonuçları alalım
    $webinars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($webinars) {
        echo json_encode($webinars);
    } else {
        echo json_encode(['message' => ERR_NO_WEBINARS]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => ERR_DB_PREFIX . $e->getMessage()]);
}