<?php
require('../admin/db.php');
$error = '';

session_start(); // Avvia la sessione


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Recupero dell'utente dal database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica la password
    if ($user && password_verify($password, $user['password'])) {
        // Login riuscito: crea la sessione
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin']; // Aggiunge il ruolo alla sessione

        // Reindirizza in base al ruolo
        header('Location: ../index.php'); // Tutti gli utenti vengono reindirizzati alla homepage
        exit();
    } else {
        $error = "Nome utente o password errati!";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/CSS/style.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Nome utente" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Accedi</button>
    </form>
    <p>Non hai un account? <a href="register.php">Registrati qui</a></p>
</div>
</body>
</html>
