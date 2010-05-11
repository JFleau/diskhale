<?php
  include("identif.php3") ;
  include("header.php3");

  $codelettres=$_REQUEST['codelettres'];
?>

<center>
<font size=+6><b>Ajout d'un disque &agrave; la base de donn&eacute;es</b></font><br>

<br><br>

<form action="script_ajout_disque.php3" method=post>
<table align="center" border="2">

<tr>
  <td>Code-lettres : 
<?php
  echo '  <td><input type=text name="codelettres" size=6 maxlength=6 value="' ;
  if ($codelettres!='') echo $codelettres ;
  echo '">'."\n      &nbsp;&nbsp;&nbsp;&nbsp;".'<a href="liste_artistes.php3">voir la liste</a>' ;
?>
</tr>

<tr>
  <td>Num&eacute;ro:
  <td><input type=text name="numero" size=3 maxlength=3 value="">&nbsp;&nbsp;
  <i>(si rien n'est mis, le num&eacute;ro du disque sera g&eacute;n&eacute;r&eacute; automatiquement)</i><br>
</tr>

<tr>
  <td>Cat&eacute;gorie : 
  <td><select name="categorie">
<?php
  $query='SELECT * FROM type';
  $result=mysql_query($query);
  while ($row=mysql_fetch_row($result))
  {
    echo '<option value="'.$row[0].'"';
    if ($categorie==$row[0]) echo ' selected';
    echo '>'.$row[1];
  }
  echo '</td>';
?>
    </select><br>
</tr>
<tr>
  <td>Artiste/Compositeur(s) :
  <td><input type=text name="compositeurs" size=30 maxlength=255 value="">
      <br><i>(Laisse ce champ vide pour laisser l'artiste par d&eacute;faut correspondant au code-lettres,
      <br><b>sauf si la cat&eacute;gorie est "Interpr&egrave;te")</b></i><br>
</tr>
<tr>
  <td>Oeuvre(s) :
  <td><input type=text name="oeuvres" size=30 maxlength=255 value=""><br>
</tr>
<tr>
  <td>Interpr&egrave;te(s) :
  <td><input type=text name="interpretes" size=30 maxlength=255 value=""><br>
      <i>(pour la cat&eacute;gorie de disques "Interpr&egrave;te", ce champ se remplira tout seul)</i><br>
</tr>
<tr>
  <td><i>Remarques :</i>
  <td><input type=text name="remarques" size=30 maxlength=255 value=""><br>
</tr>
</table>

<br><br><br>
<input type=reset name="reset" value="Effacer tout">
<input type=submit name="newdisc" value="Ajouter le disque">
<br>
</form>

</center>

<?php
  mysql_close() ;
  echo $finpage ;
?>
