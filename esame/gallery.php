<?php
    $title_page = "Portfolio";
    $bottone_link = array(
        "Homepage" => "index.php",
        "Contact Us" => "contacts.php"
    );

    // Carica il file JSON
    $json_data = file_get_contents('image.json');
    $images_array = json_decode($json_data, true);

    // Controlla se l'array è stato correttamente decodificato
    if ($images_array === null) {
    echo "Si è verificato un errore durante la decodifica del JSON.";
    };

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
    <?php foreach ($images_array['categorie'] as $categoria): ?>
        <div class="category-container">
            <div class="gallery-container">
                <div class="gallery-item">
                    <?php foreach ($categoria['images'] as $index => $immagine): ?>
                        <a href="imagedetails.php?categoria=<?= urlencode($categoria['name']) ?>&id=<?= $index ?>">
                            <img src="<?= htmlspecialchars($immagine['url']) ?>" alt="<?= htmlspecialchars($immagine['title']) ?>">
                        </a>
                    <?php endforeach; ?>
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