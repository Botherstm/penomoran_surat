<?php
header('Content-Type: application/json');
include "../db.php";

$id = $_POST['id'];
$nama = $_POST['nama'];


$stmt = $db->prepare("UPDATE barang SET nama = ? WHERE id = ?");
$result = $stmt->execute([$nama, $id]);

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => 'Product updated successfully.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update product.'
    ]);
}
?>
