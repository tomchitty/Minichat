<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 24/07/2017
 * Time: 08:49
 */

session_start();

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
}

if (!isset($_SESSION['pseudo']))
{
    header("Location: login.php");
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
    <title>Min!chat - Modifier mon avatar</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/my_count.css">
    <link rel="stylesheet" type="text/css" href="CSS/default.css">
    <link rel="stylesheet" type="text/css" href="CSS/modif_photo.css">
    <link rel="stylesheet" type="text/css" href="CSS/footer_login.css">
    <link rel="shortcut icon" href="CSS/Images/favicon.ico">
</head>
<body>
    <?php include "bandeau.php" ?>
    <h2>Modifier mon avatar</h2>
    <div class="div_avatar">
        <?php
            $path = getUsrAvatar($bdd, $_SESSION['pseudo']);
            echo "<img class='img_bandeau' src='". $path ."'>";
        ?>
    </div><br>
    <div>
        <form enctype="multipart/form-data" action="load_image.php" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
            <label for="file" class="label-file"><span class="fa fa-image"></span> Parcourir...</label><br>
            <input id="file" type="file" name="avatar" class="select_file" size=50 accept=".png,.jpeg,.jpg" /><br>
            <input type="submit" class="load_file" value="Charger" />
        </form>
    </div><br>
    <div class="retour_div">
        <form action="my_count.php" class="retour_form">
            <input type="submit" value="Retour" class="retour">
        </form>
    </div>
    <?php
        if (isset($_GET['error']) && $_GET['error'] == 1){
            echo "<p class='error_transfert'>Erreur lors du transfert</p>";
        }
        if (isset($_GET['error']) && $_GET['error'] == 2){
            echo "<p class='error_transfert'>Fichier non supporté</p>";
        }
    ?>
</body>
<footer>
    <?php include "footer.php" ?>
</footer>
</html>


