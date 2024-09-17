<?php

    session_start(); // Avvia la sessione

    // Controlla se l'utente è loggato
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // Se non è loggato, reindirizza alla pagina di login
        header('Location: auth/login.php');
        exit;
    }

    $title_page = "Portfolio";
    $bottone_link = array(
        "Homepage" => "index.php",
        "Contact Us" => "contacts.php"
    );

// Connessione al database
require 'admin/db.php';

// Query per recuperare categorie e immagini
try {
    // Recupera le categorie
    $categories_query = $pdo->query("SELECT * FROM categories");
    $categories = $categories_query->fetchAll(PDO::FETCH_ASSOC);

    // Recupera tutte le immagini e associa la categoria corrispondente
    $immagini_query = $pdo->query("SELECT * FROM works");
    $immagini = $immagini_query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Errore durante il recupero dei dati: " . $e->getMessage();
    exit;
}

    // Includi head.php
    require_once 'head.php';

    // Includi nav.php
    require_once 'nav.php';
    
?>
<div class="container">
    
    <!-- Testo di introduzione che può essere, ad esempio, una breve spiegazione della mission dell'azienda-->
    <p class="pgallery"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut iaculis nunc, ut sodales ligula. Nam lobortis dui in pulvinar finibus. Donec in nunc et magna consequat commodo. Vestibulum sit amet lacus lorem. Praesent et scelerisque ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris at feugiat magna. Nam ornare lacinia tellus, vel aliquet quam sollicitudin a. Phasellus volutpat et sapien id laoreet. Integer sed nulla vitae nisi molestie pulvinar vel at dolor. Integer quis laoreet eros. Duis porta sapien nisl, non dictum sapien mattis vel.</p>
    
    <!--Galleria dei lavori, elenca tutte le categorie e le immagini al loro interno.
    Ogni immagine ha un link che punta alla pagina di dettaglio.
    Il link contiene i parametri categoria e id.
    Utilizziamo un foreach per cercare attraverso ogni categoria nel file JSON. -->
    <?php foreach ($categories as $categoria): ?>
        <div class="category-container">
            <h3><?= htmlspecialchars($categoria['name']) ?></h3>
            <div class="gallery-container">
                <div class="gallery-item">
                    <?php 
                    // Filtra le immagini per categoria
                    foreach ($immagini as $immagine) {
                        if ($immagine['category_id'] == $categoria['id']): ?>
                            <a href="imagedetails.php?categoria=<?= urlencode($categoria['name']) ?>&id=<?= $immagine['id'] ?>">
                                <img src="<?= htmlspecialchars($immagine['url_image']) ?>" alt="<?= htmlspecialchars($immagine['title']) ?>">
                            </a>
                        <?php endif;
                    } ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    

    <!--Bottoni per la navigazione-->
    <div class="back">
        <?php
        // Iterazione attraverso l'array e generazione dei bottoni con link
        foreach ($bottone_link as $testo => $link) {
            echo "<a href='$link' class='abutton'>$testo</a>";
        }
        ?>
    </div>  

</div>

<?php
// Includi footer.php
require_once 'footer.php';
?>