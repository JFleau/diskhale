<!--    <SCRIPT language=javascript>
       
   function ConfirmMessage() {
       var u=false;
       if (confirm("Voulez vous supprimer l\'utilisateur ?")) { // Clic sur OK
           u=true;
           
       }
       return u;
       
      
   }
   
    </SCRIPT>

-->


<div id="formulaire" class="formulaire" style="height:200px;">
	<h3>Traiter Client</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post">
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


<?php

        if(isset($_POST['supprimer']) && $_POST['supprimer']=="supprimer"){
//            $valeurphp = "<script language='Javascript'> if(ConfirmMessage()){document.write(\"tos\");}
//        else{document.write(\"\");} </script>";
//            echo $valeurphp."<br/>";
//            echo is_null($valeurphp);
//            echo "ta gueule";
//            echo is_string($valeurphp);
//           }
//
//
//         if($valeurphp==="tos"){
//            echo "va te faire foutre <br/>";
            $trigramme=$_POST['trigramme'];
            $suppression=suppr_trig($trigramme);

        }

if(isset($_POST["trigramme"]) && $_POST['trigramme']!=""){
    $trigramme=$_POST["trigramme"];
    $s="SELECT * FROM `clients` WHERE `trigramme`='$trigramme'";
    $q=mysql_query($s);
    $n=mysql_numrows($q);
    if($n>0){

?>

<div id="formulaire" class="formulaire" style="height:170px;">
	<h3>Ajouter un emprunt</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0" align="center">
    <tr>
    <td width="" colspan="3">Code lettre</td>
    <td width=""><input type="text" name="codelettres" value="<?php if(isset($_POST["codelettres"])) echo $_POST["codelettres"];?>" /></td>
    </tr>
    <tr>
    <td width="" colspan="3">Numero</td>
    <td width=""><input type="text" name="numero" value="<?php if(isset($_POST["numero"])) echo $_POST["numero"];?>" /></td>
    </tr>
    </table>
        <div align="right">
            <input type="hidden" name="action" value="firstrecherche" />
            <input type="hidden" name="trigramme" value="<?php echo $trigramme;?>" />
            <input type="reset" value="Annuler" style="margin-top:20px; margin-bottom:20px; margin-right:10px; width:auto"/>
            <input type="submit" value="Emprunter" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/>
        </div>
    </form>
</div>

<?php
    }
}

?>


<div id="infos" style="height:800px;">
    <b>
      <a href="index.php?page=retardataires"
         style="color: inherit ! important;text-decoration: inherit; font-size:15pt "/>
      Liste des retardataires</a><br/>
    </b>

<?php


        


if(isset($_POST["trigramme"]) && $_POST['trigramme']!=""){
    $trigramme=$_POST["trigramme"];
    $string="SELECT * FROM `clients` WHERE `trigramme`='$trigramme'";
    $query=mysql_query($string);
    $nres=mysql_numrows($query);
    $tab = mysql_fetch_assoc($query);
        $nom=$tab['nom'];
        $prenom=$tab['prenom'];
        $remarque=$tab['remarques'];
        $categorie=$tab['categorie'];
        $mail=$tab['email'];
        $tel=$tab['telephone'];
        $nbmax=$tab['nbmax'];
        $kzert=$tab['kazert'];
        $cotis=$tab['cotisation'];
        $caution=$tab['caution'];
    
    
    if($nres!=0){



        //affichage de l emprunteur
        echo '<div id="headresultats"><h3 style="padding-left:10px">Utilisateur : '.$nom.' '.$prenom.'</h3>';
        echo '</div>';

        ?>
    <div id="bodyresultats">
   <!--    <table border="0" style="margin:20px; margin-bottom:5px">
        <tr>
            t
        </tr>
        $nom." ".$prenom.'</h3>'.      
        $remarque.'</h3>'.
        $tel.'</h3>'.
        $nbmax.'</h3>'.
        $kzert.'</h3>'.
        $remarques.'</h3>'.
        <a href=\"mailto:".$mail."\">email</a>
   -->

        <table >
            <colgroup>
            <col>
            <col width="" span="">
            </colgroup>
            <tr>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Kazert</td>
                <td>Telephone</td>

            </tr>
            <tr>
                <td><?php echo $nom;?></td>
                <td><?php echo $prenom;?></td>
                <td><?php echo $kzert;?></td>
                <td><?php echo $tel;?></td>
                
            </tr>

        <tr>
            <td>Nombre maximal</td>
            <td>Caution</td>
            <td>Cotisation</td>
            <td>Remarques</td>
        </tr>
        <tr>
            <td><?php echo $nbmax;?></td>
            <td><?php echo $cotis;?></td>
            <td><?php echo $caution;?></td>
            <td><?php echo $remarque;?></td>
        </tr>
    </table>

   <br/>
   <br/>






   


    
    <form method="post" action="">

        <input type="hidden" name="trigramme" value="<?php if(isset($_POST['trigramme'])){echo $_POST['trigramme'];}?>"/>
        <input type="hidden" name="supprimer" value="supprimer"/>
        <input type="submit" value="Supprimer" />
    </form>

      <br/>
   <br/>
   <?php echo $suppression;?>
      <br/>
   <br/>
      <br/>
   <br/>
      <br/>
   <br/>

    <?php
  

//    if($cotis=="non"){
//        echo "<h3>Cotisation non payee</h3>";
//    }
//    if($caution=="non"){
//        echo "<h3>Caution non payee</h3>";
//    }

    

    









?>







<?php
}
}
    //ajout d'emprunts;
    if(isset($_POST['codelettres']) && $_POST['codelettres']!=""
        && isset($_POST['numero']) && $_POST['numero']!=""){
        emprunter($trigramme);

    }

    if(isset($_POST["trigramme"]) && $_POST['trigramme']!=""){
        $trigramme=$_POST["trigramme"];
        $s="SELECT * FROM `clients` WHERE `trigramme`='$trigramme'";
        $q=mysql_query($s);
        $n=mysql_numrows($q);
        if($n>0){

    ?>
              <table >
            <colgroup>
            <col>
            <col width="" span="">
            </colgroup>
            <tr>
                <td>Categorie</td>
                <td>Oeuvre</td>
                <td>Composieurs</td>
                <td>Interpretes</td>
                <td>Remarques</td>
                <td>Code lettres</td>
                <td>Numero</td>
                <td>Operation</td>
            </tr>

                <?php
    }
    }

//affichage des disques empruntés.

$string2="SELECT * FROM `emprunts` WHERE `trigramme`='$trigramme' AND `daterendu`=0000-00-00 ";
    $query2=mysql_query($string2);
    while($tab2 = mysql_fetch_assoc($query2)){
        $code=$tab2['codelettres'];
        $numero=$tab2['numero'];
        $categorie=$tab2['categorie'];
        if($tab2['categorie']!=""){ $categorie=$categorie."<br/>";}

        $string3="SELECT * FROM `disques` WHERE `codelettres`='$code' AND `numero`='$numero' ";
        $query3=mysql_query($string3);
        while($tab3 = mysql_fetch_assoc($query3)){
            $oeuvres=$tab3['oeuvres'];
            $compositeurs=$tab3['compositeurs'];
            $interpretes=$tab3['interpretes'];
            $rem=$tab3['remarques'];
            if($tab3['oeuvres']!=""){ $oeuvres=$oeuvres."<br/>";}
            if($tab3['compositeurs']!=""){ $compositeurs=$compositeurs."<br/>";}
            if($tab3['interpretes']!=""){ $interpretes=$interpretes."<br/>";}
            if($tab3['remarques']!=""){ $rem=$rem."<br/>";}
        }

        if(isset($_POST['rendre']) && $_POST['rendre']==$code.$numero){
            $string4="UPDATE `emprunts` SET `daterendu`=CURRENT_DATE() WHERE `codelettres`='$code' AND `numero`='$numero'";
            $query4=mysql_query($string4);
        } else{
        //echo $categorie.$oeuvres.$compositeurs.$interpretes.$rem.$code." ".$numero."<br/>";  //affichage des disques empruntés.
        
        ?>
   


            <tr>
                <td><?php echo $categorie;?></td>
                <td><?php echo $oeuvres;?></td>
                <td><?php echo $interpretes;?></td>
                <td><?php echo $compositeurs;?></td>
                <td><?php echo $rem;?></td>
                <td><?php echo $code;?></td>
                <td><?php echo $num;?></td>
                <td>
                    <form action="" method="post">
                        <input type="submit" value="rendre" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/>
                        <input type="hidden" name="trigramme" value="<?php echo $trigramme;?>" />
                        <input type="hidden" name="rendre" value="<?php echo $code.$numero;?>" />
                    </form>
                </td>
                
            </tr>


  



        <?php
        }

        ?>
         

        
   <?php

}
?>
</table>
</div>


