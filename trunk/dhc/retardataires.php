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

<div id="formulaire" class="formulaire" >
    <h3 style="cursor:default" class="cache">
        <a href="index.php?page=retardataires" style="color: inherit ! important;text-decoration: inherit;">
            Liste des retardataires
        </a>
    </h3>


    <h3 style="cursor:default" class="cache">Chercher des utilisateurs</h3>
    <div>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
        <form action="index.php?page=administration" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0">
    <tr>
    <td width="250" colspan="3">Trigramme</td>
    <td width=""><input type="text" name="trigramme_s" value="<?php if(isset($_POST["trigramme_s"])){ echo $_POST["trigramme_s"];} else {echo"exemple: DHC";}?>" onFocus="this.value=verify(this,'exemple: DHC');" onblur="this.value=verify(this,'exemple: DHC');" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td>Nom</td>
    <td><input type="text" name="nom_s" value="<?php if(isset($_POST["nom_s"])){ echo $_POST["nom_s"];} ?>" /></td>
    <td>Prénom</td>
    <td><input type="text" name="prenom_s" value="<?php if(isset($_POST["prenom_s"])){ echo $_POST["prenom_s"];} ?>" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td colspan="2">Catégorie préférée</td>
    <td colspan="2">
    <select name="categorie_s" style="margin-right:3px; width:230px">
         <option value="">-</option>
         <option value="X2009">X2009</option>
         <option value="X2008">X2008</option>
         <option value="X2007">X2007</option>
         <option value="X2006">X2006</option>
         <option value="X2005">X2005</option>
         <option value="X2004">X2004</option>
         <option value="supoptique">Supoptique</option>
         <option value="profs">Profs</option>
         <option value="masters">Masters</option>
         <option value="labos">Labos</option>

    </select>
    </td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

	</table>
        <input type="hidden" name="action" value="chercher_utilisateur" />

	<div align="right"><input type="reset" value="Annuler" style="margin-top:20px; margin-bottom:20px; margin-right:10px; width:auto"/><input type="submit" value="Chercher" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/></div>
    </form>
    </div>



	<h3>Gestion Utilisateurs</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="index.php?page=administration" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0" align="center">
    <tr>
    <td width="" colspan="3">Trigramme</td>
    <td width=""><input type="text" name="trigramme" value="<?php if(isset($_POST["trigramme"]) && $_POST["trigramme"]!='dhc') echo $_POST["trigramme"];?>" /></td>
    </tr>
    </table>
        <div align="right">
            <input type="hidden" name="action" value="firstrecherche" />
            <input type="reset" value="Annuler" style="margin-top:20px; margin-bottom:20px; margin-right:10px; width:auto"/>
            <input type="submit" value="Lancer la recherche" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/>

        </div>
    </form>


</div>




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

