<?php
  include("identif.php3") ;
  include("header.php3");

  $nom=$_REQUEST['nom'];
  $categorie=$_REQUEST['categorie'];
  $nbmax=$_REQUEST['nbmax'];
  $remarques=$_REQUEST['remarques'];
  $email=$_REQUEST['email'];
  $telephone=$_REQUEST['telephone'];
  $trigramme=$_REQUEST['trigramme'];
  
  $query = 'UPDATE clients SET nom="'.$nom.'",prenom="'.$prenom.'",categorie="'.$categorie ;
  $query = $query.'",nbmax='.$nbmax.',remarques="'.$remarques.'", email="'.$email.'",telephone="'.$telephone.'" ' ;
  $query = $query.' WHERE trigramme="'.$trigramme.'"' ;
  // echo $query."<br>" ;
  $result = mysql_query($query) ;
  if (0!=$result) {     // bien rentré dans la base
    echo "<center>Les caract&eacute;ristiques suivantes ont &eacute;t&eacute; rentr&eacute;es pour ce client :<br>\n" ;

    echo '<table>'."\n" ;
    echo '<tr><td><b>Trigramme: </b><td>'.$trigramme."\n</tr><tr><td><b>Nom: </b><td>".$nom."\n</tr>" ;
    echo "<tr><td><b>Pr&eacute;nom: </b><td>".$prenom."\n</tr><tr><td><b>Cat&eacute;gorie: </b><td>".$categorie."\n</tr>" ;
    echo "<tr><td><b>Nombre maximum de disques: </b><td>".$nbmax."\n</tr><tr><td><b>E-mail: </b><td>".$email."\n</tr>" ;
    echo "<tr><td><b>T&eacute;l&eacute;phone: </b><td>".$telephone."\n</tr><tr><td><b>Remarques: </b><td>".$remarques."\n</tr>" ;
    echo "<br>\n</table>\n" ;
    echo '<p><br><br></center>' ;
  }
  else echo "Une erreur s'est produite et aucune modification n'a pu être effectuée dans la base de données<br>" ;
 
  mysql_close() ;
  echo $finpage ;
?>
