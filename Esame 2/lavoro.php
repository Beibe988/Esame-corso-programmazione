<?php
$titolo = "Rabbit";
$imglink = "http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg";
$imgalt = "rabbit_doubt_by_azy0-d6lilbm.jpg";
// Array associativo di bottoni con link
$bottone_link = array(
    "Portfolio" => "gallery.php",
    "Contattaci" => "contatti.php"
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
        <h1><?php echo ($titolo)?></h1>
    </header>
    <!--Breve spiegazione dell'immagine affiancata alla stessa-->
    <div class="content">
        <div class="image">
        <?php echo "<img src='$imglink' class='work' alt='$imgalt'>" ?>
        </div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut iaculis nunc, ut sodales ligula. Nam lobortis dui in pulvinar finibus. Donec in nunc et magna consequat commodo. Vestibulum sit amet lacus lorem. Praesent et scelerisque ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris at feugiat magna. Nam ornare lacinia tellus, vel aliquet quam sollicitudin.
        </p>    
    </div>
    <div class="clear"></div>

    <!--Gallery di immagini dello stesso tipo-->      
    <?php include 'ArrayImage1.php'; ?>

    <div class="back">
        <?php
        // Iterazione attraverso l'array e generazione dei bottoni con link
        foreach ($bottone_link as $testo => $link) {
            echo "<a href='$link' class='abutton'>$testo</a>";
        }
        ?>
         

        <!--Mission dell'azienda o breve racconto del tema affrontato per l'immagine-->
        <p class="pgallery"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut iaculis nunc, ut sodales ligula.
            Nam lobortis dui in pulvinar finibus. Donec in nunc et magna consequat commodo. Vestibulum sit amet lacus lorem.
            Praesent et scelerisque ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris at feugiat magna.
            Nam ornare lacinia tellus, vel aliquet quam sollicitudin a. Phasellus volutpat et sapien id laoreet. Integer sed nulla vitae nisi molestie pulvinar vel at dolor.
            Integer quis laoreet eros. Duis porta sapien nisl, non dictum sapien mattis vel.
        </p>    
    </div>

<?php
// Includi footer.php
require_once 'footer.php';
?>