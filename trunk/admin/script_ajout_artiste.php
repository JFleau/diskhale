<?php
  include("identif.php") ;
  include("header.php");

  $codelettres=$_REQUEST['codelettres'];
  $nom=$_REQUEST['nom'];
  $categorie=$_REQUEST['categorie'];

  // vérifier que le code-lettres n'est pas déjà pris (si l'utilisateur a cliqué deux fois par erreur...)
  $query='SELECT nom FROM compositeurs WHERE codelettres="'.$codelettres.'"' ;
  $result = mysql_query($query) ;     
  if ($row=mysql_fetch_row($result)) {
    echo "<center>Impossible d'entrer le nouvel artiste, le code-lettres est d&eacute;j&agrave; pris par ".$row[0] ;
    echo ".\n<br>".'<a href="ajouter_artiste.php">Ajouter un autre artiste</a><br>' ;
    die('</center>') ;
  }
  
  $codelettres = normalise($codelettres) ;
  $query = 'INSERT INTO compositeurs (codelettres,nom,categorie) VALUES ("' ;
  $query = $query.$codelettres.'","'.$nom.'","'.$categorie.'")' ;
  $result = mysql_query($query) ;
  if (0!=$result) {     // bien rentré dans la base
    echo "<center>Un nouvel artiste avec les caract&eacute;ristiques suivantes a &eacute;t&eacute; rentr&eacute; dans la base :<br>\n" ;
    echo '<table>'."\n" ;
    echo '<tr><td><b>Code-lettres: </b><td>'.$codelettres."\n</tr><tr><td><b>Nom: </b><td>".$nom."\n</tr>" ;
    echo "<tr><td><b>Cat&eacute;gorie: </b><td>".$categorie."\n</tr>" ;
    echo "<br>\n</table>\n" ;
    echo '<br><br><a href="modifier_artiste.php?codelettres='.$codelettres.'">' ;
    echo "Modifier ces param&egrave;tres</a>\n" ;
    echo '<br><br>' ;
    echo '<br><a href="ajouter_disque.php?codelettres='.$codelettres.'&&categorie='.$categorie.'">Ajouter un disque</a>' ;
    echo '<br><a href="ajouter_artiste.php">Ajouter un autre artiste</a></center>' ;
  }
  else echo "Une erreur s'est produite lors de l'entrée de l'artiste dans la base!!!!!!!!<br>" ;

  mysql_close() ;
  echo $finpage ;
?>
