<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 10/07/2017
 * Time: 10:27
 */

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
}

session_start();

if (!isset($_SESSION['pseudo']) || !isset($_SESSION['id'])|| strlen($_SESSION['pseudo']) == 0)
{
    header("Location: login.php?error=La session a expirée");
}

function getIdUsr($pseudo){
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
    $req = $bdd->prepare("SELECT id FROM user WHERE pseudo = :pseudo_usr");
    $req->execute(array(
        'pseudo_usr' => $pseudo
    ));
    $id = $req->fetch();
    return $id['id'];
}

function getUsrAvatar($bdd, $usr_pseudo){
    $usr_id = getIdUsr($usr_pseudo);
    $req = $bdd->prepare("SELECT path from image WHERE id_usr = :usr_id");
    $req->execute(array(
            'usr_id' => $usr_id
    ));
    $path = $req->fetch();
    return $path['path'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Min!chat</title>
    <meta charset=utf-8">
    <link rel="stylesheet" type="text/css" href="CSS/default.css">
    <link rel="stylesheet" type="text/css" href="CSS/my_count.css">
    <link rel="stylesheet" type="text/css" href="CSS/footer.css">
    <link rel="shortcut icon" href="CSS/Images/favicon.ico">
    <script type="text/javascript" src="JS/main.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <?php
    if ($_SESSION['justlogin']):
        include "hello.php";
        include "new_msg.php";
        $_SESSION['justlogin'] = false;
    endif;
    ?>
    <?php include "bandeau.php"; ?>
    <div class="saisie">
        <form action="put_msg.php" method="post">
            <input type="text" name="msg" class="write" autocomplete="off" placeholder="Ecrire un message..." <?php if (!isset($_GET['max'])){echo 'autofocus';}?>><br />
            <input  class="envoyer" type="submit" value="Envoyer">
        </form><br>
        <form action="main.php">
            <button class="refresh" type="submit">Rafraîchir</button>
        </form>
    </div><br>
    <div class="display_msg">
        <?php
        $aff_max = 15;
        $ancre = 0;
        if (isset($_GET) && isset($_GET['max']) && (int)$_GET['max'] > 0){
            $aff_max = $_GET['max'];
        }
        $ret = $bdd->query("SELECT id, pseudo, msg, moment FROM chat ORDER BY id DESC LIMIT ". $aff_max);
        while ($to_display = $ret->fetch())
        {
            if (($path = getUsrAvatar($bdd, $to_display['pseudo'])) != null){
                echo "<p class='pseudo_msg'><img class='avatar' src=". $path .">  ";
            }
            else{
                echo "<p class='pseudo_msg'>";
            }
            echo "<strong>". $to_display['pseudo'] . "</strong> - " . $to_display['moment'] .
                "<button class='hide_msg' id=\"btn_".$to_display['id']."\" onclick='hide_msg(".$to_display['id'].")'>^</button>";
                if ($to_display['pseudo'] == $_SESSION['pseudo']){
                    echo "<a onclick='sure(".$to_display['id'].")' onmouseout='reset_trash(".$to_display['id'].")' onmouseover='change_trash(".$to_display['id'].")' id='delete_msg_".$to_display['id']."'><img title='Effacer' id='trash1' class='trash1' src='CSS/Images/trash1.png'/></a>";
                }
                echo "</p>"
                . "<p id=\"msg_". $to_display['id']."\">" . $to_display['msg'] . "</p>";
            $ancre = $to_display['id'];
        }
        ?>
        <?php if ($ancre != 1): ?>
        <a class="dis_more" href="<?php echo 'main.php?max='.($aff_max + 10).'#msg_'.($ancre + 5) ?>">Afficher plus de message...</a>
        <?php endif ?>
    </div>
</body>
<footer>
    <?php include "footer.php"?>
</footer>
</html>
