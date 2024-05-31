<?php
// Array associativo di bottoni con link
$bottone_link = array(
    "Portfolio" => "gallery.php",
    "Contattaci" => "contatti.php"
);

// Includi head.php
require_once 'head.php';

// Carica il contenuto del file JSON
$json_string = file_get_contents('image.json');

// Decodifica il JSON in un array PHP
$immagini_array = json_decode($json_string, true);

// Ottiene la categoria e l'ID dell'immagine dalla query string
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verifica che la categoria e l'ID siano validi
if (!isset($immagini_array['categorie'][$categoria]) || $id < 0 || $id >= count($immagini_array['categorie'][$categoria])) {
    die("Immagine non trovata.");
}

// Ottiene i dettagli dell'immagine
$immagine = $immagini_array['categorie'][$categoria][$id];
?>

<div class="container">
    <?php
    // Includi nav.php
    require_once 'nav.php';
    ?>

    <header class="contact">
        <h1><?= htmlspecialchars($immagine['title']) ?></h1>
    </header>
    <!--Breve spiegazione dell'immagine affiancata alla stessa-->
    <div class="dettaglio">
        <div class="image">
            <img src="<?= htmlspecialchars($immagine['url']) ?>" alt="<?= htmlspecialchars($immagine['title']) ?>">
        </div>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue.
        Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
        Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi.
        Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.
        Phasellus vulputate sollicitudin massa vel dictum. Sed elementum, enim et volutpat interdum, quam nisi dictum mi, eu ultrices nunc velit nec est.
        Nullam vulputate sagittis velit, at congue sapien varius ut. Maecenas sollicitudin libero at ipsum rhoncus molestie. Vestibulum vel magna vitae nibh dapibus pellentesque.
        Sed vel dui varius, aliquet ipsum ac, tincidunt purus. Duis a elementum odio. Nam nec libero leo. Maecenas sit amet massa vel metus convallis faucibus.
        In pellentesque lorem a ante blandit condimentum. Phasellus cursus erat lacus, sit amet tempus odio commodo et. Suspendisse potenti.
        </p>
    </div>

    <div class="clear"></div>

    <!--Gallery di tutte le immagini della stessa categoria, con ogni immagine che
    va alla pagina di dettaglio corrispondente.-->      
    <div class="gallery-container">
        <div class="gallery-item">
            <?php foreach ($immagini_array['categorie'][$categoria] as $index => $img): ?>
                <a href="dettaglio.php?categoria=<?= urlencode($categoria) ?>&id=<?= $index ?>">
                    <img src="<?= htmlspecialchars($img['url']) ?>" alt="<?= htmlspecialchars($img['title']) ?>">
                </a>
                <?php endforeach; ?>
        </div>
    </div>

    <div class="back">
        <?php
        // Iterazione attraverso l'array e generazione dei bottoni con link
        foreach ($bottone_link as $testo => $link) {
            echo "<a href='$link' class='abutton'>$testo</a>";
        }
        ?>
         

        <!--Mission dell'azienda o breve racconto del tema affrontato per l'immagine-->
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
 