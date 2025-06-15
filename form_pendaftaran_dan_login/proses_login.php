<?php
session_start();

$conn = new mysqli("localhost", "root", "", "form_keamanan");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    echo "Login berhasil! Selamat datang, " . $username;
} else {
    echo "Login gagal. Username atau password salah.";
}

$stmt->close();
$conn->close();
?>
