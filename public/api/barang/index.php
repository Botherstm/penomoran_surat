<?php
header('Content-Type: application/json');
include "../db.php";

$stmt = $db->prepare("SELECT * FROM barang");
$stmt->execute();
$barangs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($barangs);
?>