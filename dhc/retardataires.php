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
        echo $day-$day2."<br/>";
        foreach ($tab as $cle=>$val) {
            if($cle!='dateemprunt' && $cle!='daterendu'){
                echo $val."<br/>";
            }
        }
        echo "<br/>";
    }
    
}

?>
