<?php
    session_start(); // Avvia la sessione

    // Controlla se l'utente è loggato
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // Se non è loggato, reindirizza alla pagina di login
        header('Location: auth/login.php');
        exit;
    }

    // Array associativo di bottoni con link
    $bottone_link = array(
        "Portfolio" => "gallery.php",
        "Contattaci" => "contatti.php"
    );

    // Connessione al database
    require 'admin/db.php';

    // Inizializzazione variabili
    $category_name = isset($_GET['categoria']) ? $_GET['categoria'] : '';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $work_details = null;
    $title = '';
    $created_at = '';
    $description = '';
    $committed_by = '';
    $works_category = [];
    $title_page = '';

    // Query per ottenere i dettagli del lavoro e della categoria dal database
    try {
        // Recupera i dettagli del lavoro selezionato
        $stmt = $pdo->prepare("
            SELECT works.title, works.url_image, works.created_at, works.description, works.committed_by, categories.name AS category_name 
            FROM works 
            INNER JOIN categories ON works.category_id = categories.id 
            WHERE categories.name = :category_name AND works.id = :id
        ");
        $stmt->execute(['category_name' => $category_name, 'id' => $id]);
        $work_details = $stmt->fetch(PDO::FETCH_ASSOC);

        // Recupera tutti i lavori della stessa categoria
        $stmt_works = $pdo->prepare("SELECT * FROM works WHERE category_id = (SELECT id FROM categories WHERE name = :category_name)");
        $stmt_works->execute(['category_name' => $category_name]);
        $works_category = $stmt_works->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Errore durante il recupero dei dati: " . $e->getMessage();
        exit;
    }

    // Se il lavoro non è stato trovato, mostra un errore
    if (empty($work_details)) {
        echo "Lavoro non trovato.";
        exit;
    }

    // Includi head.php
    require_once 'head.php';
?>

<div class="container">
    <header class="contact">
        <h1><?= htmlspecialchars($work_details['title']) ?></h1>
    </header>
    <!-- Breve spiegazione del lavoro affiancata all'immagine -->
    <div class="dettaglio">
        <div class="image">
            <?php if (!empty($work_details['url_image'])): ?>
            <?php if (strpos($work_details['url_image'], 'http') === 0): ?>
                <!-- URL esterno -->
                <img src="<?= htmlspecialchars($work_details['url_image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($work_details['title'], ENT_QUOTES, 'UTF-8') ?>">
            <?php else: ?>
                <!-- Percorso immagine locale -->
                <img src="https://www.graydesign.it/admin/<?= htmlspecialchars($work_details['url_image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($work_details['title'], ENT_QUOTES, 'UTF-8') ?>">
            <?php endif; ?>
            <?php else: ?>
                <!-- Fallback nel caso non ci sia immagine -->
                <p>Nessuna immagine disponibile</p>
            <?php endif; ?>
        </div>
        <p>Data di creazione: <?php echo htmlspecialchars($work_details['created_at']); ?></p><br>
        <p>Descrizione: <?php echo htmlspecialchars($work_details['description']); ?></p><br>
        <p>Committente: <?php echo htmlspecialchars($work_details['committed_by']); ?></p>
    </div>

    <div class="clear"></div>

    <!-- Gallery di tutti i lavori della stessa categoria, con ogni immagine che va alla pagina di dettaglio corrispondente. -->      
    <div class="gallery-container">
        <?php foreach ($works_category as $work): ?>
            <div class="gallery-item">
                <a href="imagedetails.php?categoria=<?= urlencode($category_name) ?>&id=<?= $work['id'] ?>">
                    <?php if (!empty($work['url_image'])): ?>
                    <?php if (strpos($work['url_image'], 'http') === 0): ?>
                        <img src="<?= htmlspecialchars($work['url_image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($work['title'], ENT_QUOTES, 'UTF-8') ?>">
                    <?php else: ?>
                        <img src="https://www.graydesign.it/admin/<?= htmlspecialchars($work['url_image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($work['title'], ENT_QUOTES, 'UTF-8') ?>">
                    <?php endif; ?>
                    <?php else: ?>
                        <p>Nessuna immagine disponibile</p>
                    <?php endif; ?>
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
