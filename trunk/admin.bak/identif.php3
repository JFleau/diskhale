<?php
  $entete = "<html>\n\n<head>\n<title>Administration Diskh&acirc;le Classique</title>\n<!-- Pages et scripts faits par François Gu&eacute;rillon (X98) pour la Diskhale Classique. -->\n</head>\n\n<body>\n" ;
  $finpage = "<br><br><br>\n<center>" ;
  $finpage = $finpage.'<a href="admin.php3">Page administrateurs</a>' ;
  $finpage = $finpage."</center>\n</body>\n\n</html>\n" ; 

  if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER']!='dhc' || crypt($_SERVER['PHP_AUTH_PW'],'zo')!='zo963WKxRzcIk') { 	// mauvaise identification
  	Header("WWW-Authenticate: Basic realm=\"Diskhâle Classique\"");
    	Header("HTTP/1.0 401 Unauthorized");
        echo "<html>\n<head>\n<title>Administration Diskh&acirc;le Classique</title>\n</head>\n<body>\n" ;
	echo 'Tant pis pour toi...<br>' ;
    echo "</body>\n\n</html>\n" ;
    die('') ;
  }
  else {      	// bon login (dhc), bon mot de passe, mysql connecté
    //$mysql_pswd = $_SERVER['PHP_AUTH_PW'] ;
  	$mysql_pswd ="melodix"; 
	$mysql_user="dhc";
    include("connection.php3") ;
  }


?>