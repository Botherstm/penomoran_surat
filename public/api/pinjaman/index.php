<?php
header('Content-Type: application/json');
include "../db.php";

$query = 'SELECT * FROM pinjaman';
$stmt = $db->query($query);
$pinjamans = $stmt->fetchAll();

// Mengirim data sebagai respons JSON
echo json_encode($pinjamans);
?>