<?php
  include("identif.php3") ;
  include("header.php3");

  $categorie=$_REQUEST['categorie'];
  $nom=$_REQUEST['nom'];
  $codelettres=$_REQUEST['codelettres'];

  $query = 'UPDATE compositeurs SET categorie="'.$categorie.'",nom="'.$nom.'" WHERE codelettres="'.$codelettres.'"' ;
  // echo $query."<br>" ;
  $result = mysql_query($query) ;
  if (0!=$result) {     // bien rentré dans la base
    echo "<center>Les caract&eacute;ristiques suivantes ont &eacute;t&eacute; rentr&eacute;es pour cet artiste :<br>\n" ;
    echo '<table>'."\n" ;
    echo '<tr><td><b>Code-lettres: </b><td>'.$codelettres."\n</tr>" ;
    echo "<tr><td><b>Nom: </b><td>".$nom."\n</tr>" ;
    echo "<tr><td><b>Cat&eacute;gorie: </b><td>".$categorie."\n</tr>" ;
    echo "\n</table>\n" ;
    echo '<p><br><br></center>' ;
  }
  else echo "Une erreur s'est produite et aucune modification n'a pu être effectuée dans la base de données<br>" ;


mysql_close() ;
echo $finpage ;
?>
