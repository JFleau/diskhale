<script>
$(document).ready(function(){

 //  on sélectionne tous les div avec la classe zoneTexteAfficherMasquer et on les parcours
        $("div.zoneTexteAfficherMasquer").each(function(i){
    // find permet d appliquer un selecteur sur un ensemble selectionné
            $(this).find("div.TexteAAfficher").attr("id","TexteAAfficher"+(i+1)).hide();
            $(this).find("span.inviteClic").attr("id","inviteClic"+(i+1)).html(javt[i]).attr("statut","1").click(
            function(){
                $("#TexteAAfficher"+(i+1)).slideToggle("slow");
                // selon le statut on renomme le texte
                if ($("#inviteClic"+(i+1)).attr("statut")=="1"){
                    $("#inviteClic"+(i+1)).html(javt[i]).attr("statut","0");
                }
                else{
                    $("#inviteClic"+(i+1)).html(javt[i]).attr("statut","1");
                };
            })
        });
    });

</script>



<script>
var j='0';
var javt= new Array();
</script>


<?php
$date=mysql_query("SELECT TO_DAYS(CURRENT_DATE())");
$temps = mysql_fetch_assoc($date);
foreach($temps as $time0=>$time1){
    $day=$time1;
}



$string="SELECT `trigramme` FROM `emprunts` WHERE `daterendu`=0000-00-00  AND
TO_DAYS(CURRENT_DATE())-TO_DAYS(`dateemprunt`)>21 ";
$query=mysql_query($string);
//echo $query;
$t=array();

while ($tab = mysql_fetch_assoc($query)) {
    //echo $tab['trigramme']."<br/>";
    $t[$tab['trigramme']]=1;
}


foreach($t as $cle=>$val){
    $string2="SELECT * FROM `emprunts` WHERE `trigramme`='$cle' AND `daterendu`=0000-00-00  AND
    TO_DAYS(CURRENT_DATE())-TO_DAYS(`dateemprunt`)>21";
    $query2=mysql_query($string2);
    $string3="SELECT * FROM `clients` WHERE `trigramme`='$cle'";
    $mec=mysql_query($string3);
    $string4="SELECT MAX(TO_DAYS(`daterendu`)-TO_DAYS(`dateemprunt`))
FROM `emprunts` WHERE `trigramme`='$cle' AND `daterendu`!=0000-00-00";
    $max=mysql_query($string4);

    while($maxres = mysql_fetch_assoc($max)){
        foreach($maxres as $clemax=>$valuemax){
            $retardmax=$valuemax;
            echo $retardmax;
        }

    }


    while($pers = mysql_fetch_assoc($mec)){
        $nom=$pers['nom'];
        $prenom=$pers['prenom'];
        $mail=$pers['email'];
        $categorie=$pers['categorie'];

        //echo $mail;
        //echo $nom." ".$prenom."<br/>";
    }



?>

    

    <div class="zoneTexteAfficherMasquer">
        
        <script>
        var nom="<?php echo $prenom." ".$nom." ".$categorie." ".$cle; ?>";
        javt[j]=nom;
        j++;
        </script>

            
	    <span class="inviteClic"></span>
	    <div class="TexteAAfficher" style="text-align:center;font-size: large">
            



<?php

    while($res = mysql_fetch_assoc($query2)){
        $dateemprunt=$res['dateemprunt'];
        $date2=mysql_query("SELECT TO_DAYS('$dateemprunt')");
        $temps2=mysql_fetch_assoc($date2);
        foreach($temps2 as $time=>$time2){
            $day2=$time2;
        }

        $cat=$res['categorie'];
        $code=$res['codelettres'];
        $numcode=$res['numero'];
        $retard=$day-$day2;
?>


                <p><?php echo $cat;?></p>
                <p><?php echo $code;?></p>
                <p><?php echo $numcode;?></p>
                <p><?php echo $retard;?></p>
                <p><?php echo $nom." ".$prenom;?></p>
                <br/>
         


<?php

        
    }

?>
               <p><?php echo"<a href=\"mailto:".$mail."\">email</a>"; ?></p>
         </div>
	</div>

<?php
}


?>

