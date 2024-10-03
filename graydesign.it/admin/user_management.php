<?php 
require '../auth/auth.php'; // Autenticazione utente
require 'db.php'; // Connessione al database
include 'menu.php'; // Include il menu di navigazione

session_start();

// Controlla se l'utente è loggato e ha i permessi da amministratore
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['is_admin'] != 1) {
    // Se non è loggato o non è un amministratore, reindirizza alla pagina di login
    header('Location: login.php');
    exit;
}

// Verifica se è stata inviata un'azione tramite il form
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    // Sanitizzazione dell'input utente con htmlspecialchars
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'); 
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null; // Sanitizzazione dell'ID utente

    // Azione per aggiungere un nuovo utente
    if ($action == 'add') {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Crittografia della password
        // Utilizza una dichiarazione preparata per prevenire SQL injection
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email]);

    // Azione per modificare un utente esistente
    } elseif ($action == 'edit') {
        if (!empty($_POST['password'])) { // Se la password è stata fornita, aggiorna la password criptata
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Crittografia della password
            // Aggiorna tutti i dati utente inclusa la password
            $stmt = $pdo->prepare("UPDATE users SET username=:username, email=:email, password=:password WHERE id=:id");
            $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password, 'id' => $id]);
        } else { // Se non è stata fornita una nuova password, aggiorna solo username ed email
            $stmt = $pdo->prepare("UPDATE users SET username=:username, email=:email WHERE id=:id");
            $stmt->execute(['username' => $username, 'email' => $email, 'id' => $id]);
        }

    // Azione per eliminare un utente
    } elseif ($action == 'delete') {
        // Cancella l'utente dal database in base al suo ID
        $stmt = $pdo->prepare("DELETE FROM users WHERE id=:id");
        $stmt->execute(['id' => $id]);
    }
}

// Recupera i dati degli utenti da modificare
if (isset($_POST['modifica'])) {
    $id = (int) $_POST['id']; // Sanitizzazione dell'ID utente
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $userToMod = $stmt->fetch();
}

// Recupera tutti gli utenti per la visualizzazione
$users = $pdo->query("SELECT * FROM users")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/sidebar.css"> <!-- file CSS del menu -->
    <title>Gestione Utenti</title>
    <script src="validation.js"></script>
    <script>
        // Funzione JavaScript per confermare l'eliminazione di un utente
        function confirmDeletion() {
            return confirm("Sei sicuro di voler eliminare questo utente?");
        }
    </script>
</head>
<body>
<div class="containerworks">
    <h1>Gestione Utenti</h1>
    <form method="POST" action="user_management.php" onsubmit="return validateUserForm()">
        <!-- Form per aggiungere/modificare utenti -->
        <input type="hidden" name="id" id="user-id" value="<?= isset($userToMod['id']) ? htmlspecialchars($userToMod['id'], ENT_QUOTES, 'UTF-8') : '' ?>">
        <input type="text" name="username" id="username" placeholder="Nome utente" value="<?= isset($userToMod['username']) ? htmlspecialchars($userToMod['username'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
        <input type="email" name="email" id="email" placeholder="Email" value="<?= isset($userToMod['email']) ? htmlspecialchars($userToMod['email'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
        <input type="password" name="password" id="password" placeholder="Password">
        <!-- Messaggio visibile solo in modalità modifica -->
        <?php if (isset($userToMod)) : ?>
            <small>Lascia vuoto se non desideri cambiare la password</small>
        <?php endif; ?>
        <!-- Bottoni per aggiungere o modificare un utente -->
        <?= isset($userToMod) ?
        '<button type="submit" name="action" value="edit">Modifica</button>' :
        '<button type="submit" name="action" value="add">Aggiungi</button>' 
        ?>
    </form>
    
    <table class="workstable">
        <tr>
            <th class="id_cell">ID</th>
            <th class="user_cell">Nome utente</th>
            <th>Email</th>
            <th>Password</th>
            <th class="actions_cell">Azioni</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <!-- Visualizzazione sicura dei dati utente -->
            <td><?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($user['password'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <!-- Modifica utente -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <button type="submit" name="modifica" value="edit2">Modifica</button>
                    <!-- Elimina utente con conferma -->
                    <button type="submit" name="action" value="delete" onclick="return confirmDeletion()">Elimina</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
