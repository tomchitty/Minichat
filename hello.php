<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 10/08/2017
 * Time: 10:00
 */

if (isset($_SESSION['pseudo'])) {
    $pseudo = $_SESSION['pseudo'];
    date_default_timezone_set('Pacific/Noumea');
    $hour = date('H');
    ?>
    <div id="hello_div">
        <?php
        if ($hour >= 5 && $hour < 18) {
            echo "<p><span class=\"fa fa-handshake-o\"></span> Bonjour ".$pseudo." !</p>";
        } else {
            echo "<p><span class=\"fa fa-handshake-o\"></span> Bonsoir ".$pseudo." !</p>";
        }
        ?>
        <button onclick="hide_popup()" id="close_popup"><span class="fa fa-times"></span> </button>
    </div>
    <?php
}
?>