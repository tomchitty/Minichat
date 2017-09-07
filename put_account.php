<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 10/07/2017
 * Time: 09:16
 */

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
}

function check_spaces($str)
{
    for ($i = 0; $i <= strlen($str); $i++)
    {
        if ($str[$i] == ' ')
        {
            return -1;
        }
    }
    return 0;
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

if (isset($_POST) && isset($_POST['pseudo']) && isset($_POST['mdp1']) && isset($_POST['mdp2']) &&
    strlen($_POST['pseudo']) >= 3 && strlen($_POST['mdp1']) >= 3 && strlen($_POST['mdp2']) >= 3 &&
    strlen($_POST['pseudo']) < 20)
{
    if (strcmp($_POST['mdp1'], $_POST['mdp2']) == 0 &&
        check_spaces($_POST['pseudo']) == 0 && check_spaces($_POST['mdp1']) == 0)
    {
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp1'];
        $req = $bdd->prepare("INSERT INTO user(pseudo, mdp) VALUES(:pseudo, :mdp)");
        $req->execute(array(
            'pseudo' => $pseudo,
            'mdp' => $mdp
        ));
        session_start();
        $id = getIdUsr($pseudo);
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['id'] = $id;

        $path = "./CSS/Images/avatars/". $id .".png";
        copy("./CSS/Images/avatar_default.png", $path);
        $req = $bdd->prepare("INSERT INTO image(path, id_usr) VALUES(:path, :id_usr)");
        $req->execute(array(
            'path' => $path,
            'id_usr' => $id
        ));

        header("Location: main.php");
    }
    else
    {
        header("Location: create_account.php?error=true");
        exit;
    }
}
else
{
    header("Location: create_account.php?required=true");
}