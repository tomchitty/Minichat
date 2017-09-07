<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 10/08/2017
 * Time: 16:02
 */

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
}

function getCurrentLastMsg($bdd){
    $req = $bdd->query("SELECT MAX(id) FROM chat");
    $last_msg = $req->fetch();
    return $last_msg[0];
}

$pseudo = $_SESSION['pseudo'];

if (isset($_COOKIE[$pseudo."_lastmsg"])) {
    $last_msg = $_COOKIE[$pseudo . "_lastmsg"];
    $curr_last_msg = getCurrentLastMsg($bdd);
    $nb_msg = $curr_last_msg - $last_msg;
    ?>
    <div id="new_msg_div">
        <p><span class="fa fa-comments"></span> Vous avez <?php echo $nb_msg ?> nouveau(x) message(s)</p>
        <button onclick="hide_popup()" id="close_popup"><span class="fa fa-times"></span> </button>
    </div>
<?php
}
?>