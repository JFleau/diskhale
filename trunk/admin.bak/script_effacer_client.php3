<?php

  include("identif.php3") ;
  include("header.php3");

  $trigramme=$_REQUEST['trigramme'];

  $peutsupprimer = true ; 
 
  // vérifier qu'il n'y a plus d'emprunts
  $query='SELECT codelettres,numero,dateemprunt FROM emprunts WHERE trigramme="'.$trigramme.'" AND (daterendu=0 OR daterendu=NULL)' ;
  $result  = mysql_query($query) ;
  $pascontent = '' ;
  while ($row = mysql_fetch_row($result)) {
    $peutsupprimer = false ;
    $pascontent = $pascontent."\n<br>- disque ".$row[0].' '.$row[1].' emprunt&eacute; depuis le '.$row[2] ;
  }  

  if ($peutsupprimer) {
    $query = 'DELETE FROM clients WHERE trigramme="'.$trigramme.'"' ;
    $result = mysql_query($query) ;
    if (0!=$result) echo "<center>Le client a été effacé avec succès<br></center>\n" ;
    else echo "Une erreur s'est produite et le client n'a pas pu &ecirc;tre effacé...<br>" ;
  }
  else {
    echo '<center><b>Suppression interdite, il y a encore des disques emprunt&eacute;s par ce client :</b>' ;
    echo $pascontent ;
    echo '</center>' ;
  }

  mysql_close() ;
  echo $finpage ;
?>
