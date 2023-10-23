<?php
header('Content-Type: application/json');
include "../db.php";

$id = $_POST['id'];

$stmt = $db->prepare("DELETE FROM barang WHERE id = ?");
$result = $stmt->execute([$id]);

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => 'Barang deleted successfully.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to delete barang.'
    ]);
}
?>
