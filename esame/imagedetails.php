<?php

// Array associativo di bottoni con link
$bottone_link = array(
    "Portfolio" => "gallery.php",
    "Contattaci" => "contatti.php"
);

// Carica il file JSON
$json_data = file_get_contents('image.json');
$images_array = json_decode($json_data, true);

// Inizializza variabili
$category_name = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$image_details = null;
$title = '';
$creation_date = '';
$description = '';
$commette = '';
$image_category = [];
$title_page = '';

// Cerca l'immagine corrispondente alla categoria e all'ID
foreach ($images_array['categorie'] as $categoria) {
    if ($categoria['name'] === $category_name) {
        if (isset($categoria['images'][$id])) {
            $image_details = $categoria['images'][$id];
            $title = $image_details['title'];
            $creation_date = $image_details['created'];
            $description = $image_details['description'];
            $commette = $image_details['commission'];
            $title_page = $title;
        }

        $image_category = $categoria['images'];
    }
}

// Se l'immagine non è stata trovata, mostra un errore
if (empty($image_details)) {
    echo "Immagine non trovata.";
    exit;
}

// Includi head.php
require_once 'head.php';

?>

<div class="container">
    <header class="contact">
        <h1><?= htmlspecialchars($image_details['title']) ?></h1>
    </header>
    <!-- Breve spiegazione dell'immagine affiancata alla stessa -->
    <div class="dettaglio">
        <div class="image">
            <img src="<?php echo htmlspecialchars($image_details['url']); ?>" alt="<?php echo htmlspecialchars($title); ?>">
        </div>
        <p>Data di creazione: <?php echo htmlspecialchars($creation_date); ?></p><br>
        <p>Descrizione: <?php echo htmlspecialchars($description); ?></p><br>
        <p>Committente: <?php echo htmlspecialchars($commette); ?></p>
    </div>

    <div class="clear"></div>

    <!-- Gallery di tutte le immagini della stessa categoria, con ogni immagine che va alla pagina di dettaglio corrispondente. -->      
    <div class="gallery-container">
        <?php foreach ($image_category as $index => $img): ?>
            <div class="gallery-item">
                <a href="imagedetails.php?categoria=<?= urlencode($category_name) ?>&id=<?= $index ?>">
                    <img src="<?= htmlspecialchars($img['url']) ?>" alt="<?= htmlspecialchars($img['title']) ?>">
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="back">
        <?php
        // Iterazione attraverso l'array e generazione dei bottoni con link
        foreach ($bottone_link as $testo => $link) {
            echo "<a href='$link' class='abutton'>$testo</a>";
        }
        ?>
         
        <!-- Mission dell'azienda o breve racconto del tema affrontato per l'immagine -->
        <p class="pgallery"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut iaculis nunc, ut sodales ligula.
            Nam lobortis dui in pulvinar finibus. Donec in nunc et magna consequat commodo. Vestibulum sit amet lacus lorem.
            Praesent et scelerisque ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris at feugiat magna.
            Nam ornare lacinia tellus, vel aliquet quam sollicitudin a. Phasellus volutpat et sapien id laoreet. Integer sed nulla vitae nisi molestie pulvinar vel at dolor.
            Integer quis laoreet eros. Duis porta sapien nisl, non dictum sapien mattis vel.
        </p>    
    </div>
</div>
<?php
// Includi footer.php
require_once 'footer.php';
?>
