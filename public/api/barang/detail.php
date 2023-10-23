<?php
header('Content-Type: application/json');
include "../db.php";

$id = $_POST['id'];

$stmt = $db->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->execute([$id]);
$barang = $stmt->fetch();

if ($barang) {
    echo json_encode([
        'success' => true,
        'barang' => $barang,
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Product not found.',
    ]);
}
?>
