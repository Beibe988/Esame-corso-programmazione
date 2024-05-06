<?php
    $titolo = "Portfolio";
    $bottone_link = array(
        "Homepage" => "index.php",
        "Contattaci" => "contatti.php"
    );
    // Definizione dei gruppi di immagini e link associati
    $gruppi_immagini = array(
        array(
            array("http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg", "lavoro.php"),
            array("http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg", "lavoro.php"),
            array("http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg", "lavoro.php"),
            array("http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg", "lavoro.php"),
            array("http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg", "lavoro.php"),
            array("http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg", "lavoro.php")
        ),
        array(
            array("http://fc01.deviantart.net/fs70/f/2013/076/4/b/jessica2_by_azy0-d5ycket.gif", "lavoro2.php"),
            array("http://fc01.deviantart.net/fs70/f/2013/076/4/b/jessica2_by_azy0-d5ycket.gif", "lavoro2.php"),
            array("http://fc01.deviantart.net/fs70/f/2013/076/4/b/jessica2_by_azy0-d5ycket.gif", "lavoro2.php"),
            array("http://fc01.deviantart.net/fs70/f/2013/076/4/b/jessica2_by_azy0-d5ycket.gif", "lavoro2.php"),
            array("http://fc01.deviantart.net/fs70/f/2013/076/4/b/jessica2_by_azy0-d5ycket.gif", "lavoro2.php"),
            array("http://fc01.deviantart.net/fs70/f/2013/076/4/b/jessica2_by_azy0-d5ycket.gif", "lavoro2.php")
        ),
        array(
            array("http://fc08.deviantart.net/fs70/f/2013/121/9/9/freedom_by_azy0-d63p88n.png", "lavoro3.php"),
            array("http://fc08.deviantart.net/fs70/f/2013/121/9/9/freedom_by_azy0-d63p88n.png", "lavoro3.php"),
            array("http://fc08.deviantart.net/fs70/f/2013/121/9/9/freedom_by_azy0-d63p88n.png", "lavoro3.php"),
            array("http://fc08.deviantart.net/fs70/f/2013/121/9/9/freedom_by_azy0-d63p88n.png", "lavoro3.php"),
            array("http://fc08.deviantart.net/fs70/f/2013/121/9/9/freedom_by_azy0-d63p88n.png", "lavoro3.php"),
            array("http://fc08.deviantart.net/fs70/f/2013/121/9/9/freedom_by_azy0-d63p88n.png", "lavoro3.php")
        )
    );
    // Includi head.php
    require_once 'head.php';
?>
<div class="container">
    <?php
    // Includi nav.php
    require_once 'nav.php';
    ?>
    <!-- Testo di introduzione che può essere, ad esempio, una breve spiegazione della mission dell'azienda-->
    <p class="pgallery"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut iaculis nunc, ut sodales ligula. Nam lobortis dui in pulvinar finibus. Donec in nunc et magna consequat commodo. Vestibulum sit amet lacus lorem. Praesent et scelerisque ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris at feugiat magna. Nam ornare lacinia tellus, vel aliquet quam sollicitudin a. Phasellus volutpat et sapien id laoreet. Integer sed nulla vitae nisi molestie pulvinar vel at dolor. Integer quis laoreet eros. Duis porta sapien nisl, non dictum sapien mattis vel.</p>
    <!--Galleria di lavori svolti--> 
    <?php
        // Iterazione attraverso i gruppi e la stampa delle immagini con link
        foreach ($gruppi_immagini as $immagini) {
            echo "<div class='gallery-container'>";
            echo "<div class='gallery-item'>";
            foreach ($immagini as $immagine) {
                echo "<a href='{$immagine[1]}'><img src='{$immagine[0]}' height='100' alt='Immagine'></a>";
            }
            echo "</div>";
            echo "</div>";
        }
    ?>

    <!--Bottoni per la navigazione-->
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