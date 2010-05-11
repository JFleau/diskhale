<?php

  include("identif.php") ;
  include("header.php");

  $codelettres=$_REQUEST['codelettres'];

  if (0!=strcmp($codelettres,'')) {
    $query = 'SELECT numero FROM disques WHERE codelettres="'.$codelettres.'"' ;  
    $result = mysql_query($query) ; 
    if ($row=mysql_fetch_row($result)) {
      echo "<center>Impossible d'effacer cet artiste, il y a des disques dans la base identifi&eacute;s par ce code-lettres</center><br>\n" ;
    }
    else {
      $query = 'DELETE FROM compositeurs WHERE codelettres="'.$codelettres.'"' ;
      // echo $query.'<br>' ;
      $result = mysql_query($query) ;
      if (0!=$result) echo "<center>L'artiste a été effacé avec succès<br></center>\n" ;
      else echo "Une erreur s'est produite et l'artiste n'a pas pu &ecirc;tre effac&eacute;...<br>" ;
    }
  }
  else {
    echo "mauvais param&egrave;tres, rien n'a pu &ecirc;tre effac&eacute;<br>" ;
  }

  mysql_close() ;
  echo $finpage ;
?>