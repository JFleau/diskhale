	<div id="header">
    <div id="contact"><table style="padding-left:430px; padding-top:280px;" cellpadding="5"><tr><td><b><div align="right">Tél <br />Horaires <br />Renseignements <br />Contact </div></b></td><td> 2630<br /> tous les jours, de 12h45 à 13h30<br />br.binet.diskhale.classique<br /><a href="mailto:dhc@frankiz.polytechnique.fr">écrire un mail</a></td></tr></table></div>
    
    <?php
		if ($_SESSION['loggedIn']==0) {
		echo '
    <form action="" method="post" style="padding-bottom:0px; margin-bottom:0px;">
    <input type="text" name="trigramme" value="Trigramme" onFocus="this.value=verify(this,\'Trigramme\');" onBlur="this.value=verify(this,\'Trigramme\');" width="70" style="float:left;';if ($_SESSION['bienvenue']=="echec") echo 'color:white; background-color:red;';
	echo '"> 
    <div id="password">   
    <input type="password" name="password" value="password" onFocus="this.value=verify(this,\'password\');" onBlur="this.value=verify(this,\'password\');" width="70"';if ($_SESSION['bienvenue']=="echec") echo 'style="color:white; background-color:red;"';
	echo '>
    <input type="hidden" name="action" value="login" />
    <p style="padding-top:0px; margin-top:0px; font-size:9px; line-height:12px;"><a href="">Mot de passe oublié ?</a></p>
    </div>
    <input type="submit" value="Connexion" style="height:20px; margin-left:5px" />
    
    </form>';
		}
		else echo '<form action="" method="post"><input type="hidden" name="action" value="logout"><input type="submit" value="Déconnexion" style="float:left"></form><p style="float:left; color:#ffffff">&nbsp;&nbsp;'.$_SESSION['bienvenue'].'</p>';
	?>
        
    <?php
		if ($page=="recherche") 
			echo '<img src="images/recherche_select.png" style="float:right;" />';
		else 
			echo '<a href="index.php?page=recherche"><img src="images/recherche_unselect.png" style="float:right; padding-top:10px;" onmouseover="this.src=\'images/recherche_hover.png\'" onmouseout="this.src=\'images/recherche_unselect.png\'"/></a>';
		
		if ($page=="inscription")
			echo '<img src="images/inscription_select.png" style="float:right" />';
		if ($page=="madiskhale")
			echo '<img src="images/madiskhale_select.png" style="float:right" />';
		if ($page=="administration")
			echo '<img src="images/administration_select.png" style="float:right" />';
		if ($page!="inscription"&&$page!="madiskhale"&&$page!="administration") {
			if ($_SESSION['loggedIn']==0) echo '<a href="index.php?page=inscription"><img src="images/inscription_unselect.png" style="float:right; padding-top:10px;" onMouseOver="this.src=\'images/inscription_hover.png\'" onMouseOut="this.src=\'images/inscription_unselect.png\'" /></a>';
			if ($_SESSION['loggedIn']==1) echo '<a href="index.php?page=madiskhale"><img src="images/madiskhale_unselect.png" style="float:right; padding-top:10px;" onMouseOver="this.src=\'images/madiskhale_hover.png\'" onMouseOut="this.src=\'images/madiskhale_unselect.png\'" /></a>';
			if ($_SESSION['loggedIn']==2) echo '<a href="index.php?page=administration"><img src="images/administration_unselect.png" style="float:right; padding-top:10px;" onMouseOver="this.src=\'images/administration_hover.png\'" onMouseOut="this.src=\'images/administration_unselect.png\'" /></a>';
			}
		
		if ($page=="accueil")
			echo '<img src="images/accueil_select.png" style="float:right;" />';
		else
			echo '<a href="index.php?page=accueil"><img src="images/accueil_unselect.png" style="float:right; padding-top:10px;" onmouseover="this.src=\'images/accueil_hover.png\'" onmouseout="this.src=\'images/accueil_unselect.png\'"/></a>';
	?>  
    </div>