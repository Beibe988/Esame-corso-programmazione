<?php
// Codice JSON con i link delle immagini
$json_string = '{
  "immagini": [
    "http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg",
    "http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg",
    "http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg",
    "http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg",
    "http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg",
    "http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg"
  ]
}';

// Decodifica il JSON in un array PHP
$immagini_array = json_decode($json_string, true);

// Controlla se l'array è stato correttamente decodificato
if ($immagini_array === null) {
  echo "Si è verificato un errore durante la decodifica del JSON.";
} else {
  // Stampa l'array delle immagini
  echo "<div class='gallery-container'>";
  echo "<div class='gallery-item'>";
    foreach ($immagini_array['immagini'] as $immagine) {
        echo "<a href='{$immagine[1]}'><img src='{$immagine[0]}' height='100' alt='Immagine'></a>";
    }
    echo "</div>";
    echo "</div>";
}


?>
