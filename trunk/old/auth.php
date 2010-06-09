<?php



function isUser($user){
        connect();

        $sql2 =mysql_query("SELECT * FROM `clients` WHERE `trigramme`='$user'");
        $res=mysql_numrows($sql2);
        if($res>0){
            return TRUE;
        }
        else return FALSE;
        mysql_close();
}

function isUser2($user,$pass){
        connect();

        $sq =mysql_query("SELECT * FROM `clients` WHERE `trigramme`='$user' AND `password`='$pass'");
        $rest=mysql_numrows($sq);
        if($rest>0){
            return TRUE;
        }
        else return FALSE;
        mysql_close();
}


?>
