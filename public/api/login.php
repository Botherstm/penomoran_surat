<?php
header('Content-Type: application/json');
include "../api/db.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Validasi input jika diperlukan

// Periksa apakah username ada dalam database
$stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    // Login berhasil
    // Simpan data pengguna ke dalam array
    $userData = [
        'id' => $user['id'],
        'nama' => $user['nama'],
        'username' => $user['username'],
        'email' => $user['email'],
        'nomor' => $user['nomor'],
        'organisasi' => $user['organisasi'],
        'password' => $user['password'],
        'admin' => $user['admin']
    ];

    // Konversi data pengguna ke format JSON
    $jsonData = json_encode($userData);

    // Kirim respon JSON
    echo $jsonData;
} else {
    // Login gagal
    echo json_encode([
        'error' => 'Invalid credentials'
    ]);
}
?>
