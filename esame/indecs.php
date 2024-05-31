<?php
$titolo = "Homepage";
// Includi head.php
require_once 'head.php';
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
        <a href="gallery.php" class="abutton">Portfolio</a>
    </header>
</div>

<?php
// Includi footer.php
require_once 'footer.php';
?>
