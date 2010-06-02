<?php
//require('utils.php');
$askedPage='connexion';



    if(isset($_POST["trigramme"]) && $_POST["trigramme"] != "" &&
    isset($_POST["mdp1"])){
        
       logIn();

    }
    
    if (!$_SESSION["loggedIn"]) {
            printLoginForm($askedPage);
    }

?>

