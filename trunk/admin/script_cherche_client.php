<?php
  include("identif.php") ;
  include("header.php");

  $trigramme=$_REQUEST['trigramme'];
  $nom=$_REQUEST['nom'];
  $prenom=$_REQUEST['prenom'];
  $categorie=$_REQUEST['categorie'];
  $nbmax=$_REQUEST['nbmax'];
  $remarques=$_REQUEST['remarques'];

  ?>

<center>
<font size=+6><b>R&eacute;sultats de la recherche</b></font><br>
<br>

<?php
  echo '<font color="#FF0000">Cliquer sur le M pour modifier, sur le T pour traiter, sur le X pour effacer</font><br><br>'."\n" ;

  $criteres='(1=1)' ;
  if (0!=strcmp('',$trigramme)) $criteres = $criteres.' AND (trigramme="'.$trigramme.'")' ;
  if (strcmp($nom,'')!=0) $criteres = $criteres.' AND ((nom) LIKE ("'.$nom.'%"))' ;
  if (strcmp($prenom,'')!=0) $criteres = $criteres.' AND ((prenom) LIKE ("'.$prenom.'%"))' ;
  if (strcmp($categorie,'')!=0) $criteres = $criteres.' AND (categorie LIKE "%'.$categorie.'%")' ;
  if (0!=strcmp('',$nbmax)) $criteres = $criteres.' AND (nbmax='.$nbmax.')' ;
  if (strcmp($remarques,'')!=0) $criteres = $criteres.' AND ((remarques) LIKE ("%'.$remarques.'%"))' ;

  $query = 'SELECT trigramme,nom,prenom,categorie,nbmax,remarques FROM clients WHERE '.$criteres ;
  $query = $query.' ORDER BY categorie,nom,prenom' ;
  // echo $query.'<br>' ;
  $result = mysql_query($query) ;

  echo '<table align="center" border="2">'."\n" ;
  $nombre = 0 ;
  while ($row=mysql_fetch_row($result)) {
    $nombre++ ;
    if ($nombre==1) {
      echo "<tr>" ;
      echo '<td>&nbsp;<td>&nbsp;<td>&nbsp;' ;
      echo "<td><b>Trigramme</b><td><b>Nom</b><td><b>Pr&eacute;nom</b><td><b>Cat&eacute;gorie</b>" ;
      echo "<td><b>Nombre de disques maxi</b><td><b>Remarques</b>" ;
      echo "\n</tr>\n" ;
    }
    echo '<tr><td>' ;
    echo '<a href="modifier_client.php?trigramme='.$row[0].'">&nbsp;M&nbsp;</a><td>' ;
    echo '<a href="traiter_client.php?trigramme='.$row[0].'">&nbsp;T&nbsp;</a><td>' ;
    echo '<a href="script_effacer_client.php?trigramme='.$row[0].'">&nbsp;X&nbsp;</a><td>' ;
    echo $row[0].'<td>'.$row[1].'<td>'.$row[2].'<td>'.$row[3].'<td>'.$row[4].'<td>'.$row[5] ;
    echo "\n</tr>\n" ;
  }

  echo "</table>\n\n" ;
  if ($nombre==0) echo "Aucun client correspondant aux crit&egrave;res demand&eacute;s n'a &eacute;t&eacute; trouv&eacute;<br>" ;
  echo "<br><br><br>\n" ;
  echo '<a href="chercher_client.php">Retour aux crit&egrave;res de recherche</a><br>'."\n" ;

  echo $finpage ;
  mysql_close() ;

?>
