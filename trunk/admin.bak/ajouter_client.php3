<?php
  include("identif.php3") ;
  include("header.php3");

  $trigramme=$_REQUEST['trigramme'];
?>

<center>
<font size=+6><b>Ajout d'un client &agrave; la base de donn&eacute;es</b></font><br>

<br><br>

<?php
  if (0==strcmp($trigramme,'') || strlen($trigramme)>3) :
  // PAGE GENEREE SI AUCUN TRIGRAMME PROPOSE
?>

<form action="ajouter_client.php3" method=post>
Choisis un trigramme pour le nouveau client, et je verrai s'il existe d&eacute;j&agrave; :<br>
<input type=text name="trigramme" size=3 maxlength=3 value="">&nbsp;<input type=submit name="trigrammechoisi" value="Envoyer"><br>
</form>
<br>

<?php
  else :
  // PAGE GENEREE SI UN TRIGRAMME EST PROPOSE 
    $trigramme = normalise($trigramme) ;
    $query='SELECT nom,prenom FROM clients WHERE trigramme="'.$trigramme.'"' ;
    $result = mysql_query($query) ;     
    if ($row = mysql_fetch_row($result)) {
      echo 'Le trigramme entr&eacute; est d&eacute;j&agrave; pris par '.$row[1].' '.$row[0] ;
      echo ".\n<br>".'<a href="ajouter_client.php3">Choisir un autre trigramme</a><br>' ;
      die('') ;
    }
?>

<font size=+1>Le trigramme entr&eacute; est disponible</font><br>
<br><br>
<?php echo '<form action="script_ajout_client.php3?trigramme='.$trigramme.'" method=post>' ; ?>
<table align="center" border="0">
<tr>
  <td>Trigramme : 
  <?php echo '<td>'.$trigramme ; ?>
</tr>
<tr>
  <td>Nom :
  <td><input type=text name="nom" size=30 maxlength=255 value=""><br>
</tr>
<tr>
  <td>Pr&eacute;nom :
  <td><input type=text name="prenom" size=30 maxlength=255 value=""><br>
</tr>

<tr>
  <td>Cat&eacute;gorie : 
  <td><select name="categorie">

<?php
  $query = 'SELECT categ FROM categories ORDER BY categ' ;
  $result = mysql_query($query) ;
  while ($row = mysql_fetch_row($result)) {
    echo '    <option value="'.$row[0].'">'.$row[0]."\n" ;
  }
?>

  </select><br>
</tr>

<tr>
  <td>Nombre maxi de disques :
  <td><input type=text name="nbmax" size=2 maxlength=2 value="05"><br>
</tr>
<tr>
  <td>Adresse e-mail :
  <td><input type=text name="email" size=30 maxlength=255 value=""><br>
</tr>
<tr>
  <td>T&eacute;l&eacute;phone :
  <td><input type=text name="telephone" size=12 maxlength=12 value=""><br>
</tr>
<tr>
  <td><i>Remarques :</i>
  <td><input type=text name="remarques" size=30 maxlength=255 value=""><br>
</tr>
</table>
<br><br><br>
<input type=reset name="reset" value="Effacer tout">
<input type=submit name="newclient" value="Ajouter le client">
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
