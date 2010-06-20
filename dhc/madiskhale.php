	<div id="formulaire" class="formulaire" >
	<h3>VOS INFORMATIONS</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <?php
		$query="SELECT `nom`,`prenom`,`email`,`kazert`,`telephone` FROM `clients` WHERE `trigramme`='".$_SESSION['trigramme']."'";
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
    <tr><td style="color:#6c7551; text-align:right">e-mail :</td><td style="font-weight:normal" colspan="3"><?php echo $array['email']; ?></td></tr>
    <tr><td height="10" colspan="3"></td><td></td></tr>
    <tr><td style="color:#6c7551; text-align:right">Casert :</td><td style="font-weight:normal"><?php echo $array['kazert']; ?></td><td width="70" style="color:#6c7551; text-align:right">Téléphone :</td><td style="font-weight:normal"><?php echo $array['telephone']; ?></td></tr>
    </table>
    <p>Pour modifier ces informations ou supprimer votre compte, contactez un administrateur <a href="mailto:dhc@frankiz.polytechnique.fr">en cliquant ici</a>.</p>
    <h3 style="cursor:default" class="cache">CHANGER DE MOT DE PASSE</h3>
    <div>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post" class="formulaire">
    <table border="0" cellpadding="0" width="340" style="text-align:right">
	<tr><td>Ancien mot de passe</td><td><input type="password" name="oldpassword" /></td></tr>
	<tr><td>Nouveau mot de passe</td><td><input type="password" name="newpassword1" /></td></tr>
	<tr><td>Confirmez le mot de passe</td><td><input type="password" name="newpassword2" /></td></tr>
    <tr><td height="10" ></td><td></td></tr>
    <tr><td colspan="2"><input type="submit" value="Changer" style="width:80px" /></td></tr>
    </table>
    </form>
    </div>
    </div>
    <div id="infos" style="height:450px;">
    <h3>VOS EMPRUNTS</h3>
    <p>Vous pouvez posséder jusqu'à 5 disques simultanément.</p>
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