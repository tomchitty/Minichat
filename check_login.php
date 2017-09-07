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

function check_user($pseudo)
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

function check_passwd($id, $input)
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
    $req = $bdd->prepare("SELECT mdp FROM user WHERE id = :id ");
    $req->bindValue(':id', $id, PDO::PARAM_STR);
    $req->execute();
    $passwd = $req->fetch();
    if (strcmp($input, $passwd['mdp']) == 0)
    {
        return true;
    }
    return false;
}

if (isset($_POST['pseudo']) && isset($_POST['mdp']) &&
    strlen($_POST['pseudo']) > 3 && strlen($_POST['mdp']) > 3)
{
    $user_id = check_user($_POST['pseudo']);
    $is_allowed = check_passwd($user_id, $_POST['mdp']);
    if ($user_id > 0 && $is_allowed == true)
    {
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $_SESSION['id'] = $user_id;
        $_SESSION['justlogin'] = true;
        header("Location: http://minichat.local/main.php");
    }
    else
    {
        $msg = "Pseudo ou mot de passe incorrect";
        header("Location: http://minichat.local/login.php?error=". $msg);
    }
}

else
{
    header("Location: http://minichat.local/login.php");
}