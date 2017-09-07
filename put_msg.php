<?php
/**
 * Created by PhpStorm.
 * User: stagiaire3.web
 * Date: 10/07/2017
 * Time: 16:30
 */

session_start();

date_default_timezone_set('Pacific/Noumea');

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
}

function change_msg($msg)
{
    $i = 0;
    while ($msg[$i] == ' ' && $i < strlen($msg)) {
        $i++;
    }
    $i_save = $i;
    $i = strlen($msg) - 1;
    while ($msg[$i] == ' ' && $i > 0){
        $i--;
    }

    $end = $i + 1;
    $i = $i_save;
    $j = 0;
    settype($new, "array");
    while ($i < $end + 1){
        $new[$j] = $msg[$i];
        $j++;
        $i++;
    }
    return implode($new);
}

function addRetourLigne($msg, $len = 50)
{
    $i = 0;
    $j = 0;
    settype($new, "array");
    while ($i < strlen($msg)){
        if ($i % $len == 0 && $i != 0){
            while ($i < strlen($msg) && $msg[$i] != ' '){
                $new[$j] = $msg[$i];
                $i++;
                $j++;
            }
            $new[$j] = "<br />";
            $j++;
        }
        $new[$j] = $msg[$i];
        $j++;
        $i++;
    }
    return implode($new);
}

if (isset($_POST['msg']) && strlen($_POST['msg']) > 0)
{
    $msg = change_msg($_POST['msg']);
    $msg = addRetourLigne($msg, 50);
    $now = date("d/m/Y H:i");
    $req = $bdd->prepare("INSERT INTO chat(pseudo, msg, moment) VALUES(:pseudo, :msg, :moment)");
    $req->execute(array(
       'pseudo' => $_SESSION['pseudo'],
        'msg' => $msg,
        'moment' => $now
    ));
}

header("Location: main.php");