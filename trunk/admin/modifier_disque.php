<?php
  include("identif.php") ;
  include("header.php");
  $codelettres=$_REQUEST['codelettres'];
  $numero=$_REQUEST['numero'];
?>

<center>
<font size=+6><b>Modification des param&egrave;tres d'un disque</b></font><br>

<br><br>

<?php
  $query = 'SELECT * FROM disques WHERE codelettres="'.$codelettres.'" AND numero='.$numero ; 
  $result = mysql_query($query) ;
  if ($row=mysql_fetch_row($result)) {
    echo '<center><form action="script_modif_disque.php?codelettres='.$codelettres.'&&numero='.$numero ;
    echo '" method=post>'."\n" ;

    echo '<table align="center" border="0">'."\n<tr>\n<td>Code lettres :<td>".$codelettres."\n</tr>\n" ;
    echo "<tr>\n<td>Num&eacute;ro :<td>".$numero."\n</tr>\n" ;
    echo "<tr>\n<td>Cat&eacute;gorie :\n<td>".'<select name="categorie">\n' ;

    //CATEGORIE
    //	categ[0]: code de stockage
    //	categ[1]: intitulé (dénomination)
	$query='SELECT * FROM type';
	$result=mysql_query($query);
	while($categ=mysql_fetch_row($result))
	{
		echo '<option value="'.$categ[0].'" ';
		if ($row[2]==$categ[0]) echo 'selected';
		echo '>'.$categ[1]."\n";
	}
    echo "</select><br>\n</tr>\n" ;

    echo "<tr>\n<td>Compositeur(s) :<td>".'<input type=text name="compositeurs" size=30 maxlength=255 value="' ;
    echo  htmlspecialchars($row[3]).'"><br>'."\n</tr>\n" ;
    echo "<tr>\n<td>Oeuvre(s) :<td>".'<input type=text name="oeuvres" size=30 maxlength=255 value="' ;
    echo htmlspecialchars($row[4]).'"><br>'."\n</tr>\n" ;
    echo "<tr>\n<td>Interpr&egrave;te(s) :<td>".'<input type=text name="interpretes" size=30 maxlength=255 value="' ;
    echo  htmlspecialchars($row[5]).'"><br>'."\n</tr>\n" ;
    echo "<tr>\n<td>Remarques :<td>".'<input type=text name="remarques" size=30 maxlength=255 value="' ;
    echo  htmlspecialchars($row[6]).'"><br>'."\n</tr>\n" ;
    echo "</table>\n<br><br><br>\n" ;
    echo '<input type=submit name="modifdisc" value="Valider">'."\n<br>\n</form>\n<br>\n" ;

  }
  else {
    echo('Disque non trouv&eacute; dans la base de donn&eacute;es<br>') ;
  }

?>



<?php
  mysql_close() ;
  echo $finpage ;
?>