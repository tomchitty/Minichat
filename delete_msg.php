<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 08/08/2017
 * Time: 11:55
 */

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
}

function resetIdMSG($bdd){
    $i = 1;
    $res = $bdd->query("SELECT id FROM chat ORDER BY id");
    while ($list = $res->fetch()){
        $req = $bdd->prepare("UPDATE chat SET id = :i WHERE id = :id");
        $req->execute(array(
            'i' => $i,
            'id' => $list['id']
        ));
        $i++;
    }
}

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $req = $bdd->prepare("DELETE FROM chat WHERE id = :id");
    $req->execute(array(
       'id' => $id
    ));

    resetIdMsg($bdd);
    $bdd->query("ALTER TABLE chat AUTO_INCREMENT = 1");
    header("Location: main.php");
}

else{
    header("Location: main.php");
}