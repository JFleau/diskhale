<?php

  header("Content-Type:text/html; charset=iso-8859-1");
  $entete = "<html>\n\n<head>\n<title>Administration Diskh&acirc;le Classique</title>\n<!-- Pages et scripts faits par Fran&ccedil;ois Gu&eacute;rillon (X98) pour la Diskhale Classique. -->\n";
  $entete=$entete.'<link href="style.css" rel="stylesheet" type="text/css">';
  $entete=$entete."</head>\n\n<body>\n" ;

  //$finpage = "<br><br><br>\n<center>" ;
  //$finpage = $finpage.'<a href="index.php">Page administrateurs</a>' ;
  //$finpage = $finpage."</center>\n</body>\n\n</html>\n" ;

  $finpage='';

  function normalise($chaine) {
    $rep = trim($chaine) ;
    $rep = strtolower($rep) ;
    return $rep ;
  }

	echo $entete;


	echo "<a href='index.php'>Page administrateurs</a><br>\n";
?>
