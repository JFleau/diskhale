<?php
    $mysql_user = 'dhc' ;
    $mysql_pswd = 'melodix' ;
    include("connection.php") ;
    echo "\n<html>\n<head>\n<title>Disques de Classique</title>\n</head>\n<body>\n" ;
?>



<?php

  $query = 'SELECT DISTINCT compositeurs FROM disques WHERE categorie = "classique" ORDER BY
  compositeurs' ;

  // echo $query.'<br>' ;
  $result = mysql_query($query) ;

  while ($row=mysql_fetch_row($result)) {
    echo "<u>".$row[0]."</u>";
	echo " : ";
	
	$query2 = 'SELECT oeuvres FROM disques WHERE compositeurs = "'.$row[0].'"
	AND categorie = "classique"';

    $result2 = mysql_query($query2) ;

    while ($row2=mysql_fetch_row($result2)) {
    	echo $row2[0];
		echo ", ";
	}
	echo "<br>";
  }

  $finpage ; 
  mysql_close() ;

?>
