<?php
    require('utils_bd.php');
    connect();

    function logIn(){
        $login=$_POST["trigramme"];
        $password=$_POST["mdp1"];
        if(isUser2($login,$password)){
            
                $_SESSION['loggedIn']=1;
            
        }
        else{
            echo "D&eacute;sol&eacute;, le site n'est accessible qu'aux gentlemen.";
        }


    }

    function logOut(){
      	session_unset();
	session_destroy();
        
    }

    function logAdmin(){
        
        if(isset($_POST["trigramme"]) && $_POST["trigramme"]!="" &&
            isset($_POST["mdp1"]) && $_POST["mdp1"]!="" ){
                $login=$_POST["trigramme"];
                $password=$_POST["mdp1"];
                if($login=="dhc" && $password=="melodix"){
                    $_SESSION['loggedIn']=2;
                }
                else{
                    echo "D&eacute;sol&eacute;, le site n'est accessible qu'aux gentlemen.";
                }

        }
        else{
            printAdminForm();
        }

    }



?>
