<?php
header('Content-Type: application/json');
include "../api/db.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$nomor = $_POST['nomor'];
$organisasi = $_POST['organisasi'];
$password = $_POST['password'];

// Validasi input jika diperlukan

// Periksa apakah email sudah terdaftar sebelumnya
$stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    echo json_encode([
        'success' => false,
        'message' => 'Email already exists.',
    ]);
} else {
    // Hash password sebelum disimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan pengguna baru ke database
    $stmt = $db->prepare("INSERT INTO user (nama, email, nomor ,organisasi, username, password) VALUES (?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([$nama, $email, $nomor,$organisasi, $username, $hashedPassword]);
    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Registration successful.',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to register user.',
        ]);
    }
}
?>