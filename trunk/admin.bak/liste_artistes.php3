<?php
  include("identif.php3") ;
  include("header.php3");
?>


<center>
<font size=+6><b>Liste des artistes de la base</b></font><br>
<br>

<?php

  $query = 'SELECT codelettres,nom,categorie FROM compositeurs ORDER BY codelettres' ;
  $result = mysql_query($query) ;

  echo '<table align="center" border="2">'."\n" ;
  $nombre = 0 ;
  while ($row=mysql_fetch_row($result)) {
    $nombre++ ;
    if ($nombre==1) {
      echo "<tr>" ;
      echo "<td><b>Code-lettres</b><td><b>Nom</b><td><b>Cat&eacute;gorie</b><td><i>modifier</i><td><i>supprimer</i>" ;
      echo "\n</tr>\n" ;
    }
    echo '<tr><td>' ;
    echo $row[0].'<td>'.$row[1].'<td>'.$row[2] ;
    echo '<td><a href="modifier_artiste.php3?codelettres='.$row[0].'">M</a>' ;
    echo '<td><a href="script_effacer_artiste.php3?codelettres='.$row[0].'">X</a>' ;
    echo "</tr>\n" ;
  }
  
  echo "</table>\n\n<br><br><br>Il y a actuellement " ;
  echo $nombre ;
  echo " artistes dans la base<br><br>\n" ;
  echo '<a href="ajouter_artiste.php3">Ajouter un artiste</a><br><br><br>' ; 

  echo $finpage ; 
  mysql_close() ;

?>
