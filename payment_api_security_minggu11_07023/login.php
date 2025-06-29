<?php
require_once 'config.php';
session_start();
$conn = new mysqli('localhost', 'root', '', 'your_database');

// Rate limiting
if (!isset($_SESSION['attempt'])) {
    $_SESSION['attempt'] = 0;
    $_SESSION['last_attempt'] = time();
}

if ($_SESSION['attempt'] >= 5 && (time() - $_SESSION['last_attempt']) < 120) {
    die('Terlalu banyak percobaan. Silakan tunggu 2 menit.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            echo "Login sukses";
            $_SESSION['attempt'] = 0; // reset counter
        } else {
            $_SESSION['attempt']++;
            $_SESSION['last_attempt'] = time();
            echo "Password salah";
        }
    } else {
        echo "User tidak ditemukan";
    }
}
?>
<form method="POST">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
