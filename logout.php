<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 11/07/2017
 * Time: 09:09
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

function getLastMsg($bdd){
    $req = $bdd->query("SELECT MAX(id) FROM chat");
    $last_msg = $req->fetch();
    return $last_msg[0];
}

function putLastMsgInCookie($bdd, $pseudo){
    $last_msg = getLastMsg($bdd);
    setcookie($pseudo."_lastmsg", $last_msg, time() + 365*24*3600);
}

$pseudo = $_SESSION['pseudo'];
if ($pseudo){
    putLastMsgInCookie($bdd, $pseudo);
}

session_start();
$_SESSION['pseudo'] == '';
session_destroy();

header("Location: login.php");