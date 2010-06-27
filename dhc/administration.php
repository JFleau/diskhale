    <div id="formulaire" class="formulaire" style="float:left; height:650px">
	<h3><a href="index.php?page=retardataires"><font color="#FFFFFF">LISTE DES RETARDATAIRES</font></a></h3>
    <h3><a href="index.php?page=ddm"><font color="#FFFFFF">DISQUE DU MOIS</font></a></h3>
    <h3>CHERCHER UN UTILISATEUR</h3>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post" name="chercher">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0" align="center">
    <tr>
    <td width="" colspan="3">Trigramme</td>
    <td width=""><input type="text" name="trigramme" value="" /></td>
    </tr>
    <tr><td height="20" colspan="3"></td><td></td></tr>
    <tr>
    <td colspan="3" style="font-weight:normal">ou Nom</td>
    <td><input type="text" name="nom" value="" /></td>
    </tr>
    <tr>
    <td colspan="3" style="font-weight:normal">Prénom</td>
    <td><input type="text" name="prenom" value="" /></td>
    </tr>
    </table>
    <input type="hidden" name="action2" value="admin_chercher" />
    <div align="right"><input type="reset" value="Annuler"><input type="submit" value="Chercher" style="margin-top:20px; margin-right:20px"></div>
	</form>
    <h3 style="padding-top:15px">AJOUTER OU MODIFIER UN DISQUE</h3>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post" name="ajoutmodif">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0" align="center">
    <tr>
    <td width="">Code lettres</td>
    <td width=""><input type="text" name="codelettres" value="" style="width:60px" /></td>
    <td width="70">Numéro</td>
    <td><input type="text" name="numero" value="" style="width:60px" /></td>
    <td width="80"><div align="right"><input type="hidden" name="action3" value="tester"><input type="submit" value="Go >>" style="width:60px"></div></td>
    </tr>
    </table>
	</form>
    <?php
	if (isset($_POST['action3'])&&$_POST['action3']=="tester"&&$_POST['codelettres']!=""&&$_POST['numero']!="") {
		$query="SELECT * FROM `disques` WHERE `codelettres`='".$_POST['codelettres']."' AND `numero`='".$_POST['numero']."'";
		$result=mysql_query($query);
		$num=mysql_num_rows($result);
		$tableau=mysql_fetch_assoc($result);
		if ($num!=0) $valuehidden="modif_disque"; else $valuehidden="ajout_disque";
		echo '<form action="" method="post">
		 <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0" align="center">
    <tr><td height="20" colspan="3"></td><td></td></tr>
	<tr>
    <td width="" colspan="3">Artiste/Compositeur</td>
    <td width=""><input type="text" name="artiste" value="'; if ($num!=0) echo $tableau["compositeurs"]; echo '" style="width:250px" /></td>
    </tr>
    <tr>
    <td colspan="3">Oeuvre</td>
    <td><input type="text" name="oeuvre" value="'; if ($num!=0) echo $tableau["oeuvres"]; echo '" style="width:250px" /></td>
    </tr>
    <tr>
    <td colspan="3">Interprète</td>
    <td><input type="text" name="interprete" value="'; if ($num!=0) echo $tableau["interpretes"]; echo '" style="width:250px" /></td>
    </tr>
    
    <tr><td height="20" colspan="3"></td><td></td></tr>
    
    <tr>
    <td colspan="2">Catégorie</td>
    <td colspan="2">
    <select name="categorie" style="margin-right:3px; margin-left:2px; width:230px">
         <option value="">-</option>
         <option value="classique"'; if ($num!=0&&$tableau['categorie']=="classique") echo 'selected'; echo '>Classique</option>
         <option value="opera"'; if ($num!=0&&$tableau['categorie']=="opera") echo 'selected'; echo '>Op&eacute;ra</option>
         <option value="interprete"'; if ($num!=0&&$tableau['categorie']=="interprete") echo 'selected'; echo '>Interprète</option>
         <option value="jazz"'; if ($num!=0&&$tableau['categorie']=="jazz") echo 'selected'; echo '>Jazz</option>
         <option value="varietes"'; if ($num!=0&&$tableau['categorie']=="varietes") echo 'selected'; echo '>Vari&eacute;t&eacute;s</option>
         <option value="film"'; if ($num!=0&&$tableau['categorie']=="film") echo 'selected'; echo '>Musique de film</option>
         <option value="compil"'; if ($num!=0&&$tableau['categorie']=="compil") echo 'selected'; echo '>Compilations</option>
         <option value="anc"'; if ($num!=0&&$tableau['categorie']=="anc") echo 'selected'; echo '>Musique ancienne + Liturgies</option>
         <option value="tradi"'; if ($num!=0&&$tableau['categorie']=="tradi") echo 'selected'; echo '>Musiques traditionnelles</option>
         <option value="electro"'; if ($num!=0&&$tableau['categorie']=="electro") echo 'selected'; echo '>Electromusique</option>
         <option value="mili"'; if ($num!=0&&$tableau['categorie']=="mili") echo 'selected'; echo '>Musique militaire</option>
         <option value="part"'; if ($num!=0&&$tableau['categorie']=="part") echo 'selected'; echo '>Partitions</option>        
    </select>
    </td>
    </tr>
	<input type="hidden" name="action" value="'.$valuehidden.'" />    
	<input type="hidden" name="codelettres" value="'.$_POST['codelettres'].'" />    
	<input type="hidden" name="numero" value="'.$_POST['numero'].'" />    
	<tr><td height="20" colspan="3"></td><td></td></tr>
	</table>
	<div align="right"><input type="submit" value="'; if ($num!=0) echo 'Modifier le disque'; else echo 'Ajouter le disque'; echo '" style="margin-right:20px"></div></form>';

	
	
	}
	
	?>
    </div>

    <?php
	
	if (isset($_POST['action2'])) {
		include "admin.php";
	}
	else echo '<div id="infos" style="height:650px">&shy;<div align="center"><img src="images/admin.png" align="center"></div></div>';
	?>