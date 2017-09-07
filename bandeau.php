<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
}
catch(Exception $e)
{
    die('Erreur: '. $e->getMessage());
}

function getUsrId($pseudo){
    $bdd = new PDO('mysql:host=localhost;dbname=minichat', 'root', '');
    $req = $bdd->prepare("SELECT id FROM user WHERE pseudo = :pseudo_usr");
    $req->execute(array(
        'pseudo_usr' => $pseudo
    ));
    $id = $req->fetch();
    return $id['id'];
}

function getUsrAvatarB($bdd, $usr_pseudo){
    $usr_id = getUsrId($usr_pseudo);
    $req = $bdd->prepare("SELECT path from image WHERE id_usr = :usr_id");
    $req->execute(array(
        'usr_id' => $usr_id
    ));
    $path = $req->fetch();
    return $path['path'];
}
?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div class="bandeau">
    <a href="main.php"><img src="CSS/Images/logo.png" class="logo_img"></a>
    <h1 class="title">Min!chat</h1>
    <div class="dropdown_div">
        <button class="dropdown_btn"><span class="fa fa-bars"></span> Menu</button>
        <div class="dropdown_content">
            <a href="main.php"><span class="fa fa-home"></span> Acceuil<span id="cur1" class="fa fa-circle-o"></span></a>
            <a href="my_count.php"><span class="fa fa-user"></span> Mon compte<span id="cur2" class="fa fa-circle-o"></span></a>
            <a href="logout.php"><span class="fa fa-sign-out"></span> Déconnexion<span id="cur3" class="fa fa-circle-o"></span></a>
        </div>
    </div>
</div><br><br><br><br>
