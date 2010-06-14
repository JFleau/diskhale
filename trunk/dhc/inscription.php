    <div id="formulaire" class="formulaire" style="height:450px;">
	<h3>INSCRIVEZ-VOUS !</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0">
    <tr>
    <td width="250" colspan="3">Trigramme souhaité</td>
    <td width=""><input type="text" name="trigramme" value="exemple: DHC" onFocus="this.value=verify(this,'exemple: DHC');" onblur="this.value=verify(this,'exemple: DHC');" /></td>
    </tr>
    <tr>
    <td colspan="3">Mot de passe</td>
    <td><input type="password" name="password" /></td>
    </tr>
    <tr>
    <td colspan="3">Confirmer le mot de passe</td>
    <td><input type="password" name="password2" /></td>
    </tr>
    
    <tr><td height="20" colspan="3"></td><td></td></tr>
    
    <tr>
    <td>Nom</td>
    <td><input type="text" name="nom" /></td>
    <td>Prénom</td>
    <td><input type="text" name="prenom" /></td>
    </tr>
    <tr>
    <td>Casert</td>
    <td><input type="text" name="kzert" value="exemple: 691009" onFocus="this.value=verify(this,'exemple: 691009');" onblur="this.value=verify(this,'exemple: 691009');" /></td>
    <td>Téléphone</td>
    <td><input type="text" name="tel" value="exemple: 6419" onFocus="this.value=verify(this,'exemple: 6419');" onblur="this.value=verify(this,'exemple: 6419');" /></td>
    </tr>
    
    <tr><td height="20" colspan="3"></td><td></td></tr>
    
    <tr>
    <td>e-mail</td>
    <td colspan="3" style="font-weight:normal; text-align:left">
    <input type="text" name="mail" style="width:240px;" value="exemple: pierre.dupont" onFocus="this.value=verify(this,'exemple: pierre.dupont');" onblur="this.value=verify(this,'exemple: pierre.dupont');" />
    <select name="ecole" style="margin-right:3px; width:150px;">
    	<option value="polytechnique.edu">@polytechnique.edu</option>
        <option value="institutoptique.fr">@institutoptique.fr</option>
    </select></td>
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
    <input name="news" value="non" type="radio"  style="width:20px; border:none" />non</td>
    </tr>
            
    <tr><td height="20" colspan="3"></td><td></td></tr>
    
	</table>

	<div align="right"><input type="reset" value="Annuler" style="margin-top:20px; margin-bottom:20px; margin-right:10px; width:auto"/><input type="submit" value="Valider l'inscription" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/></div>
    </form>
    </div>
    
    <div id="infos" style="height:450px;">
    <h3>POURQUOI S'INSCRIRE ?</h3>
    <p>L'inscription vous donne accès aux plus de 3500 CD que possède la diskhâle classique et vous permet de les emprunter ! En utilisant le moteur de recherche et le système d'emprunt en ligne, vous n'avez plus besoin de vous déplacer pour profiter de la collection du binet ! Toute la gestion de votre compte utilisateur s'effectue depuis votre ordinateur et les disques que vous empruntez vous sont livrés dans votre boîte aux lettres.</p>
    <h3>TARIFS</h3>
    <p>Pour valider votre inscription, il vous faut régler une cotisation dont le montant est proportionnel au temps qu'il vous reste à passer sur le plâtal, ainsi qu'un chèque de caution, de 75€, qui ne sera pas encaissé. Une fois ces formalités accomplies, il ne vous reste plus qu'à profiter à volonté de la diskhâle !</p>
    <p>Calculez votre cotisation :</p>
    <form id="cotisation" name="cotisation">
    <select name="promo" id="promo" style="margin-left:10px; width:80px;">
    	<option value="2008">X2008</option>
        <option value="2009">X2009</option>
    </select>
    <input type="button" value="calculer" onclick="mois.value=nomdumois()+'&nbsp; > &nbsp;'+calculcotisation();" />
    <input type="text" name="mois" id="mois" disabled="disabled" value="" style="padding-left:5px; background-color:#FFFFFF; border:none; width:285px; color:#4682b4" />
    </form>
    </div>
