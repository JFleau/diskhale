<?php
  include("identif.php") ;
  include("header.php");

  $categorie=$_REQUEST['categorie'];
  $compositeurs=$_REQUEST['compositeurs'];
  $oeuvres=$_REQUEST['oeuvres'];
  $interpretes=$_REQUEST['interpretes'];
  $remarques=$_REQUEST['remarques'];
  $codelettres=$_REQUEST['codelettres'];
  $numero=$_REQUEST['numero'];

  $query = 'UPDATE disques SET categorie="'.$categorie.'",compositeurs="'.$compositeurs.'",oeuvres="'.$oeuvres ;
  $query = $query.'",interpretes="'.$interpretes.'",remarques="'.$remarques.'" WHERE codelettres="'.$codelettres.'" AND numero='.$numero ;
  // echo $query."<br>" ;
  $result = mysql_query($query) ;
  if (0!=$result) {     // bien rentré dans la base
    echo "<center>Les caract&eacute;ristiques suivantes ont &eacute;t&eacute; rentr&eacute;es pour ce disque :<br>\n" ;
    echo '<table>'."\n" ;
    echo '<tr><td><b>Code-lettres: </b><td>'.$codelettres."\n</tr><tr><td><b>Num&eacute;ro: </b><td>".$numero."\n</tr>" ;
    echo "<tr><td><b>Cat&eacute;gorie: </b><td>".$categorie."\n</tr><tr><td><b>Compositeur(s): </b><td>".$compositeurs."\n</tr>" ;
    echo "<tr><td><b>Oeuvre(s): </b><td>".$oeuvres."\n</tr><tr><td><b>Interpr&egrave;te(s): </b><td>".$interpretes."\n</tr>" ;
    echo "<tr><td><b>Remarques: </b><td>".$remarques."</tr><br>\n</table>\n" ;
    echo '<p><br><br></center>' ;
  }
  else echo "Une erreur s'est produite et aucune modification n'a pu être effectuée dans la base de données<br>" ;


mysql_close() ;
echo $finpage ;
?>
