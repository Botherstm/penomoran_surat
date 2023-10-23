<?php

include '../db.php';

// Ambil barang_id dari parameter URL
$barang_id = $_GET['barang_id'];

try {
    // Query untuk mengambil data barang berdasarkan barang_id
    $query = "SELECT * FROM barang WHERE id = :barang_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':barang_id', $barang_id, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Mengembalikan data barang dalam format JSON
    echo json_encode($result);
} catch (PDOException $e) {
    // Mengembalikan pesan kesalahan jika terjadi error
    echo "Error: " . $e->getMessage();
}
