<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 24/07/2017
 * Time: 16:17
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

$pseudo = $_SESSION['pseudo'];
$id = $_SESSION['id'];

$ret = $bdd->prepare("DELETE FROM image WHERE id_usr = :id");
$ret->execute(array(
    'id' => $id
));

$ret = $bdd->prepare("DELETE FROM user WHERE id = :id");
$ret->execute(array(
    'id' => $id
));

$bdd->query("ALTER TABLE user AUTO_INCREMENT = 0");
$bdd->query("ALTER TABLE image AUTO_INCREMENT = 0");

header("Location: login.php?delete=true");

