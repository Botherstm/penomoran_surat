<?php
header('Content-Type: application/json');
include '../db.php';

// Ambil user_id dari request (misalnya dari parameter URL)
$user_id = $_GET['user_id'];

// Query untuk mengambil data pinjaman berdasarkan user_id
$pinjamanQuery = $db->prepare("SELECT * FROM pinjaman WHERE user_id = :user_id AND kembali = 0");
$pinjamanQuery->bindParam(':user_id', $user_id);
$pinjamanQuery->execute();
$pinjamanData = $pinjamanQuery->fetchAll(PDO::FETCH_ASSOC);

// Array untuk menyimpan data pinjaman dan barang
$data = [];

// Loop melalui data pinjaman
foreach ($pinjamanData as $pinjaman) {
    $barang_id = $pinjaman['barang_id'];

    // Query untuk mengambil data barang berdasarkan barang_id
    $barangQuery = $db->prepare("SELECT * FROM barang WHERE id = :barang_id ");
    $barangQuery->bindParam(':barang_id', $barang_id);
    $barangQuery->execute();
    $barangData = $barangQuery->fetch(PDO::FETCH_ASSOC);

    // Tambahkan data pinjaman dan barang ke array data
    $data[] = [
        'pinjaman' => $pinjaman,
        'barang' => $barangData,
    ];
}

// Mengembalikan data dalam format JSON

if (!empty($data)) {
    echo json_encode([
        'success' => true,
        'data' => $data,
    ]);
} else {
    echo json_encode([
        'success' => true,
        'data' => [],
    ]);
}
