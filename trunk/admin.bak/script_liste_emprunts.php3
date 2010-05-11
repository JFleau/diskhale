<?php
  include("identif.php3") ;
  include("header.php3");

  $datedebut=$_REQUEST['datedebut'];
  $datefin=$_REQUEST['datefin'];
?>


<center>
<font size=+6><b>Liste des disques emprunt&eacute;s</b></font><br>
<br>

<?php

  
  $query = 'SELECT codelettres,numero,categorie,trigramme,dateemprunt FROM emprunts WHERE (daterendu=0 OR daterendu=NULL)' ;
  if ($datedebut) $query = $query.' AND (dateemprunt>='.$datedebut.')' ;
  if ($datefin) $query = $query.' AND (dateemprunt<='.$datefin.')' ;
  $query = $query.' ORDER BY dateemprunt' ;
  // echo $query ;
  $result = mysql_query($query) ;

  if(!$tous) {
    if ($datedebut) echo "Date minimale: ".$datedebut."<br>\n" ;
    if ($datefin)   echo "Date maximale: ".$datefin."<br>\n" ;    
  }

  echo '<br><table align="center" border="2">'."\n" ;
  $nombre = 0 ;
  while ($row=mysql_fetch_row($result)) {
    $nombre++ ;
    if ($nombre==1) {
      echo "<tr>" ;
      echo "<td><b>Code-lettres</b><td><b>Num&eacute;ro</b><td><b>Cat&eacute;gorie</b><td><b>Emprunt&eacute; par</b>" ;
      echo "<td><b>le</b><td>&nbsp;" ;
      echo "\n</tr>\n" ;
    }
    echo '<tr><td>' ;
    echo $row[0].'<td>'.$row[1].'<td>'.$row[2].'<td><a href="traiter_client.php3?trigramme='.$row[3].'">'.$row[3].'</a><td>'.$row[4] ;
    echo '<td>&nbsp;<a href="script_cherche_disque.php3?modif=1&&codelettres='.$row[0].'&&numero='.$row[1].'">' ;
    echo '<i>propri&eacute;t&eacute;s</a>&nbsp;</i>' ;
    echo "</tr>\n" ;
  }
  echo "</table>\n" ;
  if ($tous) {
    echo "\n<br><br><br>Il y a actuellement " ;
    echo $nombre ;
    echo " disques emprunt&eacute;s<br><br><br>\n" ;
  }

  echo $finpage ; 
  mysql_close() ;

?>
