<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 13/07/2017
 * Time: 14:22
 */

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
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

session_start();

$id_usr = get_user_id($_SESSION['pseudo']);
$req = $bdd->prepare("SELECT * FROM user WHERE id = :id ");
$req->bindValue(':id', $id_usr, PDO::PARAM_STR);
$req->execute();
$info = $req->fetch();

if (!$info)
{
    header("Location: my_count.php");
    exit();
}

if (isset($_POST) && isset($_POST['pseudo']) && strlen($_POST['pseudo']) > 0)
{
    if (isset($_POST['old_passwd']) && isset($_POST['new_passwd']) && isset($_POST['confirm_passwd']))
    {
        if (strcmp($_POST['old_passwd'], $info['mdp']) == 0)
        {
            if (strcmp($_POST['new_passwd'], $_POST['confirm_passwd']) == 0 && strlen($_POST['new_passwd']) != 0)
            {
                $req = $bdd->prepare("UPDATE user SET pseudo = :pseudo, mdp = :mdp WHERE id = :id");
                $req->execute(array(
                    'pseudo' => $_POST['pseudo'],
                    'mdp' => $_POST['new_passwd'],
                    'id' => $id_usr
                ));
                $_SESSION['pseudo'] = $_POST['pseudo'];
            }

            elseif (strlen($_POST['old_passwd']) > 0) {
                $req = $bdd->prepare("UPDATE user SET pseudo = :pseudo WHERE id = :id");
                $req->execute(array(
                    'pseudo' => $_POST['pseudo'],
                    'id' => $id_usr
                ));
                $_SESSION['pseudo'] = $_POST['pseudo'];
            }

            else
            {
                header("Location: my_count.php");
                exit;
            }
        }
        else
        {
            if (strlen($_POST['old_passwd']) > 0 && strcmp($_POST['old_passwd'], $info['mdp']) == 0) {
                $req = $bdd->prepare("UPDATE user SET pseudo = :pseudo WHERE id = :id");
                $req->execute(array(
                    'pseudo' => $_POST['pseudo'],
                    'id' => $id_usr
                ));
                $_SESSION['pseudo'] = $_POST['pseudo'];
            }
            elseif (strlen($_POST['old_passwd']) > 0 && strcmp($_POST['old_passwd'], $info['mdp']) != 0) {
                header("Location: my_count.php?incorrect=true");
                exit;
            }
            else {
                header("Location: my_count.php?required=true");
                exit;
            }
        }
        header("Location: main.php");
    }
    else
    {
        header("Location: my_count.php");
    }
}

else
{
    header("Location: my_count.php?required=true");
}