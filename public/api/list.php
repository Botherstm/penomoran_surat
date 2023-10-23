<?php
header('Content-Type: application/json');
include "../api/db.php";

$stmt = $db->prepare("SELECT id, nama, email,username,password,nomor FROM user");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);