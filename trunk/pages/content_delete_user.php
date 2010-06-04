

<?php



if(isset($_POST["login"]) && isset($_POST["password"]) && isUser2($_POST["login"],$_POST["password"])){
    $login=$_POST["login"];
    $pwd=$_POST["password"];

    connect();
    $qu=mysql_query("DELETE FROM `clients` WHERE `trigramme`='$login' AND `password`='$pwd'");
    $s=mysql_query("SELECT * FROM `clients` WHERE `trigramme`='$login' AND `password`='$pwd'");
    $re=mysql_numrows($s);
    
    if($re>0){
        printDeleteForm();

    }
    else{
        logOut();
    }
    
}

else printDeleteForm();
mysql_close();
?>
