<?php
  include("identif.php3") ;
  include("header.php3");

  $trigramme=$_REQUEST['trigramme'];
  $nom=$_REQUEST['nom'];
  $prenom=$_REQUEST['prenom'];
  $categorie=$_REQUEST['categorie'];
  $nbmax=$_REQUEST['nbmax'];
  $remarques=$_REQUEST['remarques'];
  $email=$_REQUEST['email'];
  $telephone=$_REQUEST['telephone'];

  // vérifier que le trigramme n'est pas déjà pris (si l'utilisateur a cliqué deux fois par erreur...)
  $query='SELECT nom,prenom FROM clients WHERE trigramme="'.$trigramme.'"' ;
  $result = mysql_query($query) ;     
  if ($row=mysql_fetch_row($result)) {
    echo "<center>Impossible d'entrer le nouveau client, le trigramme est d&eacute;j&agrave; pris par ".$row[1].' '.$row[0] ;
    echo ".\n<br>".'<a href="ajouter_client.php3">Ajouter un autre client</a><br>' ;
    die('</center>') ;
  }

  $trigramme = normalise($trigramme) ;  
  $query = 'INSERT INTO clients (trigramme,nom,prenom,categorie,nbmax,remarques,email,telephone) VALUES ("' ;
  $query = $query.$trigramme.'","'.$nom.'","'.$prenom.'","'.$categorie.'",'.$nbmax.',"'.$remarques.'","'.$email.'","'.$telephone.'")' ;
  $result = mysql_query($query) ;
  if (0!=$result) {     // bien rentré dans la base
    echo "<center>Un nouveau client avec les caract&eacute;ristiques suivantes a &eacute;t&eacute; rentr&eacute; dans la base :<br>\n" ;
    echo '<table>'."\n" ;
    echo '<tr><td><b>Trigramme: </b><td>'.$trigramme."\n</tr><tr><td><b>Nom: </b><td>".$nom."\n</tr>" ;
    echo "<tr><td><b>Pr&eacute;nom: </b><td>".$prenom."\n</tr><tr><td><b>Cat&eacute;gorie: </b><td>".$categorie."\n</tr>" ;
    echo "<tr><td><b>Nombre maximum de disques: </b><td>".$nbmax."\n</tr><tr><td><b>E-mail: </b><td>".$email."\n</tr>" ;
    echo "<tr><td><b>T&eacute;l&eacute;phone: </b><td>".$telephone."\n</tr><tr><td><b>Remarques: </b><td>".$remarques."\n</tr>" ;
    echo "<br>\n</table>\n" ;

    echo '<br><br><a href="modifier_client.php3?trigramme='.$trigramme.'">' ;
    echo "Modifier ces param&egrave;tres</a>\n" ;

    echo '<p><br><br><a href="traiter_client.php3?trigramme='.$trigramme.'">Traiter le client</a>'."\n" ;
    echo '<br><a href="ajouter_client.php3">Ajouter un autre client</a></center>' ;
  }
  else echo "Une erreur s'est produite lors de l'entrée du client dans la base!!!!!!!!<br>" ;

  mysql_close() ;
  echo $finpage ;
?>
