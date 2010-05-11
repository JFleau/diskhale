<?php
  include("identif.php3") ;
  include("header.php3");

  $codelettres=$_REQUEST['codelettres'];
  $categorie=$_REQUEST['categorie'];
  $interpretes=$_REQUEST['interpretes'];
  $compositeurs=$_REQUEST['compositeurs'];
  $numero=$_REQUEST['numero'];
  $oeuvres=$_REQUEST['oeuvres'];
  $remarques=$_REQUEST['remarques'];

$codelettres = normalise($codelettres) ;

$clexiste = false ;
$query = 'SELECT nom,categorie FROM compositeurs WHERE codelettres="'.$codelettres.'"' ;
$result = mysql_query($query) ;
if ($row = mysql_fetch_row($result)) $clexiste = true ;

if (!$clexiste) {     // le code-lettres n'existe pas... 
  echo "<center>Le code-lettres que tu as entr&eacute; n'existe pas, impossible d'entrer ce disque.<br>\n" ;
  echo 'Pour cr&eacute;er ce code-lettres,&nbsp;<a href="ajouter_artiste.php3?codelettres=' ;
  echo $codelettres.'">clique ici</a>' ; 
  echo "\n</center>\n" ;
}
else {
  if (0!=strcmp($row[1],$categorie)) {
    echo '<center><b>Avertissement :</b>&nbsp; la cat&eacute;gorie entr&eacute; ne correspond pas à la cat&eacute;gorie ';
    echo 'par défaut de cet artiste.<br>Le disque va quand m&ecirc;me &ecirc;tre entr&eacute; dans la base...<br>' ;
    echo "\n<br>\n</center>\n" ; 
  }
  
  if (0==strcmp($categorie,"interprete")) {
    if (0==strcmp($interpretes,'')) $interpretes = $row[0] ;    
  }
  else {
    if (0==strcmp($compositeurs,'')) $compositeurs = $row[0] ;
  }
 
  if ($numero!='') {  // si l'administrateur a donné un numero
    $query = 'SELECT numero,categorie FROM disques WHERE codelettres="'.$codelettres.'" AND numero='.$numero ;
    $result = mysql_query($query);
    if ($row = mysql_fetch_row($result)) {
      echo "<center><blink>ATTENTION: Le num&eacute;ro propos&eacute; est d&eacute;j&agrave; pris, un autre num&eacute;ro " ;
      echo "est attribu&eacute; automatiquement.</blink><br><br>\n</center>\n" ;
      $numero = '' ;
    }
  }

  if ($numero=='') {
    $query = 'SELECT numero,categorie FROM disques WHERE codelettres="'.$codelettres.'" ORDER BY numero' ;
    $result = mysql_query($query);
    $numero = 0 ;
    $compteur = 0 ;
    while (($row=mysql_fetch_row($result)) && ($numero<=$compteur)) {
      $numero = $row[0] ;
      $compteur = $compteur+1 ;
    }
    if ($numero<=$compteur) $compteur = $compteur+1 ;
  }
  else {
    $compteur = $numero ;
  }

  $query = 'INSERT INTO disques (codelettres,numero,categorie,compositeurs,oeuvres,interpretes,remarques) VALUES ("' ;
  $query = $query.$codelettres.'",'.$compteur.',"'.$categorie.'","'.$compositeurs.'","'.$oeuvres.'","'.$interpretes.'","'.$remarques.'")' ;
  $result = mysql_query($query) ;
  if (0!=$result) {     // bien rentré dans la base
    echo "<center>Un nouveau disque avec les caract&eacute;ristiques suivantes a &eacute;t&eacute; rentr&eacute; dans la base :<br>\n" ;
    echo '<table>'."\n" ;
    echo '<tr><td><b>Code-lettres: </b><td align="left">'.$codelettres."\n</tr><tr><td><b>Num&eacute;ro: </b><td>".$compteur."\n</tr>" ;
    echo "<tr><td><b>Cat&eacute;gorie: </b><td>".$categorie."\n</tr><tr><td><b>Artiste/Compositeur(s): </b><td>".$compositeurs."\n</tr>" ;
    echo "<tr><td><b>Oeuvre(s): </b><td>".$oeuvres."\n</tr><tr><td><b>Interpr&egrave;te(s): </b><td>".$interpretes."\n</tr>" ;
    echo "<tr><td><b>Remarques: </b><td>".$remarques."</tr><br>\n</table>\n" ;
    echo '<br><br><br><a href="modifier_disque.php3?codelettres='.$codelettres.'&&numero='.$compteur.'">' ;
    echo "Modifier ces param&egrave;tres</a>\n" ;
    echo '<p><br><br><a href="ajouter_disque.php3?categorie='.$categorie.'">Ajouter un autre disque</a>'."\n" ;
    echo '<br><a href="ajouter_disque.php3?codelettres='.$codelettres.'&&categorie='.$categorie.'">Ajouter un disque du m&ecirc;me auteur</a>'."\n" ;
    echo '<br><br><a href="ajouter_artiste.php3">Ajouter un nouvel artiste</a></center>' ;
  }
  else echo "Une erreur s'est produite lors de l'entrée du disque dans la base!!!!!!!!<br>" ;
}


mysql_close() ;
echo $finpage ;
?>
