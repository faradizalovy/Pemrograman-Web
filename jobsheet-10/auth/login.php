<?php 
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
} 
if (isset($_SESSION['user_id'])) { 
    header('Location: ../index.php'); 
    exit; 
} 
$remember_username = $_COOKIE['remember_username'] ?? ''; 
$page_title = "Login"; 
include __DIR__ . '/../includes/header.php'; 
 
$flash = $_SESSION['flash'] ?? null; 
unset($_SESSION['flash']); 
?> 
        <section> 
            <h2>Login Petugas</h2> 
 
            <?php if ($flash): ?> 
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p> 
            <?php endif; ?> 
 
           <form method="post" action="proses_login.php" class="form-login">
    <p>
        <label for="username">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            value="<?php echo htmlspecialchars($remember_username); ?>"
            required>
    </p>

    <p>
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            required>
    </p>

    <p class="remember">
        <input type="checkbox" id="remember" name="remember" value="1"><span>Ingat Saya</span>
    </p>
    <p>
        <button type="submit">Masuk</button>
    </p>
</form>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p> 
        </section> 
<?php include __DIR__ . '/../includes/footer.php'; ?> 