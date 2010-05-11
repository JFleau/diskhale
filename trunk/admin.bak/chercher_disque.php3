<!--modif=1 veut dire qu'on est en mode de recherche administrateur>
<!--sinon c'est en mode accessible a tous>

<?php
  $modif=$_REQUEST['modif'];
  if ($modif==1) {
   include("identif.php3") ;
   include("header.php3");
  echo "<center>\n<font size=+6><b>Recherche du disque &agrave; modifier</b></font><br>\n" ;
  }
  else {
    $mysql_user = 'dhc' ;
    $mysql_pswd = 'melodix' ;
    include("connection.php3") ;
    echo "<html>\n<head>\n";
    echo '<link href="style.css" rel="stylesheet" type="text/css">';
    echo "<title>Diskh&acirc;le Classique: recherche d'un disque dans la base de donn&eacute;es</title>\n" ;
    echo "</head>\n<body>\n" ;
    echo "<center>\n<font size=+6><b>Recherche d'un disque dans la base</b></font><br>\n" ;
  }
?>

<br><br>

<?php
  if ($modif==1) echo '<form action="script_cherche_disque.php3?modif=1" method=post>'."\n" ;
  else echo '<form action="script_cherche_disque.php3" method=post>'."\n" ;
?>

<table align="center" border="0">
<tr>
  <td>Cat&eacute;gorie :
  <td><select name="categorie">
    <option value="">&nbsp;-&nbsp;
<?php
    	$query='SELECT * FROM type';
	$result=mysql_query($query);
	while($row=mysql_fetch_row($result))
	{
	echo '<option value="'.$row[0].'">'.$row[1];
	}
?>
        </select><br>
</tr>
<tr>
  <td>Code lettres :
  <td><input type=text name="codelettres" size=6 maxlength=6 value=""><br>
</tr>
<tr>
  <td>Num&eacute;ro :
  <td><input type=text name="numero" size=3 maxlength=3 value=""><br>
</tr>
<tr>
  <td>Artiste/Compositeur(s) :
  <td><input type=text name="compositeurs" size=30 maxlength=255 value=""><br>
</tr>
<tr>
  <td>Oeuvre(s) :
  <td><input type=text name="oeuvres" size=30 maxlength=255 value=""><br>
</tr>
<tr>
  <td>Interpr&egrave;te(s) :
  <td><input type=text name="interpretes" size=30 maxlength=255 value=""><br>
</tr>
</table>
<br><br><br>
<input type=reset name="reset" value="Effacer tout">
<input type=submit name="newdisc" value="Lancer la recherche">

<br>
</form>

</center>

<?php
  mysql_close() ;
  if ($modif==1) echo $finpage ;
  else echo "\n</body>\n</html>\n" ;
?>

