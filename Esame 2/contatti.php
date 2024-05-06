<?php
    $titolo = "Contatti";
    $bottone_link = array(
        "Homepage" => "index.php"
    );
    // Includi head.php
    require_once 'head.php';
?>
    <div class="container">
        <?php
        // Includi nav.php
        require_once 'nav.php';
        ?>

        <header class="contact">
            <h1>Richiesta Informazioni</h1>
        </header>
       <!--Mappa della sede-->
        <figure>
            <img src="https://th.bing.com/th/id/R.bf540f3e04ce7e14da938e8b68fc07a3?rik=2%2bXP5pg5fybLjg&riu=http%3a%2f%2fallinallnews.com%2fwp-content%2fuploads%2f2015%2f05%2fGoogle-Maps.png&ehk=9QMYzOI1r77Z%2fYdid0jPAN%2fU5Qd9iBGLFE8QgJGxp7E%3d&risl=&pid=ImgRaw&r=0" height="400" class="imgcont">
            <figcaption>Strada Frazione Paterno, 119 - 60131 Ancona</figcaption>
        </figure>
        <!--Box richiesta contatti-->
        
        <fieldset>
            <legend>Richiesta Informazioni</legend>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Inserisci il tuo nome" required>
            <br>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" placeholder="Inserisci il tuo cognome" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Inserisci la tua email" required>
            <bR>
            <br>
            <textarea id="message" name="message" rows="4" cols="40" placeholder="Inserisci il tuo messaggio"></textarea>
            <br>
            <label for="agreeTerms">Accetto i <a href="#">Termini e le condizioni</a></label>
            <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
        </fieldset>
        <?php
        // Verifica se il modulo è stato inviato
        if (isset($_POST['submit'])) {
        // Recupera i dati inviati dal modulo
        $nome = $_POST['nome'] ?? '';
        $cognome = $_POST['cognome'] ?? '';
        $email = $_POST['email'] ?? '';
        $messaggio = $_POST['message'] ?? '';

        // Formatta i dati per il salvataggio
        $dati_da_salvare = "Nome: $nome\nCognome: $cognome\nEmail: $email\nMessaggio: $messaggio\n\n";

        // Percorso del file di testo per il salvataggio
        $percorso_file = "dati.txt";

        // Apri il file in modalità append (aggiunta)
        $file = fopen($percorso_file, "a");

        // Verifica se il file è stato aperto correttamente
        if ($file) {
            // Scrivi i dati nel file
            fwrite($file, $dati_da_salvare);

            // Chiudi il file
            fclose($file);

            echo "<p style='color: green;'>Dati salvati con successo.</p>";
        } else {
            echo "<p style='color: red;'>Si è verificato un errore durante il salvataggio dei dati.</p>";
        }
    }
    ?>
        <div class="back">
            <?php
            // Iterazione attraverso l'array e generazione dei bottoni con link
            foreach ($bottone_link as $testo => $link) {
                echo "<a href='$link' class='abutton'>$testo</a>";
            }
            ?>
        </div>
    </div>

<?php
// Includi footer.php
require_once 'footer.php';
?>
