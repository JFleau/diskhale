    <div id="contact"><table style="padding-left:430px; padding-top:280px;" cellpadding="5"><tr><td><b><div align="right">Tél <br />Horaires <br />Renseignements <br />Contact </div></b></td><td> 2630<br /> tous les jours, de 12h45 à 13h30<br />br.binet.diskhale.classique<br /><a href="mailto:dhc@frankiz.polytechnique.fr">écrire un mail</a></td></tr></table></div>
    <form action="" method="post" style="padding-bottom:0px; margin-bottom:0px;">
    <input type="text" name="trigramme" value="Trigramme" onFocus="this.value=verify(this,'Trigramme');" onBlur="this.value=verify(this,'Trigramme');" width="70" style="float:left"> 
    <div id="password">   
    <input type="password" name="mdp" value="password" onFocus="this.value=verify(this,'password');" onBlur="this.value=verify(this,'password');" width="70">
    <p style="padding-top:0px; margin-top:0px; font-size:9px; line-height:12px;"><a href="">Mot de passe oublié ?</a></p>
    </div>
    <input type="submit" value="Connexion" style="height:20px; margin-left:5px" />
    
    </form>
    <?php
	if ($page=="recherche") {
	echo '
	<img src="images/recherche_select.png" style="float:right;" />
    <a href="index.php?page=inscription"><img src="images/inscription_unselect.png" style="float:right; padding-top:10px;" onMouseOver="this.src=\'images/inscription_hover.png\'" onMouseOut="this.src=\'images/inscription_unselect.png\'" /></a>
    <a href="index.php?page=accueil"><img src="images/accueil_unselect.png" style="float:right; padding-top:10px;" onMouseOver="this.src=\'images/accueil_hover.png\'" onMouseOut="this.src=\'images/accueil_unselect.png\'"/></a>';
	}
	if ($page=="inscription") {
	echo '
	<a href="index.php?page=recherche"><img src="images/recherche_unselect.png" style="float:right; padding-top:10px;" onmouseover="this.src=\'images/recherche_hover.png\'" onmouseout="this.src=\'images/recherche_unselect.png\'"/></a>
    <img src="images/inscription_select.png" style="float:right" />
    <a href="index.php?page=accueil"><img src="images/accueil_unselect.png" style="float:right; padding-top:10px;" onmouseover="this.src=\'images/accueil_hover.png\'" onmouseout="this.src=\'images/accueil_unselect.png\'"/></a>';
	}
	if ($page=="accueil") {
	echo '
	<a href="index.php?page=recherche"><img src="images/recherche_unselect.png" style="float:right; padding-top:10px;" onmouseover="this.src=\'images/recherche_hover.png\'" onmouseout="this.src=\'images/recherche_unselect.png\'"/></a>
    <a href="index.php?page=inscription"><img src="images/inscription_unselect.png" style="float:right; padding-top:10px;" onmouseover="this.src=\'images/inscription_hover.png\'" onmouseout="this.src=\'images/inscription_unselect.png\'" /></a>
    <img src="images/accueil_select.png" style="float:right;" />';
	}
	?>  
