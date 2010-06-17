<?php
$date=mysql_query("SELECT TO_DAYS(CURRENT_DATE())");
$temps = mysql_fetch_assoc($date);
foreach($temps as $time0=>$time1){
    $day=$time1;
}



$string="SELECT * FROM `emprunts` WHERE `daterendu`=0000-00-00";
$query=mysql_query($string);
while ($tab = mysql_fetch_assoc($query)) {
    $dateemprunt=$tab['dateemprunt'];
    $date2=mysql_query("SELECT TO_DAYS('$dateemprunt')");
    $temps2=mysql_fetch_assoc($date2);
    foreach($temps2 as $time=>$time2){
        $day2=$time2;
    }

    if($day-$day2>21){
        $r=$day-$day2;
        echo "retard => ".$r."<br/>";
        foreach ($tab as $cle=>$val) {
            if($cle=='categorie'){
                $cat=$val;
                echo $val."<br/>";                      //revoir la mise en page
            }
            if($cle=='trigramme'){
                $strtri="SELECT * FROM `clients` WHERE `trigramme`='$val'";
                $mec=mysql_query($strtri);
                while($pers = mysql_fetch_assoc($mec)){
                    foreach($pers as $cle2=>$val2){
                        if($cle2=='prenom'){
                            echo $val2." ";
                        }
                        if($cle2=='nom'){
                            echo $val2." ";
                        }
                    }
                }
                echo "<br/>";
            }
            if($cle=='codelettres'){
                $code=$val;
                echo $val."<br/>";
            }
            if($cle=='numero'){
                $numcode=$val;
                echo $val."<br/>";
            }



             
        }
        echo "<br/>";
    }
    
}

?>
