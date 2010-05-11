<?php
  $modif=$_REQUEST['modif'];
  $codelettres=$_REQUEST['codelettres'];
  $numero=$_REQUEST['numero'];
  $compositeurs=$_REQUEST['compositeurs'];
  $oeuvres=$_REQUEST['oeuvres'];
  $interpretes=$_REQUEST['interpretes'];


  if ($modif==1) {
    include("identif.php") ;
    include("header.php");
  }
  else {
    $mysql_user = 'dhc' ;
    $mysql_pswd = 'melodix' ;
    include("connection.php") ;
    echo "\n<html>\n<head>\n<title>Diskh&acirc;le Classique: r&eacute;sultats de la recherche</title>\n</head>\n<body>\n" ;
  }
?>

<center>
<font size=+6><b>R&eacute;sultats de la recherche</b></font><br>
<br>

<?php
  if ($modif==1) echo '<font color="#FF0000">Cliquer sur le M pour modifier, sur le X pour effacer, ou sur le H pour'." l'historique des emprunts</font><br><br>\n" ;

  if (0!=strcmp('',$codelettres)) $criteres = '(codelettres LIKE "'.$codelettres.'") AND' ;
  if (strcmp($numero,'')!=0) $criteres = $criteres.' (numero='.$numero.') AND' ;
  $criteres = $criteres.' categorie LIKE "%'.$categorie.'"' ;
  $criteres = $criteres.' AND ( (compositeurs) LIKE ("%'.$compositeurs.'%") )' ;
  $criteres = $criteres.' AND ( (oeuvres) LIKE ("%'.$oeuvres.'%") ) AND ( (interpretes) LIKE ("%'.$interpretes.'%") )' ;
  $query = 'SELECT codelettres,numero,categorie,compositeurs,oeuvres,interpretes,remarques FROM disques WHERE '.$criteres ;

  if ($codelettres=='') {
    $query = $query.' ORDER BY categorie,compositeurs,numero' ;}
  else {
    $query = $query.' ORDER BY categorie,numero' ;
  }
  // echo $query.'<br>' ;
  $result = mysql_query($query) ;

  echo '<table align="center" border="2">'."\n" ;
  $nombre = 0 ;
  while ($row=mysql_fetch_row($result)) {
    $nombre++ ;
    // voir si le disque est emprunte actuellement
    $query_emprunt = 'SELECT trigramme,daterendu FROM emprunts WHERE (daterendu=0 OR daterendu=NULL) AND codelettres="'.$row[0].'" AND numero='.$row[1] ;
    // echo $query_emprunt."<br>" ;

    $result_emprunt = mysql_query($query_emprunt) ;

    $emprunteur = '' ;
    // echo $result_emprunt."<br>" ;
    while (($row_emprunt=mysql_fetch_row($result_emprunt)) && (0==strcmp($emprunteur,''))) {
       if ($row_emprunt[1]==0) $emprunteur = $row_emprunt[0] ;
       //echo "DATE: ".$row_emprunt[1]."  -   EMPRUNTEUR: ".$emprunteur."<br>" ;
    }

    if ($nombre==1) {
      echo "<tr>" ;
      if ($modif==1) echo '<td>&nbsp;<td>&nbsp;<td>&nbsp;' ;
      echo "<td><b>Code-lettres</b><td><b>Num&eacute;ro</b><td><b>Cat&eacute;gorie</b><td><b>Compositeur(s)</b>" ;
      echo "<td><b>Oeuvre(s)</b><td><b>Interpr&egrave;te(s)</b><td><b>Remarques</b>";
	if ($modif==1) echo "<td><i><b>emprunt&eacute; par</b></i>";
	else		echo "<td><i><b>emprunt&eacute;</b></i>";
      echo "\n</tr>\n" ;
    }
    echo '<tr><td>' ;
    if ($modif==1) {
      echo '<a href="modifier_disque.php?codelettres='.$row[0].'&&numero='.$row[1].'">&nbsp;M&nbsp;</a><td>' ;
      echo '<a href="script_effacer_disque.php?codelettres='.$row[0].'&&numero='.$row[1].'">&nbsp;X&nbsp;</a><td>' ;
      echo '<a href="script_historique_disque.php?codelettres='.$row[0].'&&numero='.$row[1].'">&nbsp;H&nbsp;</a><td>' ;
    }
    echo $row[0].'<td>'.$row[1].'<td>'.$row[2].'<td>'.$row[3].'<td>'.$row[4].'<td>'.$row[5].'<td>'.$row[6] ;
    echo '&nbsp;<td><font color="#FF0000">' ;
    if ($modif==1)
      echo '<a href="traiter_client.php?trigramme='.$emprunteur.'">'.$emprunteur.'</a>' ;
    else
      if (strcmp($emprunteur,'')!=0) echo 'OUI';
    echo "&nbsp;</font>\n</tr>\n" ;
  }

  echo "</table>\n\n" ;
  if ($nombre==0) {
    echo "Aucun disque correspondant aux crit&egrave;res demand&eacute;s n'a &eacute;t&eacute; trouv&eacute;<br>" ;
  }
  else {
    echo '<br>'.$nombre.' disques ont &eacute;t&eacute; trouv&eacute;s.'."\n" ;
  }

  echo "<br><br><br>\n" ;
  echo '<a href="' ;
  if ($modif==1) echo 'chercher_disque.php?modif=1' ;
  else echo 'chercher_disque.php' ;
  echo '">Retour aux crit&egrave;res de recherche</a><br>'."\n" ;



  if ($modif!=1) echo "</center>\n</body>\n\n</html>" ;
  else echo $finpage ;
  mysql_close() ;

?>
