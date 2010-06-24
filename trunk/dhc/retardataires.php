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

<div id="infos">


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
    $max1=mysql_query($string4);
    $string5="SELECT MAX(TO_DAYS(CURRENT_DATE())-TO_DAYS(`dateemprunt`))
FROM `emprunts` WHERE `trigramme`='$cle' AND `daterendu`=0000-00-00";
    $max2=mysql_query($string5);
    $maxres1=mysql_fetch_assoc($max1);
    $ret1= $maxres1['MAX(TO_DAYS(`daterendu`)-TO_DAYS(`dateemprunt`))'];
    $maxres2=mysql_fetch_assoc($max2);
    $ret2= $maxres2['MAX(TO_DAYS(CURRENT_DATE())-TO_DAYS(`dateemprunt`))'];
    if($ret1>$ret2){
        $retardmax=$ret1;
    }
    else{
        $retardmax=$ret2;
    }
    


    while($pers = mysql_fetch_assoc($mec)){
        $nom=$pers['nom'];
        $prenom=$pers['prenom'];
        $mail=$pers['email'];
        $categorie=$pers['categorie'];

        //echo $mail;
        //echo $nom." ".$prenom."<br/>";
    }
    $nbreretard=0;



?>



    <div id="infos" class="zoneTexteAfficherMasquer" style="font-size:20pt">
        
        <script>
        var nom="<?php echo $prenom." ".$nom; ?>";
        javt[j]=nom;
        j++;
        </script>

            
	    <span class="inviteClic"></span>
	    <div class="TexteAAfficher" style="text-align:center;">
                    <table>
                    <colgroup>
                    <col>
                    <col width="" span="">
                    </colgroup>
                    



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
        $nbreretard++;
?>

                      <tr>
                        <td><?php echo $cat;?></td>
                        <td><?php echo $code;?></td>
                        <td><?php echo $numcode;?></td>
                        <td><?php echo $retard;?></td>
                      </tr>


         


<?php

        
    }

?>
                    
               </table>
                
               <table>
                   <tr>
                       <td><?php echo $cle; ?></td>
                   </tr>
                   <tr>
                       <td><?php echo $categorie; ?></td>
                   </tr>
                   <tr>
                       <td><?php echo "plus grand retard = ".$retardmax;?></td>
                   </tr>
                   <tr>
                       <td><?php echo "nombre de retard = ".$nbreretard;?></td>
                   </tr>
                   <tr>
                       <td><?php echo"<a href=\"mailto:".$mail."\">email</a>"; ?></td>
                   </tr>
               </table>
         </div>
	</div>

<?php
}
?>

</div>
