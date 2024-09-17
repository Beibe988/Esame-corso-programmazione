<?php 
require '../auth/auth.php'; // Verifica che l'utente sia autenticato
require 'db.php'; // Connessione al database
include 'menu.php'; // Include il menu di navigazione

session_start();

// Controlla se l'utente è loggato e ha i permessi da amministratore
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['is_admin'] != 1) {
    header('Location: login.php'); // Se non è loggato o non è un amministratore, reindirizza alla pagina di login
    exit;
}

// Verifica se è stata inviata un'azione tramite il form
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Sanitizzazione degli input utente
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $url_image = $_POST['url_image'];
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    $committed_by = htmlspecialchars($_POST['committed_by'], ENT_QUOTES, 'UTF-8');
    $category_id = (int) $_POST['category_id'];
    $user_id = (int) $_SESSION['is_admin']; // Recupera l'ID dell'utente dalla sessione
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

    try {
        // Azione per aggiungere un nuovo lavoro
        if ($action == 'add') {
            $created_at = date('Y-m-d'); // Ottieni la data
            $stmt = $pdo->prepare("INSERT INTO works (title, url_image, description, committed_by, created_at, category_id, user_id) 
                                   VALUES (:title, :url_image, :description, :committed_by, :created_at, :category_id, :user_id)");
            if ($stmt->execute([
                'title' => $title,
                'url_image' => $url_image, 
                'description' => $description,  
                'committed_by' => $committed_by, 
                'created_at' => $created_at,
                'category_id' => $category_id, 
                'user_id' => $user_id
            ])) {
                echo "Lavoro aggiunto con successo!";
            } else {
                echo "Errore nell'aggiunta del lavoro.";
            }
        } elseif ($action == 'edit') {
            // Aggiornamento dei dati del lavoro con una dichiarazione preparata
            $stmt = $pdo->prepare("UPDATE works SET title=:title, description=:description, url_image=:url_image, committed_by=:committed_by, category_id=:category_id 
                                   WHERE id=:id");
            $stmt->execute([
                'title' => $title, 
                'description' => $description, 
                'url_image' => $url_image, 
                'committed_by' => $committed_by, 
                'category_id' => $category_id, 
                'id' => $id
            ]);
            echo "Lavoro modificato con successo!";
        // Azione per eliminare un lavoro
        } elseif ($action == 'delete') {
            // Eliminazione del lavoro dal database
            $stmt = $pdo->prepare("DELETE FROM works WHERE id=:id");
            $stmt->execute(['id' => $id]);
            echo "Lavoro eliminato con successo!";
        }
    } catch (PDOException $e) {
        // Gestione degli errori
        echo "Errore durante l'operazione: " . $e->getMessage();
    }
}

// Recupera i dati dei lavori da modificare
if (isset($_POST['modifica'])) {
    $id = (int) $_POST['id']; // Sanitizzazione dell'ID
    $stmt = $pdo->prepare("SELECT * FROM works WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $workToMod = $stmt->fetch();
}
// Filtra i lavori per categorie
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Pagina attuale, default a 1
$per_page = 5; // Numero di lavori per pagina
$offset = ($page - 1) * $per_page; // Calcola l'offset per la query

$filter_category_id = isset($_GET['filter_category_id']) && $_GET['filter_category_id'] !== '' ? (int) $_GET['filter_category_id'] : null;

if ($filter_category_id) {
    $stmt = $pdo->prepare("
        SELECT works.*, categories.name AS category_name, users.username AS user_name 
        FROM works 
        LEFT JOIN categories ON works.category_id = categories.id 
        LEFT JOIN users ON works.user_id = users.id 
        WHERE works.category_id = :category_id
        LIMIT :offset, :per_page
    ");
    $stmt->bindValue(':category_id', $filter_category_id, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
    $stmt->execute();
    $works = $stmt->fetchAll();
} else {
    $stmt = $pdo->prepare("
        SELECT works.*, categories.name AS category_name, users.username AS user_name 
        FROM works 
        LEFT JOIN categories ON works.category_id = categories.id 
        LEFT JOIN users ON works.user_id = users.id
        LIMIT :offset, :per_page
    ");
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
    $stmt->execute();
    $works = $stmt->fetchAll();
}


// Recupera tutti i lavori per la visualizzazione
/* $works = $pdo->query("SELECT works.*, categories.name AS category_name, users.username AS user_name 
FROM works 
LEFT JOIN categories ON works.category_id = categories.id 
LEFT JOIN users ON works.user_id = users.id")->fetchAll();*/
?> 

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/sidebar.css"> <!-- File CSS del menu -->
    <title>Gestione Lavori</title>
    <script src="validation.js"></script>
    <script>
        // Funzione JavaScript per confermare l'eliminazione di un lavoro
        function confirmDeletion() {
            return confirm("Sei sicuro di voler eliminare questo lavoro?");
        }
    </script>
</head>
<body>
    <div class="containerworks">
        <h2>Gestione Lavori</h2>
        <!-- Form per il filtro -->
        <form method="GET" action="work_management.php">
        <select name="filter_category_id">
            <option value="">Tutte le categorie</option>
            <?php
            $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
            foreach ($categories as $category) {
                echo '<option value="' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8') . '" ' . (isset($_GET['filter_category_id']) && $_GET['filter_category_id'] == $category['id'] ? 'selected' : '') . '>' . htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') . '</option>';
            }
            ?>
        </select>
        <button type="submit" class="filter_button">Filtra</button>
        </form>
        <form method="POST" action="work_management.php" onsubmit="return validateWorkForm()">
            <!-- Form per aggiungere/modificare lavori -->
            <input type="hidden" name="id" value="<?= isset($workToMod['id']) ? htmlspecialchars($workToMod['id'], ENT_QUOTES, 'UTF-8') : '' ?>">
            <input type="text" name="title" placeholder="Titolo lavoro" value="<?= isset($workToMod['title']) ? htmlspecialchars($workToMod['title'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
            <input type="url" name="url_image" placeholder="URL immagine" value="<?= isset($workToMod['url_image']) ? htmlspecialchars($workToMod['url_image'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
            <textarea class="description" name="description" placeholder="Descrizione"><?= isset($workToMod['description']) ? htmlspecialchars($workToMod['description'], ENT_QUOTES, 'UTF-8') : '' ?></textarea>
            <input type="text" name="committed_by" placeholder="Committente" value="<?= isset($workToMod['committed_by']) ? htmlspecialchars($workToMod['committed_by'], ENT_QUOTES, 'UTF-8') : '' ?>">
            <select name="category_id" required>
                <option value="">Seleziona Categoria</option>
                <?php
                $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
                foreach ($categories as $category) {
                    echo '<option value="' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8') . '" ' . (isset($workToMod) && $workToMod['category_id'] == $category['id'] ? 'selected' : '') . '>' . htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') . '</option>';
                }
                ?>
            </select>

            <!-- Bottoni per aggiungere o modificare un lavoro -->
            <?= isset($workToMod) ?
            '<button type="submit" name="action" value="edit">Modifica</button>' :
            '<button type="submit" name="action" value="add">Aggiungi</button>' 
            ?>
        </form>

        <div class="workstable">
            <table>
                <tr>
                    <th class="id_cell">ID</th>
                    <th class="title_cell">Titolo</th>
                    <th>URL Immagine</th>
                    <th>Descrizione</th>
                    <th class="user_cell">Committente</th>
                    <th class="user_cell">Creato il</th>
                    <th class="cat_cell">Categoria</th>
                    <th class="actions_cell">Azioni</th>
                </tr>
                <?php foreach ($works as $work): ?>
                <tr>
                    <!-- Visualizzazione sicura dei dati dei lavori -->
                    <td><?= htmlspecialchars($work['id'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($work['title'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($work['url_image'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="cell_descr"><?= htmlspecialchars($work['description'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($work['committed_by'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($work['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($work['category_name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <!-- Modifica lavoro -->
                            <input type="hidden" name="id" value="<?= htmlspecialchars($work['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" name="modifica" value="edit2">Modifica</button>
                            <!-- Elimina lavoro con conferma -->
                            <button type="submit" name="action" value="delete" onclick="return confirmDeletion()">Elimina</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&filter_category_id=<?= $filter_category_id ?>">Precedente</a>
        <?php endif; ?>
        <a href="?page=<?= $page + 1 ?>&filter_category_id=<?= $filter_category_id ?>">Successivo</a>
    </div>
</div>
</body>
</html>