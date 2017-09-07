<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur: '. $e->getMessage());
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Min!chat - Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <link rel="stylesheet" type="text/css" href="CSS/footer_login.css">
    <link rel="shortcut icon" href="CSS/Images/favicon.ico">
</head>
<body>
    <img class="logo_login" src="CSS/Images/logo_login.png" />
    <h1>Login</h1>
    <form action="check_login.php" method="post">
        <label for="pseudo">Pseudo:</label><br/>
        <input id="pseudo" type="text" name="pseudo" required autofocus/><br><br>
        <label for="mdp">Mot de passe:</label><br />
        <input type="password" name="mdp" required /><br />
        <?php
        if (isset($_GET['error'])){
            echo "<p class='error_login'>". $_GET['error'] ."</p>";
        }
        if (isset($_GET['delete']) && $_GET['delete'] == true){
            echo "<p class='deleted_count'>Votre compte a bien été supprimé</p>";
        }
        ?>
            <a href="create_account.php" class="create_account">Créer un compte</a><br><br>
            <input class="valid" type="submit" value="Se connecter"/>
    </form>
</body>
<footer>
    <?php include "footer.php"; ?>
</footer>
</html>