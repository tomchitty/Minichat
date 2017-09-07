<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 24/07/2017
 * Time: 09:19
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

if (isset($_SESSION['pseudo'])){
    $pseudo = $_SESSION['pseudo'];
} else{
    header("Location: modif_photo.php");
    exit();
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

$allowed_format = array('png', 'jpg', 'jpeg', 'gif');
$id_usr = getIdUsr($pseudo);

if ($_FILES['avatar']['error'] > 0) {
    header("Location: modif_photo.php?error=1");
    exit();
}

$upload_format = strtolower(  substr(  strrchr($_FILES['avatar']['name'], '.')  ,1)  );

if ( !in_array($upload_format,$allowed_format)){
    header("Location: modif_photo.php?error=2");
    exit();
}

if (($path = getUsrAvatar($bdd, $pseudo))) {
    unlink($path);
}

$new_path = "./CSS/Images/avatars/{$id_usr}.{$upload_format}";
$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$new_path);

$req = $bdd->prepare("SELECT id FROM image WHERE id_usr = :id_usr");
$req->execute(array(
    'id_usr' => $id_usr
));
$res = $req->fetch();

if (!$res['id']){
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
    $req = $bdd->prepare("INSERT INTO image(path, id_usr) VALUES(:path, :id_usr)");
    $req->execute(array(
        'path' => $new_path,
        'id_usr' => $id_usr
    ));
}

else{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
    $req = $bdd->prepare("UPDATE image SET path = :path WHERE id_usr = :id_usr");
    $req->execute(array(
        'path' => $new_path,
        'id_usr' => $id_usr
    ));
}

header("Location: my_count.php");