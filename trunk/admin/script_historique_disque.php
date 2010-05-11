<?php
  include("identif.php") ;
  include("header.php");

  $codelettres=$_REQUEST['codelettres'];
  $numero=$_REQUEST['numero'];
?>


<center>
<font size=+6><b>Historique des emprunts</b></font><br>
<font size=+1><b>
<?php
  echo $codelettres.'&nbsp;'.$numero ;
?>
</b></font><br>
<br>

<?php

  
  $query = 'SELECT trigramme,dateemprunt,daterendu FROM emprunts WHERE (codelettres="'.$codelettres.'" AND numero='.$numero.') ORDER BY dateemprunt' ;
  $result = mysql_query($query) ;

  echo '<br><table align="center" border="2">'."\n" ;
  $nombre = 0 ;
  while ($row=mysql_fetch_row($result)) {
    $nombre++ ;
    if ($nombre==1) {
      echo "<tr>" ;
      echo "<td><b>Emprunt&eacute; par</b><td><b>le</b><td><b>rendu le</b>" ;
      echo "\n</tr>\n" ;
    }
    echo '<tr>' ;
    echo '<td><a href="traiter_client.php?trigramme='.$row[0].'">'.$row[0].'</a><td>'.$row[1].'<td>' ;
    if ($row[2]!=0 && $row[2]!=NULL) echo $row[2] ; 
    else echo "<i>pas encore</i>\n" ; 
    echo "</tr>\n" ;
  }

  echo "</table>\n" ;
  echo $finpage ; 
  mysql_close() ;

?>
