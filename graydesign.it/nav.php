<!-- Barra di navigazione -->
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="gallery.php">Portfolio</a></li>
        <li><a href="contacts.php">Contatti</a></li>
        <!-- Controllo per mostrare o nascondere il bottone di login -->
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <li>Benvenuto, <?= htmlspecialchars($_SESSION['username']); ?></li>
            <?php if ($_SESSION['is_admin'] == '1'): ?>
                <li><a href="admin/user_management.php">Backend</a></li> <!-- Link al backend solo per amministratori -->
            <?php endif; ?>
            <li><a href="auth/logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="auth/login.php">Login</a></li>
        <?php endif; ?>
    </ul>      
</nav>