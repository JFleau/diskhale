<div id="formulaire" class="formulaire" style="height:200px;">
	<h3>Traiter Client</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0" align="center">
    <tr>
    <td width="" colspan="3">Trigramme</td>
    <td width=""><input type="text" name="trigramme" value="<?php if(isset($_POST["trigramme"])) echo $_POST["trigramme"];?>" /></td>
    </tr>
    </table>
        <div align="right">
            <input type="hidden" name="action" value="firstrecherche" /><input type="reset" value="Annuler" style="margin-top:20px; margin-bottom:20px; margin-right:10px; width:auto"/>
            <input type="submit" value="Lancer la recherche" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/>
        </div>
    </form>
</div>

<a href="index.php?page=retardataires"/>Liste des retardataires</a><br/>



<?php

if(isset($_POST["trigramme"])){
    $trigramme=$_POST["trigramme"];
    $string="SELECT * FROM `clients` WHERE `trigramme`='$trigramme'";
    $query=mysql_query($string);
    while($tab = mysql_fetch_assoc($query)){
        $nom=$tab['nom'];
        $remarque=$tab['remarques'];
        $categorie=$tab['categorie'];
        $mail=$tab['email'];
        $tel=$tab['telephone'];
        $nbmax=$tab['nbmax'];
        $kzert=$tab['kazert'];
        $cotis=$tab['cotisation'];
        $caution=$tab['caution'];
    }


    //affichage de l emprunteur
    echo '<div id="headresultats"><h3 style="padding-left:10px">'.$nombre.' Traiter Client</h3>';
    echo '</div>';
    echo '<div id="bodyresultats">';
    echo '<table border="0" style="margin:20px; margin-bottom:5px">
    <tr>
    <h3>'.$nom." ".$prenom.'('.$categorie.')'.'</h3>'.      //affichage de l'emprunteur
    '<h3>'.$remarque.'</h3>'.
    '<h3>'.$tel.'</h3>'.
    '<h3>'.$nbmax.'</h3>'.
    '<h3>'.$kzert.'</h3>'.
    '<h3>'.$remarques.'</h3>'.
    "<h3><a href=\"mailto:".$mail."\">email</a></h3>";

    if($cotis=="non"){
        echo "<h3>Cotisation non payee</h3>";
    }
    if($caution=="non"){
        echo "<h3>Caution non payee</h3>";
    }









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


</div>

<?php
    //ajout d'emprunts;
    if(isset($_POST['codelettres']) && $_POST['codelettres']!=""
        && isset($_POST['numero']) && $_POST['numero']!=""){
        emprunter($trigramme);

    }

//affichage des disques empruntés.

$string2="SELECT * FROM `emprunts` WHERE `trigramme`='".$trigramme."' AND `daterendu`=0000-00-00 ";
    $query2=mysql_query($string2);
    while($tab2 = mysql_fetch_assoc($query2)){
        $code=$tab2['codelettres'];
        $numero=$tab2['numero'];
        $categorie=$tab2['categorie'];
        if($tab2['categorie']!=""){ $categorie=$categorie."<br/>";}

        $string3="SELECT * FROM `disques` WHERE `codelettres`='".$code."' AND `numero`='".$numero."' ";
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
            $string4="UPDATE `emprunts` SET `daterendu`=CURRENT_DATE() WHERE `codelettres`='".$code."' AND `numero`='".$numero."'";
            $query4=mysql_query($string4);
        } else{
        echo $categorie.$oeuvres.$compositeurs.$interpretes.$rem.$code." ".$numero."<br/>";  //affichage des disques empruntés.
        
        ?>

        <form action="" method="post">
            <input type="submit" value="rendre" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/>
            <input type="hidden" name="trigramme" value="<?php echo $trigramme;?>" />
            
            <input type="hidden" name="rendre" value="<?php echo $code.$numero;?>" />
        </form>
        <br/>

        <?php
        }
        
    }

}
?>




