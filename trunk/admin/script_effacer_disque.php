<?php

  include("identif.php") ;
  include("header.php");

  $codelettres=$_REQUEST['codelettres'];
  $numero=$_REQUEST['numero'];
  
  if ((0!=strcmp($codelettres,'')) && ($numero>0)) {
    $query = 'DELETE FROM disques WHERE codelettres="'.$codelettres.'" AND numero='.$numero ;
    // echo $query.'<br>' ;
    $result = mysql_query($query) ;
    if (0!=$result) echo "<center>Le disque a �t� effac� avec succ�s<br></center>\n" ;
    else echo "Une erreur s'est produite et le disque n'a pas pu &ecirc;tre effac�...<br>" ;
  }
  else {
    echo "mauvais param&egrave;tres, rien n'a pu &ecirc;tre effac&eacute;<br>" ;
  }

mysql_close() ;
echo $finpage ;
?>
