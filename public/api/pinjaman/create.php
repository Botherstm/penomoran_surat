<?php
// file: api/pinjaman/create.php

header('Content-Type: application/json');
require_once '../db.php';

// Menerima data dari Flutter
$barangId = $_POST['barang_id'];
$userId = $_POST['user_id'];
$jumlah = intval($_POST['jumlah']);

// Mengubah tipe data jumlah menjadi integer
$jumlah = intval($jumlah);

// Query untuk mendapatkan jumlah barang yang ada
$query = 'SELECT jumlah FROM barang WHERE id = ?';
$stmt = $db->prepare($query);
$stmt->execute([$barangId]);
$barang = $stmt->fetch(PDO::FETCH_ASSOC);
$jumlahBarang = $barang['jumlah'];

// Periksa apakah jumlah barang yang diminta tersedia
if ($jumlahBarang < $jumlah) {
  $response = ['success' => false, 'message' => 'Barang tidak tersedia dalam jumlah yang diminta.'];
  echo json_encode($response);
  exit;
}

// Kurangi jumlah barang yang ada sesuai dengan jumlah
$updatedJumlahBarang = $jumlahBarang - $jumlah;

// Query untuk menyimpan data pinjaman

$stmt = $db->prepare("INSERT INTO pinjaman (barang_id, user_id, jumlah) VALUES (?, ?, ?)");
$stmt->execute([$barangId, $userId, $jumlah]);

// Update jumlah barang yang tersedia
$query = 'UPDATE barang SET jumlah = ? WHERE id = ?';
$stmt = $db->prepare($query);
$stmt->execute([$updatedJumlahBarang, $barangId]);

// Mengirim respons JSON
$response = ['success' => true];
echo json_encode($response);
?>
