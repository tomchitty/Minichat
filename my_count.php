<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
}

session_start();

if (!isset($_SESSION['pseudo']))
{
    header("Location: login.php");
}

function get_user_id($pseudo)
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
    $ret = $bdd->query("SELECT id, pseudo FROM user");
    while ($usr = $ret->fetch())
    {
        if (strcmp($pseudo, $usr['pseudo']) == 0)
        {
            $usr_id = $usr['id'];
            return $usr_id;
        }
    }
    return -1;
}

$id_usr = get_user_id($_SESSION['pseudo']);

$req = $bdd->prepare("SELECT * FROM user WHERE id = :id ");
$req->bindValue(':id', $id_usr, PDO::PARAM_STR);
$req->execute();
$info = $req->fetch();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Min!chat - Mon compte</title>
        <meta charset=utf-8">
        <link rel="stylesheet" type="text/css" href="CSS/my_count.css">
        <link rel="stylesheet" type="text/css" href="CSS/default.css">
        <link rel="stylesheet" type="text/css" href="CSS/modif_count.css">
        <link rel="stylesheet" type="text/css" href="CSS/footer.css">
        <link rel="shortcut icon" href="CSS/Images/favicon.ico">
        <script type="text/javascript" src="JS/main.js"></script>
    </head>
    <body>
        <?php include "bandeau.php" ?>
        <h2><img src="CSS/Images/logo_count.png" class="logo_count"/>Mon compte</h2>
        <form action="modif_account.php" method="post" class="modif_account">
            <span title="Champs obligatoire">Pseudo: *</span><br>
            <input type="text" value="<?php echo $info['pseudo'];?>" name="pseudo" autocomplete="off" required/><br><br>
            <span title="Champs obligatoire">Ancien mot de passe: *</span><br>
            <input type="password" name="old_passwd" required/><br><br>
            Nouveau mot de passe:<br>
            <input type="password" name="new_passwd"/><br><br>
            Confirmation mot de passe:<br>
            <input type="password" name="confirm_passwd"/><br><br>
            <a class="modif_avatar" href="modif_photo.php">Modifier mon avatar</a><br>
            <a class="delete_count" href="my_count.php?delete=true">Supprimer mon compte</a><br><br>
            <?php
                if (isset($_GET['delete']) && $_GET['delete'] == true){
                    ?>
                    <div>
                        Voulez vous vraiment supprimer votre compte ?<br>
                        <a href="delete_count.php" id="yes" class="delete_yes">Oui</a>
                        <a href="my_count.php" id="no" class="delete_no">Non</a>
                    </div><br>
            <?php
                }
                if (isset($_GET['required']) && $_GET['required'] == true) {
                    ?>
                    <div class="required_champs">Veuillez compléter tous les champs requis *</div><br>
                    <?php
                }
                    if (isset($_GET['incorrect']) && $_GET['incorrect'] == true) {
                    ?>
                    <div class="required_champs">Mot de passe incorrect</div><br>
            <?php
                }
            ?>
            <input type="submit" value="Valider" class="valid_modif"/>
        </form><br>
        <div class="retour_div">
            <form action="main.php" class="retour_form">
                <input type="submit" value="Retour" class="retour">
            </form>
        </div>
    </body>
<footer>
    <?php include "footer.php";?>
</footer>
</html>
