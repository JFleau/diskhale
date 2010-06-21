	<div id="formulaire" class="formulaire" >
	<h3>VOS INFORMATIONS</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <?php
    
                $trigramme=$_SESSION['trigramme'];
                modifier($trigramme);


		$query="SELECT `nom`,`prenom`,`email`,`kazert`,`telephone`,`nbmax` FROM `clients` WHERE `trigramme`='".$_SESSION['trigramme']."'";
		$result=mysql_query($query);
		$array=mysql_fetch_assoc($result);
	?>
    <?php
		$query2="SELECT `codelettres`,`numero`,`categorie` FROM `emprunts` WHERE `trigramme`='".$_SESSION['trigramme']."' AND `daterendu`='0000-00-00'";
		$result2=mysql_query($query2);
		$nombre=mysql_num_rows($result2);
	?>
    <table border="0" cellpadding="0" width="390">
    <tr><td width="70" style="color:#6c7551; text-align:right">Nom :</td><td colspan="3"><?php echo $array['nom']; ?></td></tr>
    <tr><td style="color:#6c7551; text-align:right">Prénom :</td><td colspan="3"><?php echo $array['prenom']; ?></td></tr>
    <tr><td style="color:#6c7551; text-align:right">e-mail :</td><td style="font-weight:normal" colspan="3"><?php if($array['email']!="exemple: pierre.dupont")echo $array['email']; ?></td></tr>
    <tr><td height="10" colspan="3"></td><td></td></tr>
    <tr><td style="color:#6c7551; text-align:right">Casert :</td><td style="font-weight:normal"><?php if($array['kazert']!="exemple: 691009") echo $array['kazert']; ?></td><td width="70" style="color:#6c7551; text-align:right">Téléphone :</td><td style="font-weight:normal"><?php if($array['telephone']!="exemple: 6419") echo $array['telephone']; ?></td></tr>
    </table>
    <p>Pour modifier ces informations ou supprimer votre compte, contactez un administrateur <a href="mailto:dhc@frankiz.polytechnique.fr">en cliquant ici</a>.</p>
    <h3 style="cursor:default" class="cache">MODIFIER SON COMPTE</h3>
    <div>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post" class="formulaire">
    <table border="0" cellpadding="0" width="340" style="text-align:right">
        <tr><td>Mot de passe</td><td><input type="password" name="oldpassword" /></td></tr>
        <tr><td>Trigramme souhaite</td><td><input type="text" name="trigramme2" value="<?php if(isset($_POST["trigramme2"])){ echo $_POST["trigramme2"];} else {echo 'exemple: DHC';}?>" onFocus="this.value=verify(this,'exemple: DHC');" onblur="this.value=verify(this,'exemple: DHC');" /></td></tr>
	<tr><td>Nouveau mot de passe</td><td><input type="password" name="password" /></td></tr>
	<tr><td>Confirmez le mot de passe</td><td><input type="password" name="password2" /></td></tr>
        <tr><td>Nom</td><td><input type="text" name="nom" value="<?php if(isset($_POST["nom"])){ echo $_POST["nom"];} ?>"/></td></tr>
        <tr><td>Prenom</td><td><input type="text" name="prenom" value="<?php if(isset($_POST["prenom"])){ echo $_POST["prenom"];} ?>" /></td></tr>
        <tr><td>Kazert</td><td><input type="text" name="kazert" value="<?php if(isset($_POST["kazert"])){ echo $_POST["kazert"];} else{ echo 'exemple: 691009';} ?>" onFocus="this.value=verify(this,'exemple: 691009');" onblur="this.value=verify(this,'exemple: 691009');"  /></td></tr>
        <tr><td>E-mail</td><td><input type="text" name="email" value="<?php if(isset($_POST["email"])){ echo $_POST["email"];} else {echo "exemple: pierre.dupont";}?>" onFocus="this.value=verify(this,'exemple: pierre.dupont');" onblur="this.value=verify(this,'exemple: pierre.dupont');" />
                                <select name="ecole" style="margin-right:3px; width:150px;">
                                    <option value="polytechnique.edu">@polytechnique.edu</option>
                                    <option value="institutoptique.fr">@institutoptique.fr</option>
                                </select></td></tr>

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

    <tr><td height="10" ></td><td></td></tr>
    <tr><td colspan="2"><input type="submit" value="Changer" style="width:80px" /></td></tr>
    </table>
    </form>
    </div>
    </div>


    <div id="infos" style="height:450px;">
    <h3>VOS EMPRUNTS</h3>
    <p>Vous pouvez posséder jusqu'à <?php echo $array['nbmax'];?> disques simultanément.</p>
    <?php 	if ($nombre==0) echo '<p style="padding-top:0px;">Vous ne possédez actuellement aucun disque.</p>';
			if ($nombre==1) echo '<p style="padding-top:0px;">Vous possédez actuellement <b>1</b> disque :</p>';
			if ($nombre!=0&&$nombre!=1) echo '<p style="padding-top:0px;">Vous possédez actuellement <b>'.$nombre.'</b> disques :</p>';
			while ($array2=mysql_fetch_assoc($result2)) {

				$query3="SELECT `oeuvres`,`compositeurs`,`categorie`,`codelettres`,`numero` FROM `disques` WHERE `codelettres`='".$array2['codelettres']."' AND `numero`='".$array2['numero']."' AND `categorie`='".$array2['categorie']."'";
				$result3=mysql_query($query3);
				$array3=mysql_fetch_assoc($result3);

    			echo 	'<table width="420" border="0">
   						<tr><td><b>'.$array3["oeuvres"].'</b><br />'.$array3["compositeurs"].'<br /><font color="#666666">'.$array3["categorie"].' | '.$array3["codelettres"].' | '.$array3["numero"].'</font><br /><br style="line-height:10px;" /><font color="#4682b4">Emprunté le : 19-06-2010</font></td></tr>
    					</table>';
			}

	?>
    </div>

