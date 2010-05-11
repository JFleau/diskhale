<?php
  include("identif.php") ;
  include("header.php");
?>
<a href="../index.html">Site de la diskh&acirc;le</a><br>
<a href="http://frankiz.polytechnique.fr/eleves/binets/wikix/Diskhale_classique">Wikix de la diskh&acirc;le</a><br>
<font size=+5><b>Que veux-tu faire?</font></b><br>
<font size=+2>
<ul>
  <li><font size=+3><a href="traiter_client.php">Traiter un client</a></font></li>
</ul>
<ul>
  <li><a href="chercher_client.php">Chercher/Modifier un client</a></li>
  <li><a href="ajouter_client.php">Ajouter un client</a></li>
  <li><a href="affiche_retards.php">Liste des retardataires</a></li>
</ul>
<ul>
  <li><a href="chercher_disque.php?modif=1">Chercher/modifier un/des disque(s)</a></li>
  <li><a href="ajouter_disque.php">Ajouter un/des disque(s)</a></li>
  <li><font size=+0><a href="chercher_disque.php">Recherche de disques, accessibles pour tout le monde</a></font></li>
</ul>

<ul>
  <li><a href="liste_artistes.php">Voir la liste des artistes</a></li>
  <li><a href="ajouter_artiste.php">Ajouter un artiste</a></li>
</ul>

<ul>
  <li><a href="liste_emprunts.php">Voir les disques emprunt&eacute;s</a></li>
 </ul>

</font>
<br>


<?php
  mysql_close() ;
  echo $finpage ;
?>
