<?php
require '../admin/db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Registra l'utente come "user" di default (is_admin = 0)
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (:username, :email, :password, 0)");
    

    try {
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
        header('Location: login.php');
        exit();
    } catch (PDOException $e) {
        $error = "Errore: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/CSS/style.css">
    <title>Registrazione</title>
</head>
<body>
<div class="container">
    <h2>Registrati</h2>
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Nome utente" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Registrati</button>
    </form>
    <p>Hai già un account? <a href="login.php">Accedi qui</a></p>
</div>
</body>
</html>
