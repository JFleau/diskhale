<?php
  include("identif.php3") ;
  include("header.php3");
  include("function_duree.php3");

  $rendre= $_REQUEST['rendre'];
  $trigramme = $_REQUEST['trigramme'];
  $numero= $_REQUEST['numero'];
  $codelettres= $_REQUEST['codelettres'];
  $emprunter= $_REQUEST['emprunter'];

  $trigramme = normalise($trigramme) ;

  // rendre le disque si demandé :
  if ($rendre==1) {
    // echo 'codelettres='.$codelettres.' - trigramme='.$trigramme.' - numero='.$numero.'<br>' ; 
    if ((0!=strcmp($trigramme,'')) && (0!=strcmp($codelettres,'')) && ($numero>0)) {
      $query = 'UPDATE emprunts SET daterendu="'.date("Y-m-d").'" WHERE trigramme="'.$trigramme.'" AND codelettres="'.$codelettres.'" AND numero='.$numero ;
      // echo $query.'<br>' ;
      $result = mysql_query($query) ;
      if (0==$result) {
        echo "<br>Une erreur s'est produite et le disque n'a pas pu &ecirc;tre rendu.......<br>" ;
        die($finpage) ;
      }
    } 
  }
  // emprunter le disque si demandé :
  else if ($emprunter==1) {
    // echo 'codelettres='.$codelettres.' - trigramme='.$trigramme.' - numero='.$numero.'<br>' ; 
    $codelettres = normalise($codelettres) ;
    if ((0!=strcmp($trigramme,'')) && (0!=strcmp($codelettres,'')) && ($numero>0)) {
      // vérifier l'existence du disque à emprunter
      $query = 'SELECT compositeurs,categorie FROM disques WHERE codelettres="'.$codelettres.'" AND numero='.$numero ;
      $result = mysql_query($query) ;      
      if ($row = mysql_fetch_row($result)) {
        // vérifier l'existence du trigramme
        $categorie = $row[1] ;
        $query = 'SELECT nom,nbmax FROM clients WHERE trigramme="'.$trigramme.'"' ;
        $result = mysql_query($query) ;      
        if ($row = mysql_fetch_row($result)) {
          // vérifier qu'il n'en n'a pas déjà emprunté le nombre maximum autorisé
          $nbmax = $row[1] ;
          $query = 'SELECT trigramme,COUNT(*) FROM emprunts WHERE (daterendu=0 OR daterendu=NULL) AND trigramme="'.$trigramme.'" GROUP BY trigramme' ;
          $result = mysql_query($query) ;            
          $nbemprunts = 0 ;
          if ($row=mysql_fetch_row($result)) $nbemprunts = $row[1] ;

          if ($nbemprunts<$nbmax) {
            // vérifier qu'il n'est pas déjà emprunté
            $query = 'SELECT trigramme FROM emprunts WHERE codelettres="'.$codelettres.'" AND numero='.$numero ;
            $query = $query.' AND (daterendu=0 OR daterendu=NULL)' ;
            $result = mysql_query($query) ;            
            if ($row = mysql_fetch_row($result)) {
              echo "<br><center>Impossible d'emprunter ce disque, il est d&eacute;j&agrave; emprunt&eacute; par " ;
              echo $row[0]."<br>\n" ;
              echo '<a href="traiter_client.php3?trigramme='.$trigramme.'">Retour</a></center>' ;
              die($finpage) ;
            }
            else  {               
              // alors tout est bon, on peut enregistrer l'emprunt
              $query = 'INSERT INTO emprunts (codelettres,numero,categorie,trigramme,dateemprunt,daterendu) VALUES("' ;
              $query = $query.$codelettres.'",'.$numero.',"'.$categorie.'","'.$trigramme.'","'.date("Y-m-d").'",0)' ;
              // echo $query.'<br>' ;  
              $result = mysql_query($query) ;
              if (0==$result) {
                echo "<br>Une erreur s'est produite et l'emprunt n'a pas pu &ecirc;tre enregistr&eacute;.......<br>" ;
                die($finpage) ;
              }
            }
          }
          else {
            echo "<br><center>Impossible d'ajouter un nouvel emprunt pour ce client, il est au maximum autoris&eacute;<br>\n" ;
            echo '<a href="traiter_client.php3?trigramme='.$trigramme.'">Retour</a></center>' ;
            die($finpage) ;
          }

        }
        else {
          echo "<center><br>Mauvais trigramme, l'op&eacute;ration n'a pas pu &ecirc;tre effectu&eacute;e.<br>" ;
          echo '<a href="traiter_client.php3">Retour</a></center>' ;
          die($finpage) ;
        }
      }
      else {
        echo '<br><center>Disque inexistant, op&eacute;ration impossible<br>' ;
        echo '<a href="traiter_client.php3?trigramme='.$trigramme.'">Retour</a><br></center>' ;
        die($finpage) ; 
      }
    } 
  }

?>

<center>
<font size=+6><b>Traiter un client</b></font><br>

<br><br>

<?php
  if (0==strcmp($trigramme,'') || strlen($trigramme)>3) :
  // PAGE GENEREE SI AUCUN TRIGRAMME PROPOSE
?>

<form action="traiter_client.php3" method=post>
Trigramme du client &agrave; traiter :<br>
<input type=text name="trigramme" size=3 maxlength=3 value="">&nbsp;<input type=submit name="trigrammechoisi" value="Valider"><br>
</form>
<br>

<?php
  else :
  // PAGE GENEREE SI UN TRIGRAMME EST PROPOSE 
    $query='SELECT nom,prenom,categorie,nbmax,remarques,email,telephone FROM clients WHERE trigramme="'.$trigramme.'"' ;
    $result = mysql_query($query) ;     
    if ($row = mysql_fetch_row($result)) {
      echo "<br>\n" ;
      echo '<font size=+2 color="#104075">'.$row[0].' '.$row[1].'&nbsp;</font> ('.$row[2].")<br>\n" ;
      if ($row[4]!='') echo $row[4]."<br>\n" ;
      echo '<a href="mailto:'.$row[5].'">envoyer un e-mail</a><br>' ;
      echo "\nTel: ".$row[6]."<br>\n" ;
      echo "<br><i>".$row[3]." disques maximum</i><br><br><br>\n" ;

      // formulaire d'emprunt
      echo "<font size=+1><b>Ajouter un emprunt :</b></font>\n" ;
      echo '<form action="traiter_client.php3?emprunter=1&&trigramme='.$trigramme.'" method=post>' ;      
      echo 'Code-lettres du disque :<input type=text size=6 maxlength=6 name="codelettres" value="">&nbsp;' ;
      echo '&nbsp; Num&eacute;ro :<input type=text size=3 maxlength=3 name="numero" value="">&nbsp;' ;
      echo '&nbsp; <input type=submit name="empruntons" value="Emprunter">'."\n" ;
      echo "</form><br>\n" ;
   
      // afficher les disques empruntés par le client :
      echo "<font size=+1><b>Emprunts actuels :</b></font><br>\n" ;
      echo '<table border="1">'."\n" ;
      echo "<tr><td><b>disque</b><td><b>artiste/compositeur(s)</b><td><b>oeuvre(s)</b><td><b>remarques</b><td><b>date</b><td><b>Dur&eacute;e d'emprunt</b><td>&nbsp;\n</tr>\n" ;
      $query = 'SELECT codelettres,numero,dateemprunt, YEAR(dateemprunt), MONTH(dateemprunt), DAYOFMONTH(dateemprunt) FROM emprunts WHERE trigramme="'.$trigramme.'" AND (daterendu=0 OR daterendu=NULL)' ;      
      $result = mysql_query($query) ;

      // Trouver la date actuelle pour calculer les durees d'emprunt
      $aujourdhui=getdate();
      $an=$aujourdhui['year'];
      $mois=$aujourdhui['mon'];
      $jour=$aujourdhui['mday'];

      //Affiche les emprunts
      while ($row = mysql_fetch_row($result)) {
        echo '<tr><td>'.$row[0].' '.$row[1] ;
        $query2 = 'SELECT compositeurs,oeuvres,remarques FROM disques WHERE codelettres="'.$row[0].'" AND numero='.$row[1] ;
        // echo '<br>'.$query2.'<br>' ;
        $result2 = mysql_query($query2) ;
        if ($row2 = mysql_fetch_row($result2)) echo '<td>'.$row2[0].'<td>'.$row2[1].'<td>'.$row2[2] ;
        else echo '<td><i>erreur</i><td><i>erreur</i>' ;
        echo '<td>'.$row[2].'<td>' ;
	$duree_emprunt= duree_appro($row[3],$row[4],$row[5],$an,$mois,$jour);
	if ($duree_emprunt>30) echo "<font color='#FF0000'>";
	echo $duree_emprunt.'<td>';
        echo '<a href="traiter_client.php3?trigramme='.$trigramme.'&&rendre=1&&codelettres='.$row[0].'&&numero='.$row[1].'">' ;
        echo 'rendre</a>' ;
        echo "\n</tr>\n" ;        
      }

      echo "</table><br>\n<br><br>\n" ;

   }
    else {
      echo '<center><br>Aucun client trouv&eacute; pour ce trigramme.<br><a href="traiter_client.php3">Retour</a></center>' ;
    }
?>

<?php
endif;
?>

<?php
  mysql_close() ;
  echo $finpage ;
?>
