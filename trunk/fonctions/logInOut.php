<?php
    require('utils_bd.php');
    connect();

    function logIn(){
        $login=$_POST["trigramme"];
        $password=$_POST["mdp1"];
        if(isUser2($login,$password)){
            
                $_SESSION['loggedIn']=TRUE;
            
        }
        else{
            echo "D&eacute;sol&eacute;, le site n'est accessible qu'aux gentlemen.";
        }


    }

    function logOut(){
      	session_unset();
	session_destroy();
        
    }



?>
