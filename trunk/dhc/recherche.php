    <div id="formulaire" class="formulaire" style="height:309px;">
	<h3>CHERCHER UN DISQUE</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="#resultats" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0" align="center">
    <tr>
    <td width="" colspan="3">Artiste/Compositeur</td>
    <td width=""><input type="text" name="artiste" value="<?php if(isset($_POST["artiste"])) echo $_POST["artiste"];?>" /></td>
    </tr>
    <tr>
    <td colspan="3">Oeuvre</td>
    <td><input type="text" name="oeuvre" value="<?php if(isset($_POST["oeuvre"])) echo $_POST["oeuvre"];?>" /></td>
    </tr>
    <tr>
    <td colspan="3">Interprète</td>
    <td><input type="text" name="interprete" value="<?php if(isset($_POST["interprete"])) echo $_POST["interprete"];?>" /></td>
    </tr>
    
    <tr><td height="20" colspan="3"></td><td></td></tr>
    
    <tr>
    <td colspan="2">Catégorie</td>
    <td colspan="2">
    <select name="categorie" style="margin-right:3px; margin-left:2px; width:230px">
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
    <td colspan="2">Code lettres</td>
    <td><div align="left"><input type="text" name="code" style="width:55px;" value="<?php if(isset($_POST["code"])) echo $_POST["code"];?>" /></div></td>
    <td>Numéro
    <input type="text" name="numero" style="width:55px;" value="<?php if(isset($_POST["numero"])) echo $_POST["numero"];?>" /></td>
    </tr>
            
    <tr><td height="20" colspan="3"></td><td></td></tr>
    
	</table>

	<div align="right"><input type="hidden" name="action" value="firstrecherche" /><input type="reset" value="Annuler" style="margin-top:20px; margin-bottom:20px; margin-right:10px; width:auto"/><input type="submit" value="Lancer la recherche" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/></div>
    </form>
    </div>
    
    <div id="infos" style="height:310px;">
    <h3 style="color:#990000">COMMENT CHERCHER ?</h3>
    <p>Vous pouvez chercher dans la base de données en remplissant au-moins un des champs. Faire varier le nombre de champs remplis permet de gagner en précision ou au contraire en quantité de résultats.</p>
    <h3 style="color:#990000">EMPRUNTER</h3>
    <p>Si vous êtes connectés, vous pouvez emprunter un disque en cliquant simplement sur le bouton associé. Vous pouvez détenir un disque durant trois semaines, et en posséder jusqu'à cinq simultanément. Une fois l'emprunt en ligne terminé, le disque sera, si vous le souhaitez, livré dans votre boîte aux lettres dans les plus brefs délais ouvrables.</p>
    </div>	<a name="resultats">

        <?php 	if (isset($_POST['action'])) {
			$action=$_POST['action'];
				if ($action=="firstrecherche") {
					$num=1;
					$action="recherche";
					}
				if ($action=="notfirstrecherche") {
					$num=$_GET['num'];
					$action="recherche";
					}
				if ($action=="recherche") {
					$nombre=nombreresultats();
					$tableau=recherche(($num-1));
					}
			}

		if (isset($nombre)) {
		if ($nombre>100) {
		echo '<div id="headresultats"><h3 style="padding-left:10px">+ de 100 RESULTATS. Veuillez préciser vos critères de recherche.</h3></div>';
		}
		else {
		$totalpages=floor($nombre/5)+1;
		echo '<div id="headresultats"><h3 style="padding-left:10px">'.$nombre.' RESULTAT';if ($nombre>1) echo 'S';if ($nombre!=0) echo ' sur '.$totalpages.' PAGE';if ($totalpages>1) echo 'S';echo '</h3></div>'; 
		if ($nombre!=0) {
		echo '<div id="bodyresultats">';
		$numero=($num-1)*5;
		while ($row = mysql_fetch_assoc($tableau)) {
		$numero=$numero+1;
		$query='SELECT `intitule` FROM `type` WHERE `code` = \''.$row["categorie"].'\'';
		$result=mysql_query($query);
		$array=mysql_fetch_assoc($result);
		$categorie=$array["intitule"];
    	echo '<table border="0" style="margin:20px; margin-bottom:5px"><tr><td width="20" valign="top">'.$numero.'.</td>
		<td><h3>'.$row["oeuvres"].'</h3>'.$row["compositeurs"].'<p style="font-size:11px;">';if ($row["interpretes"]!="") echo 'interprété par : '.$row["interpretes"];echo'</p><p style="color:#888888">'.$categorie.' &nbsp; | &nbsp; '.$row["codelettres"].' &nbsp; | &nbsp; '.$row["numero"].' </p></td></tr></table>';
		
                $code=$row["codelettres"];
                $num=$row["numero"];
                //echo $code;
                //echo $num;
                $strempr="SELECT `trigramme` FROM `emprunts` WHERE `codelettres`='$code' AND `numero`='$num' AND `daterendu`='0000-00-00'";
                $querempr=mysql_query($strempr);
                while ($tab = mysql_fetch_assoc($querempr)) {
                      //echo $tab['trigramme'];
                      $tri=$tab['trigramme'];
                      $strtri="SELECT * FROM `clients` WHERE `trigramme`='$tri'";
                      $quertri=mysql_query($strtri);
                      while($tab2=mysql_fetch_assoc($quertri)){
                          echo "emprut&eacute; par ".$tab2['nom']." ";    //revoir la mise en page
                          echo $tab2['prenom'];                           //idem
                      }
                }

                }









		echo '</div><div id="headresultats" style="background-color:#444444; height:20px">';
		if ($totalpages>1) {
		if ($num<$totalpages) {
					echo '<form action="index.php?page=recherche&num='.($num+1).'#resultats" name="fantome" id="fantome" method="post" style="float:right">
					<input type="hidden" name="artiste" value="'.$_POST['artiste'].'">
					<input type="hidden" name="oeuvre" value="'.$_POST['oeuvre'].'">
					<input type="hidden" name="interprete" value="'.$_POST['interprete'].'">
					<input type="hidden" name="categorie" value="'.$_POST['categorie'].'">
					<input type="hidden" name="code" value="'.$_POST['code'].'">
					<input type="hidden" name="numero" value="'.$_POST['numero'].'">
					<input type="hidden" name="action" value="notfirstrecherche">
		<div align="right"><input type="submit" value="Page suivante >" style="margin-left:5px; width:170px"></div></form>';
		}
		if ($num>1)  {
					echo '<form action="index.php?page=recherche&num='.($num-1).'#resultats" name="fantome2" id="fantome" method="post" style="float:right">
					<input type="hidden" name="artiste" value="'.$_POST['artiste'].'">
					<input type="hidden" name="oeuvre" value="'.$_POST['oeuvre'].'">
					<input type="hidden" name="interprete" value="'.$_POST['interprete'].'">
					<input type="hidden" name="categorie" value="'.$_POST['categorie'].'">
					<input type="hidden" name="code" value="'.$_POST['code'].'">
					<input type="hidden" name="numero" value="'.$_POST['numero'].'">
					<input type="hidden" name="action" value="notfirstrecherche">
		<div align="right"><input type="submit" value="< Page précédente" style="margin-right:5px; width:170px"></div></form>';
		}
				} 
		echo '</div>';
		}
		}
		}    

	?>

  