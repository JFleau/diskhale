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
    <td width=""><input type="text" name="trigramme_s" value="<?php if(isset($_POST["trigramme_s"])){ echo $_POST["trigramme_s"];} ?>"/></td>
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

<div id="infos" style="height:800px;">

    <table >
            <colgroup>
            <col>
            <col width="" span="">
            </colgroup>
            <tr>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Trigramme</td>
                <td>Kazert</td>
                <td>Telephone</td>

            </tr>

<?php
$search= array("trigramme","nom","prenom","categorie");
$search2=array("trigramme_s","nom_s","prenom_s","categorie_s");
$l=0;
$string6=="";


for($i=0;$i<=3;$i++){
    if(isset($_POST[$search2[$i]]) && $_POST[$search2[$i]]!=""){
        $tr=$_POST[$search2[$i]];
        $tv=$search[$i];
        if($l==0){
            $string6=$string6. ' WHERE '.$tv.' LIKE '.'\''.$tr.'\'';
        }
        else{
            $string6=$string6.' AND '.$tv.' LIKE '.'\''.$tr.'\'';
        }
        $l=$l+1;


    }
}

if($l>0){
    $query="SELECT * FROM `clients`".$string6;
    $squery=mysql_query($query);
    if (!$squery) echo 'Erreur SQL '.mysql_error().': '.$squery;
    while ($tab = mysql_fetch_assoc($squery)){

        ?>
            <tr>
                <td><?php echo $tab['nom'];?></td>
                <td><?php echo $tab['prenom'];?></td>
                <td><?php echo $tab['trigramme'];?></td>
                <td><?php echo $tab['kazert'];?></td>
                <td><?php echo $tab['telephone'];?></td>

            </tr>


        <?php


    }
}

?>

    </table>

</div>

