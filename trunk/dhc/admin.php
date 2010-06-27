<?php
if ($_POST['action2']=="admin_chercher"&&($_POST['trigramme']!=""||$_POST['nom']!=""||$_POST['prenom']!="")) {
			$query="SELECT * FROM `clients` WHERE ";
			if ($_POST['trigramme']!="") $query=$query."`trigramme` LIKE '%".$_POST['trigramme']."%'";
			else {
				if ($_POST['nom']!="") $query=$query."`nom` LIKE '%".addslashes($_POST['nom'])."%'";
				if ($_POST['nom']!=""&&$_POST['prenom']!="") $query=$query." AND ";
				if ($_POST['prenom']!="") $query=$query."`prenom` LIKE '%".addslashes($_POST['prenom'])."%'";
			} 
			$result=mysql_query($query);
			$nombre=mysql_num_rows($result);
			if ($nombre>10) echo '<div id="infos"><h3 style="padding-left:490px; color:#888888; line-height:25px;">Trop de résultats.<br>Veuillez préciser votre requête.</h3>';
			else {
				echo '<div id="infos"><h3 style="padding-left:500px; color:#888888">'.$nombre.' RESULTATS</h3>';
				while ($row=mysql_fetch_assoc($result)) {
					echo '</div><div id="disques" style="float:right; padding:10px; width:70px; height:20px;"><form action="" method="post"><input type="hidden" name="action2" value="gérer"><input type="hidden" name="trigramme" value="'.$row["trigramme"].'"><input type="submit" value="Gérer >"></form></div><div id="disques" style="float:left; padding:10px; width:21px; height:20px; margin-left:2px;">'.$row["trigramme"].'</div><div id="disques" style="float:left; padding:10px; width:300px; height:20px; margin-left:1px;"><b>'.$row["nom"].' '.$row["prenom"].'</b>';
				
				}
				echo '</div>';
			}
}

if ($_POST['action2']=="gérer") {
	$query="SELECT `nom`,`prenom`,`email`,`kazert`,`telephone`,`nbmax` FROM `clients` WHERE `trigramme`='".$_POST['trigramme']."'";
	$result=mysql_query($query);
	$array=mysql_fetch_assoc($result);
	
	$query2="SELECT `codelettres`,`numero`,`categorie`,`dateemprunt` FROM `emprunts` WHERE `trigramme`='".$_POST['trigramme']."' AND `daterendu`='0000-00-00'";
    $result2=mysql_query($query2);
    $nombre=mysql_num_rows($result2);

	?>
    <div id="infos" style="height:650px;">
    <h3 style="padding-left:500px; color:#888888; padding-bottom:05px; cursor:default" class="cache">INFORMATIONS DE COMPTE</h3>
    <div>
	<table border="0" cellpadding="0" width="460" style="padding-top:25px; padding-bottom:20px;">
    <tr><td width="80" style="color:#6c7551; text-align:right">Nom :</td><td colspan="3" style="padding-left:10px;"><?php echo $array['nom']; ?></td></tr>
    <tr><td style="color:#6c7551; text-align:right">Prénom :</td><td colspan="3" style="padding-left:10px;"><?php echo $array['prenom']; ?></td></tr>
    <tr><td style="color:#6c7551; text-align:right">e-mail :</td><td style="padding-left:10px;font-weight:normal" colspan="3"><?php if($array['email']!="exemple: pierre.dupont")echo $array['email']; ?></td></tr>
    <tr><td height="10" colspan="3"></td><td></td></tr>
    <tr><td style="color:#6c7551; text-align:right">Casert :</td><td style="padding-left:10px;font-weight:normal"><?php echo $array['kazert']; ?></td><td width="70" style="color:#6c7551; text-align:right">Téléphone :</td><td style="padding-left:10px;font-weight:normal"><?php echo $array['telephone']; ?></td></tr>
    </table>
    </div>
    <div class="cache">
    <h3 style="cursor:default; padding-left:500px; color:#888888; padding-top:05px; padding-bottom:05px">MODIFIER LE COMPTE</h3>
    </div>
    <div class="byebye" style="padding-top:15px">
    <form action="" method="post">
    <input type="hidden" name="action2" value="gérer">
    <input type="hidden" name="trigramme" value="<?php echo $_POST['trigramme']; ?>">
    <table border="0" style="text-align:right; vertical-align:middle; font-size:11px" cellpadding="0">
    <tr>
    <td width="350" colspan="3" style="font-weight:normal">Nouveau mot de passe (facultatif)</td>
    <td width="160"><input type="password" name="password" /></td>
    </tr>
    <tr>
    <td colspan="3" style="font-weight:normal">Confirmer le nouveau mot de passe (facultatif)</td>
    <td><input type="password" name="password2" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td width="50">Nom</td>
    <td><input type="text" name="nom" value="<?php echo $array['nom']; ?>" /></td>
    <td>Prénom</td>
    <td><input type="text" name="prenom" value="<?php echo $array['prenom']; ?>" /></td>
    </tr>
    <tr>
    <td>Casert</td>
    <td><input type="text" name="kazert" value="<?php echo $array['kazert']; ?>" /></td>
    <td>Téléphone</td>
    <td><input type="text" name="telephone" value="<?php echo $array['telephone']; ?>" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td>e-mail</td>
    <td colspan="3" style="font-weight:normal; text-align:left">
    <input type="text" name="email" style="width:388px; margin-left:19px" value="<?php echo $array['email']; ?>" />
    </td>
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
    <input checked="true" name="news" value="oui" type="radio" style="width:20px; border:none" />oui
    <input name="news" value="non" type="radio"  style="width:20px; border:none" />non
    <input type="hidden" name="action" value="modifier" /></td>
    </tr>
    <tr><td height="20" colspan="3"></td><td></td></tr>
        </table>
    <div align="right"><input type="submit" value="Enregistrer les modifications" style="width:200px; margin-bottom:20px; margin-right:10px;" /></div>
    </form>
    </div>
    <h3 class="cache" style="cursor:default; padding-left:500px; color:#888888; padding-top:05px; padding-bottom:20px; ">SUPPRIMER LE COMPTE</h3>
    <div class="byebye">
    <div align="right"><p style="padding-right:50px; margin-right:00px; text-align:right"><b><font color="#990000">Cette action est irréversible.</font></b><br>Êtes-vous sûr de vouloir supprimer ce compte ?</p><form action="" method="post"><input type="hidden" name="nombre" value="<?php echo $nombre; ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="trigramme" value="<?php echo $_POST['trigramme']; ?>"><input type="submit" value="Supprimer" style="margin-right:50px; margin-top:15px;"></form></div>
    </div>
        <h3 class="cache" style="cursor:default; padding-left:500px; color:#888888; padding-top:05px; padding-bottom:20px; margin-top:3px">VOIR LES EMPRUNTS</h3>

    <div class="byebye">
    
    <?php      
						echo '<p style="float:right; margin-right:100px; padding-bottom:00px">Les disques en retard s\'affichent en rouge.</p>';
						if ($nombre==0) echo '<p style="float:right; margin-right:100px">Aucun disque actuellement détenu.</p>';
                        if ($nombre==1) echo '<p style="float:right; margin-right:100px"><b>1</b> disque actuellement détenu :</p>';
                        if ($nombre!=0&&$nombre!=1) echo '<p style="float:right; margin-right:100px"><b>'.$nombre.'</b> disques actuellement détenus :</p>';
						echo '<table width="460" border="0" style="float:right; font-size:11px; height:30px; color:#ffffff; margin-right:0px; padding-right:0px;">';
                        while ($array2=mysql_fetch_assoc($result2)) {

                                $query3="SELECT `oeuvres`,`compositeurs`,`categorie`,`codelettres`,`numero` FROM `disques` WHERE `codelettres`='".$array2['codelettres']."' AND `numero`='".$array2['numero']."' AND `categorie`='".$array2['categorie']."'";
                                $result3=mysql_query($query3);
                                $array3=mysql_fetch_assoc($result3);
								
						$datequery="SELECT DATEDIFF(CURDATE(), `dateemprunt`) FROM `emprunts` WHERE `trigramme`='".$_POST['trigramme']."' AND `codelettres`='".$array2['codelettres']."' AND `numero`='".$array2['numero']."' AND `categorie`='".$array2['categorie']."'";
						$dateresult=mysql_query($datequery);
						$datearray=mysql_fetch_array($dateresult);
						$delai=$datearray[0];
						
						if ($delai>21) $bgcolor="#990000"; else $bgcolor="#4682b4";
						
						echo '<tr><td width="100" style="text-align:center; background-color:'.$bgcolor.'">'.$array3["categorie"].'</td><td width="60" style="text-align:center; background-color:'.$bgcolor.'">'.$array3["codelettres"].'</td><td style="text-align:center; background-color:'.$bgcolor.'">'.$array3["numero"].'</td><td style="text-align:center; background-color:'.$bgcolor.'">'.$array2["dateemprunt"].'</td><td width="70" style="text-align:center;"><form action="" method="post"><input type="hidden" name="codelettres" value="'.$array3["codelettres"].'"><input type="hidden" name="numero" value="'.$array3["numero"].'"><input type="hidden" name="action" value="rendre"><input type="hidden" name="action2" value="gérer"><input type="hidden" name="trigramme" value="'.$_POST['trigramme'].'"><div align="right"><input type="submit" value="Rendre"></div></form></td></tr>';
						
						}
						echo '</table>';
        ?>



    </div>
</div>

	<?php
}    

?>