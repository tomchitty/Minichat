<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 10/07/2017
 * Time: 09:10
 */
?>

<!DOCTYPE html>
<html>
<head>
    <title>Min!chat - Créer un compte</title>
    <link rel="stylesheet" type="text/css" href="CSS/create_account.css">
    <link rel="stylesheet" type="text/css" href="CSS/footer_login.css">
    <link rel="shortcut icon" href="CSS/Images/favicon.ico">
</head>
<body>
    <form action="login.php" class="retour_form">
        <input class="retour" type="submit" value="Retour" />
    </form>
    <h1><img src="CSS/Images/logo_create_count.png" class="logo_create_count"/>Créer un compte</h1>
    <form action="put_account.php" method="post">
        Entrez votre pseudo: <span title="Champs obligatoire">*</span><br />
        <input type="text" name="pseudo" autocomplete="off" required autofocus/><br><br>
        Entrez votre mot de passe: <span title="Champs obligatoire">*</span><br />
        <input type="password" name="mdp1" required/><br /><br>
        Confirmation du mot de passe: <span title="Champs obligatoire">*</span><br />
        <input type="password" name="mdp2" required/><br /><br>
        <?php
            if (isset($_GET['error']) && $_GET['error'] == true){ ?>
                <div class="error_mdp">Les mots de passes ne sont pas similaires</div><br>
                <?php
            }
            if (isset($_GET['required']) && $_GET['required'] == true) { ?>
                <div class="required_champs">Veuillez remplir tous les champs requis *<br>(Le pseudo et le mot de passe doivent être compris entre 3 et 20 caractères)</div><br>
                <?php
        }
        ?>
        <input class="confirmer" type="submit" value="Créer"/>
    </form>
</body>
<footer>
    <?php include "footer.php" ?>
</footer>
</html>
