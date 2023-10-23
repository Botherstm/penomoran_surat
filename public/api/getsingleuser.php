<?php
header('Content-Type: application/json');
include "../api/db.php";

$id = $_POST['id'];

$stmt = $db->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($user) {
    echo json_encode([
        'success' => true,
        'data' => $user,
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'User not found.',
    ]);
}
?>





