<?php

include('../db.php');

$pinjamanId = $_POST['pinjaman_id'];

// Ambil data jumlah barang yang dikembalikan dari pinjaman
$query = "SELECT jumlah FROM pinjaman WHERE id = :pinjaman_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':pinjaman_id', $pinjamanId);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    // Pinjaman tidak ditemukan
    $response['success'] = true;
    $response['message'] = 'Pinjaman not found';
    echo json_encode($response);
    exit; // Hentikan eksekusi kode selanjutnya
}

$jumlahKembali = $result['jumlah'];

// Update jumlah barang pada tabel barang
$query = "UPDATE barang SET jumlah = jumlah + :jumlah_kembali";
$stmt = $db->prepare($query);
$stmt->bindParam(':jumlah_kembali', $jumlahKembali);
$stmt->execute();

// Update status pengembalian pada pinjaman
$query = "UPDATE pinjaman SET kembali = 1 WHERE id = :pinjaman_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':pinjaman_id', $pinjamanId);
$stmt->execute();

$response['success'] = true;
$response['message'] = 'Item returned successfully';

echo json_encode($response);
