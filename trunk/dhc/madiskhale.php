	<div id="formulaire" class="formulaire" style="height:470px">
	<div class="cache">
    <h3 style="cursor:default">VOS INFORMATIONS</h3>
    
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/></div>
    <div>
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
    <tr><td style="color:#6c7551; text-align:right">Casert :</td><td style="font-weight:normal"><?php echo $array['kazert']; ?></td><td width="70" style="color:#6c7551; text-align:right">Téléphone :</td><td style="font-weight:normal"><?php echo $array['telephone']; ?></td></tr>
    </table>
    <p>Pour modifier ces informations ou supprimer votre compte, contactez un administrateur <a href="mailto:dhc@frankiz.polytechnique.fr">en cliquant ici</a>.</p>
    </div>
    <div class="cache">
    <h3 style="cursor:default">MODIFIER SON COMPTE</h3>
    <hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    </div>
    <div class="byebye">
    <form action="" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0">
    <tr>
    <td width="250" colspan="3">Ancien mot de passe</td>
    <td width=""><input type="password" name="oldpassword" value="" /></td>
    </tr>
    <tr>
    <td colspan="3">Nouveau mot de passe</td>
    <td><input type="password" name="password" /></td>
    </tr>
    <tr>
    <td colspan="3">Confirmer le nouveau mot de passe</td>
    <td><input type="password" name="password2" /></td>
    </tr>
    
    <tr><td height="20" colspan="3"></td><td></td></tr>
    
    <tr>
    <td>Nom</td>
    <td><input type="text" name="nom" value="<?php echo $array['nom']; ?>" /></td>
    <td>Prénom</td>
    <td><input type="text" name="prenom" value="<?php echo $array['prenom']; ?>" /></td>
    </tr>
    <tr>
    <td>Casert</td>
    <td><input type="text" name="kzert" value="<?php echo $array['kazert']; ?>" /></td>
    <td>Téléphone</td>
    <td><input type="text" name="tel" value="<?php echo $array['telephone']; ?>" /></td>
    </tr>
    
    <tr><td height="20" colspan="3"></td><td></td></tr>
    
    <tr>
    <td>e-mail</td>
    <td colspan="3" style="font-weight:normal; text-align:left">
    <input type="text" name="mail" style="width:397px;" value="<?php echo $array['email']; ?>" />
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
    </div>
    <div id="infos2" style="float:right; clear:right; height:200px; width:467px; text-align:left;">
    <h3>COMMENT RENDRE ?</h3>
    <p>Pour rendre un disque, il vous suffit de vous rendre à la diskhâle pendant les horaires d'ouverture, ou bien de glisser le disque dans la boîte aux lettres d'un membre du binet.</p>
    </div>

    <div id="infos" style="">
    <h3>VOS EMPRUNTS</h3>
    <p>Vous pouvez posséder jusqu'à 5 disques simultanément. Les disques en retard sont indiqués en rouge.</p>
    <?php       if ($nombre==0) echo '<p style="padding-top:0px;">Vous ne possédez actuellement aucun disque.</p></div>';
                        if ($nombre==1) echo '<p style="padding-top:0px;">Vous possédez actuellement <b>1</b> disque :</p></div>';
                        if ($nombre!=0&&$nombre!=1) echo '<p style="padding-top:0px;">Vous possédez actuellement <b>'.$nombre.'</b> disques :</p></div>';

        ?>
    <?php
                        while ($array2=mysql_fetch_assoc($result2)) {

                                $query3="SELECT `oeuvres`,`compositeurs`,`categorie`,`codelettres`,`numero` FROM `disques` WHERE `codelettres`='".$array2['codelettres']."' AND `numero`='".$array2['numero']."' AND `categorie`='".$array2['categorie']."'";
                                $result3=mysql_query($query3);
                                $array3=mysql_fetch_assoc($result3);

                        echo    '<div id="disques">
                                                <b>'.$array3["oeuvres"].'</b><br />'.$array3["compositeurs"].'<br /><font color="#cccccc">'.$array3["categorie"].' | '.$array3["codelettres"].' | '.$array3["numero"].'</font><br /><br style="line-height:10px;" /><font color="#ffffff">Emprunté le : 19-06-2010</font>
                                        </div>';
                        }

                        $i=1;
                        while ($i<=(5-$nombre)) {
                                echo '<div id="disquevide">&shy;</div>';
                                $i=$i+1;
                                }

        ?>


