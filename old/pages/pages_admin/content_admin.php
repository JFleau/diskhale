<?php

//    if(isset($_POST["trigramme"]) && $_POST["trigramme"]!="" &&
//                isset($_POST["mdp1"]) && $_POST["mdp1"]!="" ){
//
//            logAdmin();
//    }

    if($_SESSION["loggedIn"]<2){
        printAdminForm($askedPage);
    }
    echo !$_SESSION["loggedIn"]<2;







?>
