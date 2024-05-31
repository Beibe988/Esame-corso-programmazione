<?php
    $titolo = "Portfolio";
    $bottone_link = array(
        "Homepage" => "indecs.php",
        "Contattaci" => "contatti.php"
    );

    // Carica il contenuto del file JSON
    $json_string = file_get_contents('image.json');

    // Decodifica il JSON in un array PHP
    $immagini_array = json_decode($json_string, true);

    // Controlla se l'array è stato correttamente decodificato
    if ($immagini_array === null) {
    echo "Si è verificato un errore durante la decodifica del JSON.";
    };

    // Includi head.php
    require_once 'head.php';
?>
<div class="container">
    <?php
    // Includi nav.php
    require_once 'nav.php';
    ?>
    
    <!-- Testo di introduzione che può essere, ad esempio, una breve spiegazione della mission dell'azienda-->
    <p class="pgallery"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut iaculis nunc, ut sodales ligula. Nam lobortis dui in pulvinar finibus. Donec in nunc et magna consequat commodo. Vestibulum sit amet lacus lorem. Praesent et scelerisque ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris at feugiat magna. Nam ornare lacinia tellus, vel aliquet quam sollicitudin a. Phasellus volutpat et sapien id laoreet. Integer sed nulla vitae nisi molestie pulvinar vel at dolor. Integer quis laoreet eros. Duis porta sapien nisl, non dictum sapien mattis vel.</p>
    
    <!--Galleria dei lavori, elenca tutte le categorie e le immagini al loro interno.
    Ogni immagine ha un link che punta alla pagina di dettaglio.
    Il link contiene i parametri categoria e id. -->
    <?php foreach ($immagini_array['categorie'] as $categoria => $immagini): ?>
        <div class="gallery-container">
        <div class="gallery-item">
        <?php foreach ($immagini as $index => $immagine): ?>
            <a href="dettaglio.php?categoria=<?= urlencode($categoria) ?>&id=<?= $index ?>">
                <img src="<?= htmlspecialchars($immagine['url']) ?>" alt="<?= htmlspecialchars($immagine['title']) ?>">
            </a>
        <?php endforeach; ?>
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