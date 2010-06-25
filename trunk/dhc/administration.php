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
<?php

                if(isset($_POST['trig']) && $_POST['trig']!=""){
                    $tri=$_POST['trig'];
                    modifier($tri);
                }
       
?>




<div id="formulaire" class="formulaire" >
    <h3 style="cursor:default" class="cache">
        <a href="index.php?page=retardataires" style="color: inherit ! important;text-decoration: inherit;">
            Liste des retardataires
        </a>
    </h3>


    <h3 style="cursor:default" class="cache">Chercher des utilisateurs</h3>
    <div>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
        <form action="index.php?page=recherche_user" method="post">
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
    <td colspan="2">Catégorie</td>
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



    <?php
    if(isset($_POST['modifier_admin']) && $_POST['modifier_admin']=="modifier_admin"){

    ?>

    <h3 style="cursor:default">Modifier un compte</h3>
    <div>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
        <form action="" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0">
    <tr>
    <td width="250" colspan="3">Trigramme souhaité</td>
    <td width=""><input type="text" name="trigramme2" value="<?php if(isset($_POST["trigramme2"])){ echo $_POST["trigramme2"];} else {echo"exemple: DHC";}?>" onFocus="this.value=verify(this,'exemple: DHC');" onblur="this.value=verify(this,'exemple: DHC');" /></td>
    </tr>
    <tr>
    <td colspan="3">Nouveau mot de passe</td>
    <td><input type="password" name="password" /></td>
    </tr>
    <tr>
    <td colspan="3">Confirmer le mot de passe</td>
    <td><input type="password" name="password2" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td>Nom</td>
    <td><input type="text" name="nom" value="<?php if(isset($_POST["nom"])){ echo $_POST["nom"];} ?>" /></td>
    <td>Prénom</td>
    <td><input type="text" name="prenom" value="<?php if(isset($_POST["prenom"])){ echo $_POST["prenom"];} ?>" /></td>
    </tr>
    <tr>
    <td>Kasert</td>
    <td><input type="text" name="kazert" value="<?php if(isset($_POST["kazert"])){ echo $_POST["kazert"];} else {echo"exemple: 691009";}?>" onFocus="this.value=verify(this,'exemple: 691009');" onblur="this.value=verify(this,'exemple: 691009');" /></td>
    <td>Téléphone</td>
    <td><input type="text" name="telephone" value="<?php if(isset($_POST["telephone"])){ echo $_POST["telephone"];} else {echo"exemple: 6419";}?>" onFocus="this.value=verify(this,'exemple: 6419');" onblur="this.value=verify(this,'exemple: 6419');" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td>e-mail</td>
    <td colspan="3" style="font-weight:normal; text-align:left">
    <input type="text" name="email" style="width:240px;" value="<?php if(isset($_POST["email"])){ echo $_POST["email"];} else {echo "exemple: pierre.dupont";}?>" onFocus="this.value=verify(this,'exemple: pierre.dupont');" onblur="this.value=verify(this,'exemple: pierre.dupont');" />
    <select name="ecole" style="margin-right:3px; width:150px;">
    	<option value="@polytechnique.edu">@polytechnique.edu</option>
        <option value="@institutoptique.fr">@institutoptique.fr</option>
    </select></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td colspan="2">Catégorie préférée</td>
    <td colspan="2">
    <select name="categorie" style="margin-right:3px; width:230px">
         <option value="">-</option>
         <option value="classique">Classique</option>
         <option value="opera">Op&eacute;ra</option>
         <option value="interprete">Interprète</option>
         <option value="jazz">Jazz</option>
         <option value="varietes">Vari&eacute;t&eacute;s</option>
         <option value="film">Musique de film</option>
         <option value="compil">Compilations</option>
         <option value="anc">Musique ancienne + Liturgies</option>
         <option value="tradi">Musiques traditionnelles</option>
         <option value="electro">Electromusique</option>
         <option value="mili">Musique militaire</option>
         <option value="part">Partitions</option>
    </select>
    </td>
    </tr>
    <tr>
    <td colspan="4">Recevoir la newsletter de cette catégorie :
    <input checked="true" name="statut" value="oui" type="radio" style="width:20px; border:none" />oui
    <input name="news" value="non" type="radio"  style="width:20px; border:none" />non
    <input type="hidden" name="action" value="modifier" /></td>
    </tr>

    <tr>
    <td>Cotisation</td>
        <td>
            <input  name="cotisation" value="oui" type="radio" style="width:20px; border:none" />oui
            <input  name="cotisation" value="non" type="radio"  style="width:20px; border:none" />non
        </td>
    <td>Caution</td>
        <td>
            <input  name="caution" value="oui" type="radio" style="width:20px; border:none" />oui
            <input  name="caution" value="non" type="radio"  style="width:20px; border:none" />non
        </td>
    </tr>

    <tr>
    <td>Nombre maximal</td>
    <td><input type="text" name="nbmax" value="<?php if(isset($_POST["nbmax"])){ echo $_POST["nbmax"];} ?>"  /></td>
    <td>Remarques</td>
    <td><input type="text" name="remarques" value="<?php if(isset($_POST["remarques"])){ echo $_POST["remarques"];} ?>"/></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

	</table>

	<div align="right">
            <input type="reset" value="Annuler" style="margin-top:20px; margin-bottom:20px; margin-right:10px; width:auto"/>
            <input type="submit" value="Modifier" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/>
            <input type="hidden" name="trig" value="<?php echo $_POST['trigramme'];?>"/></div>
    </form>
    </div>

    <?php
    }
    ?>


    
    


    
    



	<h3 style="cursor:default" class="cache"/>Gestion Utilisateurs</h3>
        <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
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


	<h3 style="cursor:default" class="cache">Ajouter un emprunt</h3>
        <div>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0">
    <tr>
    <td width="" colspan="3">Code lettre</td>
    <td width=""><input type="text" name="codelettres" value="<?php if(isset($_POST["codelettres"])) echo $_POST["codelettres"];?>" /></td>
    </tr>
    <tr>
    <td width="" colspan="3">Numero</td>
    <td width=""><input type="text" name="numero" value="<?php if(isset($_POST["numero"])) echo $_POST["numero"];?>" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

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


</div>

   






<div id="infos" style="height:800px;">


<?php

if(isset($_POST['retard']) && $_POST['retard']=="retard"){
    retard();
}
else{


        


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
                <td style="background-color:#39389a; border-left-color:#39389a;">Nom</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Prenom</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Trigramme</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Kazert</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Telephone</td>

            </tr>
            <tr>
                <td><?php echo $nom;?></td>
                <td><?php echo $prenom;?></td>
                <td><?php echo $trigramme;?></td>
                <td><?php echo $kzert;?></td>
                <td><?php echo $tel;?></td>
                
            </tr>
            <tr >
                <td style="background-color:#ececec; border-left-color:#ececec;"></td>
                <td style="background-color:#ececec; border-left-color:#ececec;"></td>
                <td style="background-color:#ececec; border-left-color:#ececec;"></td>
                <td style="background-color:#ececec; border-left-color:#ececec;"></td>
                <td style="background-color:#ececec; border-left-color:#ececec;"></td>
            <tr/>

            <tr>
                <td style="background-color:#39389a; border-left-color:#39389a;">Nombre maximal</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Caution</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Cotisation</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Remarques</td>
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
        <input type="hidden" name="modifier_admin" value="modifier_admin"/>
        <input type="submit" value="Modifier" />

    </form>

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

    

    




    }




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
                <td style="background-color:#39389a; border-left-color:#39389a;">Categorie</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Oeuvre</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Composieurs</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Interpretes</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Remarques</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Code lettres</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Numero</td>
                <td style="background-color:#39389a; border-left-color:#39389a;">Operation</td>
            </tr>

                <?php
    }
    }

//affichage des disques empruntés.

if(isset($_POST["trigramme"]) && $_POST['trigramme']!=""){
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
                <td><?php echo $numero;?></td>
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
    }



}

//echo $_POST['trigramme'];
?>
</table>
</div>


