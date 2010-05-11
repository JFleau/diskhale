<?php
  include("identif.php") ;
  include("header.php");
  ?>


<center><font size=+6><b>Chercher un/des client(s)</b></font><br>

<br><br>

<form action="script_cherche_client.php" method=post>
<table align="center" border="0">

<tr>
  <td>Trigramme :
  <td><input type=text name="trigramme" size=30 maxlength=255 value=""><br>
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
      <option value="">&nbsp;-&nbsp;

<?php
  $query = 'SELECT categ FROM categories ORDER BY categ' ;
  $result = mysql_query($query) ;
  while ($row = mysql_fetch_row($result)) 
  {   
  echo '    <option value="'.$row[0].'">'.$row[0]."\n" ;
  }
?>

  </select><br>
</tr>
<tr>
  <td>Nombre maxi de disques :
  <td><input type=text name="nbmax" size=2 maxlength=2 value=""><br>
</tr>
<tr>
  <td>Remarques :
  <td><input type=text name="remarques" size=30 maxlength=255 value=""><br>
</tr>
</table>
<br><br><br>
<input type=reset name="reset" value="Effacer tout">
<input type=submit name="findclient" value="Lancer la recherche">

<br>
</form>

</center>

<?php
  mysql_close() ;
  echo $finpage ; 
?>

