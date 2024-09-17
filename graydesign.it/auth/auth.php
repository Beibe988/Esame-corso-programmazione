<?php
session_start();

function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php'); // Redirezione se l'utente non è loggato
        exit();
    }
}
?>
