<?php
    $title_page = "Contatti";
    $bottone_link = array(
        "Homepage" => "index.php"
    );

    // Inizializzazione delle variabili
    $name = $surname = $email = $message = $agreeTerms = "";
    $nameErr = $surnameErr = $emailErr = $messageErr = $agreeTermsErr = "";

    // Controllo se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // Convalida del nome
    if (empty($_POST["name"])) {
        $nameErr = "Il nome è obbligatorio";
        $valid = false;
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Solo lettere e spazi sono ammessi";
            $valid = false;
        }
    }

    // Convalida del cognome
    if (empty($_POST["surname"])) {
        $surnameErr = "Il cognome è obbligatorio";
        $valid = false;
    } else {
        $surname = test_input($_POST["surname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
            $surnameErr = "Solo lettere e spazi sono ammessi";
            $valid = false;
        }
    }

    // Convalida dell'email
    if (empty($_POST["email"])) {
        $emailErr = "L'email è obbligatoria";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato email non valido";
            $valid = false;
        }
    }

    // Convalida del messaggio
    if (empty($_POST["message"])) {
        $messageErr = "Il messaggio è obbligatorio";
        $valid = false;
    } else {
        $message = test_input($_POST["message"]);
    }

    // Convalida dei termini
    if (empty($_POST["agreeTerms"])) {
        $agreeTermsErr = "Devi accettare i termini e le condizioni";
        $valid = false;
    } else {
        $agreeTerms = test_input($_POST["agreeTerms"]);
    }

    // Se tutto è valido, processa i dati
    if ($valid) {
        echo "Form inviato con successo!";
        exit;
    }
}

    // Funzione per pulire i dati di input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-field">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" class="<?php echo (!empty($nameErr)) ? 'error-input' : ''; ?>">
                    <span class="error"><?php echo $nameErr; ?></span>
                </div>
                <div class="form-field">
                    <label for="surname">Cognome:</label>
                    <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($surname); ?>" class="<?php echo (!empty($surnameErr)) ? 'error-input' : ''; ?>">
                    <span class="error"><?php echo $surnameErr; ?></span>
                </div>
                <div class="form-field">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="<?php echo (!empty($emailErr)) ? 'error-input' : ''; ?>">
                    <span class="error"><?php echo $emailErr; ?></span>
                </div>
                <div class="form-field">
                    <label for="message">Messaggio:</label>
                    <textarea id="message" name="message" rows="4" cols="40" placeholder="Inserisci il tuo messaggio" class="<?php echo (!empty($messageErr)) ? 'error-input' : ''; ?>"><?php echo htmlspecialchars($message); ?></textarea>
                    <span class="error"><?php echo $messageErr; ?></span>
                </div>
                <div class="form-field">
                    <input type="submit" value="Invia" name="submit">
                </div>
                <div class="form-field">
                    <input type="checkbox" id="agreeTerms" name="agreeTerms" <?php echo (!empty($agreeTerms)) ? 'checked' : ''; ?>>
                    <label for="agreeTerms">Accetto i <a href="Terms.php" target="_blank">Termini e le condizioni</a></label>
                    <span class="error"><?php echo $agreeTermsErr; ?></span>
                </div>
            </form>
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
