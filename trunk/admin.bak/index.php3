<?php
  include("identif.php3") ;
  include("header.php3");
?>
<a href="../index.html">Site de la diskh&acirc;le</a><br>
<a href="http://frankiz.polytechnique.fr/eleves/binets/wikix/Diskhale_classique">Wikix de la diskh&acirc;le</a><br>
<font size=+5><b>Que veux-tu faire?</font></b><br>
<font size=+2>
<ul>
  <li><font size=+3><a href="traiter_client.php3">Traiter un client</a></font></li>
</ul>
<ul>
  <li><a href="chercher_client.php3">Chercher/Modifier un client</a></li>
  <li><a href="ajouter_client.php3">Ajouter un client</a></li>
  <li><a href="affiche_retards.php3">Liste des retardataires</a></li>
</ul>
<ul>
  <li><a href="chercher_disque.php3?modif=1">Chercher/modifier un/des disque(s)</a></li>
  <li><a href="ajouter_disque.php3">Ajouter un/des disque(s)</a></li>
  <li><font size=+0><a href="chercher_disque.php3">Recherche de disques, accessibles pour tout le monde</a></font></li>
</ul>

<ul>
  <li><a href="liste_artistes.php3">Voir la liste des artistes</a></li>
  <li><a href="ajouter_artiste.php3">Ajouter un artiste</a></li>
</ul>

<ul>
  <li><a href="liste_emprunts.php3">Voir les disques emprunt&eacute;s</a></li>
 </ul>

</font>
<br>


<?php
  mysql_close() ;
  echo $finpage ;
?>
