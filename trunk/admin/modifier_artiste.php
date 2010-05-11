<?php
  include("identif.php") ;
  include("header.php");

  $codelettres=$_REQUEST['codelettres'];
  ?>

<center>
<font size=+6><b>Modification des param&egrave;tres d'un artiste</b></font><br>

<br><br>

<?php
  $query = 'SELECT nom,categorie FROM compositeurs WHERE codelettres="'.$codelettres.'"' ; 
  $result = mysql_query($query) ;
  if ($row=mysql_fetch_row($result)) {
    echo '<center><form action="script_modif_artiste.php?codelettres='.$codelettres ;
    echo '" method=post>'."\n" ;
    echo '<table align="center" border="0">'."\n<tr>\n<td>Code lettres :<td>".$codelettres."\n</tr>\n" ;
    echo "<tr>\n<td>Nom :<td>".'<input type=text name="nom" size=30 maxlength=255 value="' ;
    echo $row[0].'"><br>'."\n</tr>\n" ;
    echo "<tr>\n<td>Cat&eacute;gorie :\n<td>".'<select name="categorie">\n' ;
    echo '<option value="classique"' ; if (0==strcmp($row[1],'classique')) echo ' selected' ;
    echo '>Classique'."\n".'<option value="interprete"' ;  if (0==strcmp($row[1],'interprete')) echo ' selected' ;
    echo '>Interprète'."\n".'<option value="jazz"' ;  if (0==strcmp($row[1],'jazz')) echo ' selected' ;    echo '>Jazz'."\n".'<option value="varietes"' ; if (0==strcmp($row[1],'varietes')) echo ' selected' ;
    echo '>Variétés'."\n".'<option value="film"' ; if (0==strcmp($row[1],'film')) echo ' selected' ;
    echo ">Musique de film\n</select><br>\n</tr>\n" ;
    echo "</table>\n<br><br><br>\n" ;
    echo '<input type=submit name="modifartiste" value="Valider">'."\n<br>\n</form>\n<br>\n" ;

  }
  else {
    echo('Artiste non trouv&eacute; dans la base de donn&eacute;es<br>') ;
  }

?>



<?php
  mysql_close() ;
  echo $finpage ;
?>
