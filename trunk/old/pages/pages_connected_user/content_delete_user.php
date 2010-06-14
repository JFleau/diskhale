

<?php

$askedPage='suppression';

if(isset($_POST["login"]) && isset($_POST["password"]) && isUser2($_POST["login"],$_POST["password"])){
    $login=$_POST["login"];
    $pwd=$_POST["password"];

    
    if(isUser2($login,$pwd)){
        connect();
        $qu=mysql_query("DELETE FROM `clients` WHERE `trigramme`='$login' AND `password`='$pwd'");
        logOut();
        mysql_close();
    }
    else{
        echo "suppression non autrisee";
    }
    
//    $s=mysql_query("SELECT * FROM `clients` WHERE `trigramme`='$login' AND `password`='$pwd'");
//    $re=mysql_numrows($s);
   
//    if($re>0){
//        printDeleteForm();
//
//    }
//    else{
//        logOut();
//    }
    
}

else {
    printDeleteForm($askedPage);
}


?>
