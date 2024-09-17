<?php
session_start(); // Avvia la sessione

// Rimuove tutte le variabili di sessione
$_SESSION = [];

// Codice per rimuovere i cookie se ce ne sono (lo appunto nel caso servisse in futuro)
/*
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
*/

// Termina la sessione
session_destroy();

// Reindirizza alla pagina di login o homepage
header("Location: ../index.php");
exit();
?>
