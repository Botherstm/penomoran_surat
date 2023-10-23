<?php
header('Content-Type: application/json');
include "../db.php";

$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$ormawa = $_POST['ormawa'];
$tanggal = $_POST['tanggal'];
$deskripsi = $_POST['deskripsi'];
$image = $_POST['image'];


$stmt = $db->prepare("INSERT INTO barang (nama, jumlah, ormawa, tanggal, deskripsi, image) VALUES (?, ?, ?, ?, ?, ?)");
$result = $stmt->execute([$nama, $jumlah,$ormawa,$tanggal,$deskripsi,$image]);

echo json_encode([
'success' => $result
]);

?>
