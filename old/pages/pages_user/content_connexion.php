<?php
//require('utils.php');
//$askedPage='connexion';



//    if(isset($_POST["trigramme"]) && $_POST["trigramme"] != "" &&
//    isset($_POST["mdp1"]) && $_POST["mdp1"]!=""){
//
//       logIn();
//
//    }

    //$currentPage=$_SESSION['currentPage'];
//    echo $currentPage;
//    echo "ja";
//    echo $askedPage;
   
    if ($_SESSION["loggedIn"]==0) {
            
            printLoginForm($askedPage);
//            echo $currentPage;
    }

?>

