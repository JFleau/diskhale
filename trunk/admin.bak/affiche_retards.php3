<?php


	include("identif.php3");
	include("header.php3");
	include("function_duree.php3");

	$date=getdate();
	$an=$date['year'];
	$mois=$date['mon'];
	$jour=$date['mday'];
	$auj=365*$an+30*$mois+$jour;
	

	$query='CREATE TEMPORARY TABLE retards (trig char(3), dat date)';
	$result=mysql_query($query);
	
	$query='INSERT INTO retards '.
	'SELECT  trigramme, dateemprunt FROM emprunts WHERE 365*YEAR(dateemprunt)+30*MONTH(dateemprunt)+DAYOFMONTH(dateemprunt)+30<'.$auj.' AND daterendu=0';
	
	$result = mysql_query($query);

	$query=' SELECT trigramme, nom, prenom, categorie, trig, MIN(dat) AS t, COUNT(trig), YEAR(MIN(dat)), MONTH(MIN(dat)), DAYOFMONTH(MIN(dat)), email FROM retards,clients WHERE trigramme=trig GROUP BY trig ORDER BY t';

	$result=mysql_query($query);

	
	?>

	<CENTER>

	<h2><b>Retards</b></h2>

	<table border="1">
	<tr>
	<td><b>Nom<td><b>Cat&eacute;gorie<td><td><b>Trigramme <td><b>Plus grand retard<td><b>Nombre de retards	
<?php
	while ($row=mysql_fetch_row($result))
	{
	echo '<tr>';
	echo '<td>'.$row[2].' '.$row[1];
	echo '<td>'.$row[3];
	echo '<td> <A HREF="mailto:'.$row[10].'">email';
	echo '<td>'.'<A HREF="traiter_client.php3?trigramme='.$row[4].'">'.$row[4];
	echo '<td>'. ($auj-365*$row[7]-30*$row[8]-$row[9]);
	echo '<td>'.$row[6];
	}

	$query='DROP TABLE retards';
	$result0=mysql_query($query);

	mysql_close();
	echo $finpage;
?>


	