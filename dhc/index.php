<?php
    session_name("dhc");
    session_start();
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    	}
	if (!isset($_SESSION['loggedIn'])) {
		$_SESSION['loggedIn']=0;
		}
	
	if (!isset($_SESSION['bienvenue'])) {
		$_SESSION['bienvenue']="0";
		}
		
	include "fonctions.php";
	connect();
	checkaction();
	
	if (isset($_POST['action'])) {
		if ($_POST['action']=="inscription") {
    		$message=inscription();
		}
	
		if ($_POST['action']=="emprunter") {
			if ($_SESSION['loggedIn']==1) {
				$trigramme=$_SESSION['trigramme'];
				$message=emprunter($trigramme);

			}
			if ($_SESSION['loggedIn']==2) {
				$trigramme=$_POST['trigramme'];
				$query="SELECT * FROM `clients` WHERE `trigramme`='".$_POST['trigramme']."'";
				$result=mysql_query($query);
				$num=mysql_num_rows($result);
				if ($num!=1) $message="Trigramme inconnu."; else $message=emprunter($trigramme);
			}
		}
	
		if ($_POST['action']=="modifier") {
			if ($_SESSION['loggedIn']==1) $message=modifier($_SESSION['trigramme']);
			if ($_SESSION['loggedIn']==2) $message=modifier($_POST['trigramme']);
		}
		
		if ($_POST['action']=="delete"&&$_SESSION['loggedIn']==2) {
				if ($_POST['nombre']!=0) $message="Suppression impossible. Des emprunts sont en cours.";
				else {
					$query="DELETE FROM `clients` WHERE `trigramme`='".$_POST['trigramme']."'";
					if (!mysql_query($query)) $message='Erreur SQL '.mysql_error().': '.$query;
					else $message="Suppression réussie.";
				}
		}
		if ($_POST['action']=="rendre") {
				$query="UPDATE `emprunts` SET `daterendu`=CURDATE() WHERE `codelettres`='".$_POST['codelettres']."' AND `numero`='".$_POST['numero']."' AND `daterendu`='0000-00-00'";
				$result=mysql_query($query);
				if (!mysql_query($query)) $message='Erreur SQL '.mysql_error().': '.$query;
				else $message="Le disque a été rendu.";
		}
		if ($_POST['action']=="ajout_disque") {
				$query="INSERT INTO `disques` (`codelettres`, `numero`, `compositeurs`, `interpretes`, `oeuvres`, `categorie`) VALUES ('".$_POST['codelettres']."', '".$_POST['numero']."', '".addslashes($_POST['artiste'])."', '".addslashes($_POST['interprete'])."', '".addslashes($_POST['oeuvre'])."', '".$_POST['categorie']."')";
				$result=mysql_query($query);
				$message="Disque ajouté avec succès.";
		}
				if ($_POST['action']=="modif_disque") {
				$query1="UPDATE `disques` SET `compositeurs`='".addslashes($_POST['artiste'])."' WHERE `codelettres`='".$_POST['codelettres']."' AND `numero` = '".$_POST['numero']."' ";
				$result1=mysql_query($query1);
				$query2="UPDATE `disques` SET `interpretes`='".addslashes($_POST['interprete'])."' WHERE `codelettres`='".$_POST['codelettres']."' AND `numero` = '".$_POST['numero']."' ";
				$result2=mysql_query($query2);
				$query3="UPDATE `disques` SET `oeuvres`='".addslashes($_POST['oeuvre'])."' WHERE `codelettres`='".$_POST['codelettres']."' AND `numero` = '".$_POST['numero']."' ";
				$result3=mysql_query($query3);
				$query4="UPDATE `disques` SET `categorie` = '".$_POST['categorie']."' WHERE `codelettres`='".$_POST['codelettres']."' AND `numero` = '".$_POST['numero']."' ";
				$result4=mysql_query($query4);
				$message="Disque modifié avec succès.";
		}

	}
    
	if (!isset($_GET['page'])) {
			$page="recherche";
			}
	else {
		$page=$_GET['page'];
			if ($_SESSION['loggedIn']==1&&$page=="inscription") $page="madiskhale";
			if ($_SESSION['loggedIn']==2&&$page=="inscription") $page="administration";
			if ($_SESSION['loggedIn']==0&&$page=="madiskhale") $page="inscription";
			if ($_SESSION['loggedIn']==0&&$page=="administration") $page="inscription";
			if (!authorized($page)) {
				$page="accueil";
				}
		}
	include "pages.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=100" >
<title>Diskhâle classique</title>
<link rel="stylesheet" type="text/css" href="style2.css" />
<script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
<!--

   function verify(champ,value)
   {
   if (champ.value=='') return value;
   if (champ.value==value) return '';
   if (champ.value!='' && champ.value!=value) return champ.value;   
   };
	
 
   function calculcotisation()
   {
   var tarifsVC=new Array("5€","4€","4€","13€","12€","12€","10€","9€","8€","6€","6€","5€");
   var tarifsTOS=new Array("14€","14€","13€","21€","20€","19€","18€","17€","16€","16€","15€","15€");
   var promo = document.forms["cotisation"].promo.value;
   var date=new Date;
   var mois=date.getMonth();
   if (promo=="2008") return 'Cotisation : '+tarifsVC[mois];
   if (promo=="2009") return 'Cotisation : '+tarifsTOS[mois];
   };
   
   function nomdumois()
   {
   var nom=new Array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
   var date=new Date;
   var mois=date.getMonth();
   return 'Mois actuel : '+ nom[mois];
   };
   
//-->
</script>
<script type="text/javascript">
<!--
	jQuery().ready(function() {
		$(".byebye").hide();
		$(".cache").click(function() {
		if ($(this).next("div").is(":hidden")) {
				$(".cache").next("div").slideUp();
				$(this).next("div").slideDown();
		}
		else {
		}
		});
	});
//-->
</script>

</head>

<body bgcolor="#dddddd" marginheight="0" marginwidth="0" bottommargin="0" topmargin="0" rightmargin="0" leftmargin="0">
    
<div id="conteneur">

	<?php include "header.php" ?> 
    
    <?php   
    	if (isset($message)) {
			if ($message!="") {
				if ($message=="Vous êtes désormais inscrits à la diskhâle classique."||$message=="Emprunt effectué avec succès."||$message=="Modifications effectuées avec succès."||$message=="Mot de passe modifié avec succès."||$message=="Suppression réussie."||$message=="Le disque a été rendu."||$message=="Disque ajouté avec succès."||$message="Disque modifié avec succès.") echo '<div id="message" style="background-color:#46D249; color:#003300; border-bottom-color:#003300;"><img src="images/OK.png" style="vertical-align:middle">&nbsp;&nbsp;'.$message.'</div>';
				else echo '<div id="message" style="background-color:#DE7A7A; color:#990000; border-bottom-color:#990000;"><img src="images/Wrong.png" style="vertical-align:middle">&nbsp;&nbsp;'.$message.'</div>';
			}
		}
	?>

    <div id="content">
	<?php include $url; ?>    
	</div>
    
</div>

</body>
</html>
