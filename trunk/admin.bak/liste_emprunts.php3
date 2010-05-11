<?php
  include("identif.php3") ;
  include("header.php3");
?>

<center>
<font size=+6><b>Lister les disques emprunt&eacute;s</b></font><br>

<br><br>
<font size="+1"><b>Crit&egrave;res sur la date d'emprunt :</b></font>
<br><font size="-1">(les dates au format AAAAMMJJ ; ne rien mettre si pas besoin)</font>
<form action="script_liste_emprunts.php3" method="post">
<table border="0">
<tr>
  <td><br><b>&agrave; partir de : </b></td>
  <td><input type="text" name="datedebut" size=8 maxlength=8></td>
</tr>
<tr>
  <td><b>jusqu'&agrave; : </b></td>
  <td><input type="text" name="datefin" size=8 maxlength=8></td>
</tr>
</table>
<input type="submit" name="datesemprunts" value="Valider">
</form>
<br>
<br>
<font size="+1"><b>Ou pour avoir toute la liste :&nbsp;</b></font>
<a href="script_liste_emprunts.php3?tous=1">Clique ici</a><br>


<?php
  mysql_close() ;
  echo $finpage ;
?>