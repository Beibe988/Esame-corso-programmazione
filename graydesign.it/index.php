<?php
$title_page = "Homepage";
// Includi head.php
require_once 'head.php';

// Avvia la sessione per accedere alle variabili di sessione
session_start();
?>

<div class="container">
    <?php
    // Includi nav.php
    require_once 'nav.php';
    ?>

    <!-- Messaggio di Home -->
    <header class="header">
        <h1 class="title">Welcome into GRAY</h1>
        <p>
            <i>"Ogni giornata grigia può riempirsi di colore"</i> 
        </p>
        <hr>
        <br>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <!-- Mostra il messaggio di benvenuto e nascondi il bottone "FAI LOGIN" se l'utente è loggato -->
            <p>Benvenuto, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
        <?php else: ?>
            <!-- Mostra il bottone "FAI LOGIN" se l'utente non è loggato -->
            <a href="auth/login.php" class="abutton">FAI LOGIN</a>
        <?php endif; ?>
    </header>
</div>

<?php
// Includi footer.php
require_once 'footer.php';
?>

