<?php
  include("identif.php") ;
  include("header.php");

  $trigramme=$_REQUEST['trigramme'];
?>

<center>
<font size=+6><b>Modification des param&egrave;tres d'un client</b></font><br>

<br><br>

<?php
  $query = 'SELECT nom,prenom,categorie,nbmax,remarques,email,telephone FROM clients WHERE trigramme="'.$trigramme.'"' ; 
  $result = mysql_query($query) ;
  if ($row=mysql_fetch_row($result)) {
    echo '<center><form action="script_modif_client.php?trigramme='.$trigramme ;
    echo '" method=post>'."\n" ;
    echo '<table align="center" border="0">'."\n<tr>\n<td>Trigramme :<td>".$trigramme."\n</tr>\n" ;
    echo "<tr>\n<td>Nom :<td>".'<input type=text name="nom" size=30 maxlength=255 value="' ;
    echo $row[0].'"><br>'."\n</tr>\n" ;
    echo "<tr>\n<td>Pr&eacute;nom :<td>".'<input type=text name="prenom" size=30 maxlength=255 value="' ;
    echo $row[1].'"><br>'."\n</tr>\n" ;

    echo "<tr>\n<td>Cat&eacute;gorie :\n<td>".'<select name="categorie">'."\n" ;
    $query2 = 'SELECT categ FROM categories ORDER BY categ' ;
    $result2 = mysql_query($query2) ;
    while ($row2 = mysql_fetch_row($result2)) {
      echo '    <option value="'.$row2[0].'"' ;
      if (0==strcmp($row2[0],$row[2])) echo ' selected' ;
      echo '>'.$row2[0]."\n" ;
    }

    echo '</select><br>'."\n</tr>\n" ;

    echo "<tr>\n<td>Nombre de disques maxi :<td>".'<input type=text name="nbmax" size=2 maxlength=2 value="' ;
    echo $row[3].'"><br>'."\n</tr>\n" ;
    echo "<tr>\n<td>Adresse e-mail :<td>".'<input type=text name="email" size=30 maxlength=255 value="' ;
    echo $row[5].'"><br>'."\n</tr>\n" ;
    echo "<tr>\n<td>T&eacute;l&eacute;phone :<td>".'<input type=text name="telephone" size=14 maxlength=14 value="' ;
    echo $row[6].'"><br>'."\n</tr>\n" ;
    echo "<tr>\n<td>Remarques :<td>".'<input type=text name="remarques" size=30 maxlength=255 value="' ;
    echo $row[4].'"><br>'."\n</tr>\n" ;
    echo "</table>\n<br><br><br>\n" ;
    echo '<input type=submit name="modifclient" value="Valider">'."\n<br>\n</form>\n<br>\n" ;

  }
  else {
    echo('Client non trouv&eacute; dans la base de donn&eacute;es<br>') ;
  }

?>



<?php
  mysql_close() ;
  echo $finpage ;
?>
