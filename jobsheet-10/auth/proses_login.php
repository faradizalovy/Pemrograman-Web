<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../includes/koneksi.php';
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Menyiapkan penghitung percobaan login
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = [];
}

// Jika username sudah mencapai batas percobaan
if (isset($_SESSION['login_attempts'][$username])
    && $_SESSION['login_attempts'][$username] >= 3) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Terlalu banyak percobaan Login yang gagal. Silakan coba kembali.'
    ];
    header('Location: login.php');
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {

    // Reset penghitung setelah login berhasil
    $_SESSION['login_attempts'][$username] = 0;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    // Remember Me
    if (isset($_POST['remember'])) {
        setcookie(
            'remember_username',
            $username,
            time() + (30 * 24 * 60 * 60),
            '/'
        );
    }
    header('Location: ../index.php');
    exit;
}
// Jika login gagal
if (!isset($_SESSION['login_attempts'][$username])) {
    $_SESSION['login_attempts'][$username] = 0;
}

$_SESSION['login_attempts'][$username]++;

// Menampilkan peringatan setelah mencapai 3 kali gagal
if ($_SESSION['login_attempts'][$username] >= 3) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Terlalu banyak percobaan Login yang gagal. Silakan coba kembali.'
    ];
} else {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Username atau password salah. Percobaan gagal ke-'
            . $_SESSION['login_attempts'][$username] . '.'
    ];
}

header('Location: login.php');
exit;