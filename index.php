<?php

session_start();

if (isset($_SESSION['pseudo']) && strlen($_SESSION['pseudo']) > 0){
    header("Location: http://minichat.local/main.php");
}
else{
    session_destroy();
    header("Location: http://minichat.local/login.php");
}
