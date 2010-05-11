<?php
  include("identif.php3") ;
  include("header.php3");

  $codelettres=$_REQUEST['codelettres'];
?>

<center>
<font size=+6><b>Ajout d'un artiste &agrave; la base de donn&eacute;es</b></font><br>

<br><br>

<?php
  if (0==strcmp($codelettres,'') || strlen($codelettres)>6) :
  // PAGE GENEREE SI AUCUN CODE-LETTRES PROPOSE
?>

<form action="ajouter_artiste.php3" method=post>
Choisis un code-lettres pour le nouvel artiste, et je verrai s'il existe d&eacute;j&agrave; :<br>
<input type=text name="codelettres" size=6 maxlength=6 value="">&nbsp;<input type=submit name="codelettreschoisi" value="Envoyer"><br>
</form>
<br>

<?php
  else :
  // PAGE GENEREE SI UN CODE-LETTRES EST PROPOSE 
    $codelettres = normalise($codelettres) ;
    $query='SELECT nom FROM compositeurs WHERE codelettres="'.$codelettres.'"' ;
    $result = mysql_query($query) ;     
    if ($row = mysql_fetch_row($result)) {
      echo 'Le code-lettres entr&eacute; est d&eacute;j&agrave; pris par '.$row[0] ;
      echo ".\n<br>".'<br><a href="ajouter_artiste.php3">Choisir un autre code-lettres</a><br>' ;
      die('') ;
    }
?>

<font size=+1>Le code-lettres entr&eacute; est disponible</font><br>
<br><br>
<?php echo '<form action="script_ajout_artiste.php3?codelettres='.$codelettres.'" method=post>' ; ?>
<table align="center" border="0">
<tr>
  <td>Code-lettres : 
  <?php echo '<td>'.$codelettres ; ?>
</tr>
<tr>
  <td>Nom :
  <td><input type=text name="nom" size=30 maxlength=255 value=""><br>
</tr>
<tr>
  <td>Cat&eacute;gorie : 
  <td><select name="categorie">
    <option value="classique" selected>Classique
    <option value="interprete" selected>Interpr&egrave;te
    <option value="jazz">Jazz
    <option value="varietes">Variétés
    <option value="film">Musique de film
    </select><br>
</tr>
</table>

<br><br><br>
<input type=submit name="newartiste" value="Ajouter cet artiste">
<br>
</form>

</center>

<?php
endif;
?>

<?php
  mysql_close() ;
  echo $finpage ;
?>
