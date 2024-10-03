<?php 
require '../auth/auth.php'; // Verifica che l'utente sia autenticato
require 'db.php'; // Connessione al database
include 'menu.php'; // Include il menu di navigazione

session_start();

// Controlla se l'utente è loggato e ha i permessi da amministratore
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['is_admin'] != 1) {
    // Se non è loggato o non è un amministratore, reindirizza alla pagina di login
    header('Location: auth/login.php');
    exit;
}

// Verifica se è stata inviata un'azione tramite il form
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    // Sanitizzazione degli input utente
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

    // Azione per aggiungere una nuova categoria
    if ($action == 'add') {
        // Dichiarazione preparata per inserire la categoria nel database
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->execute(['name' => $name]);

    // Azione per modificare una categoria esistente
    } elseif ($action == 'edit') {
        // Aggiornamento dei dati della categoria con una dichiarazione preparata
        $stmt = $pdo->prepare("UPDATE categories SET name=:name WHERE id=:id");
        $stmt->execute(['name' => $name, 'id' => $id]);

    // Azione per eliminare una categoria
    } elseif ($action == 'delete') {
        // Eliminazione della categoria dal database
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id=:id");
        $stmt->execute(['id' => $id]);
    }
}

// Recupera i dati delle categorie da modificare
if (isset($_POST['modifica'])) {
    $id = (int) $_POST['id']; // SanitizzazioneContinuo il codice per `category_management.php`
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $categoryToMod = $stmt->fetch();
}

// Recupera tutte le categorie per la visualizzazione
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/sidebar.css"> <!-- File CSS del menu -->
    <title>Gestione Categorie</title>
    <script src="validation.js"></script>
</head>
<body>
<div class="containerworks">
    <h1>Gestione Categorie</h1>
    <form method="POST" action="category_management.php" onsubmit="return validateCategoryForm()">
        <!-- Form per aggiungere/modificare categorie -->
        <input type="hidden" name="id" value="<?= isset($categoryToMod['id']) ? htmlspecialchars($categoryToMod['id'], ENT_QUOTES, 'UTF-8') : '' ?>">
        <input type="text" name="name" placeholder="Nome categoria" value="<?= isset($categoryToMod['name']) ? htmlspecialchars($categoryToMod['name'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
        <!-- Bottoni per aggiungere o modificare una categoria -->
        <?= isset($categoryToMod) ? '<button type="submit" name="action" value="edit">Modifica</button>' :
             '<button type="submit" name="action" value="add">Aggiungi</button>'
        ?>
    </form>

    <table class="workstable">
        <tr>
            <th class="id_cell">ID</th>
            <th>Nome Categoria</th>
            <th class="actions_cell">Azioni</th>
        </tr>
        <?php foreach ($categories as $category): ?>
        <tr>
            <!-- Visualizzazione sicura dei dati delle categorie -->
            <td><?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td class="actions_cell">
                <form method="POST" style="display:inline;">
                    <!-- Modifica categoria -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <button type="submit" name="modifica" value="edit2">Modifica</button>
                    <!-- Elimina categoria con conferma -->
                    <button type="submit" name="action" value="delete" onclick="return confirm('Sei sicuro di voler eliminare questa categoria?')">Elimina</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
