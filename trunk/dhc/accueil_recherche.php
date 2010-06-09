<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=100" >
<title>Diskhâle classique</title>
<link rel="stylesheet" type="text/css" href="style2.css" />
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

</head>

<body bgcolor="#dddddd" marginheight="0" marginwidth="0" bottommargin="0" topmargin="0" rightmargin="0" leftmargin="0">

	<?php include "fonctions.php" ?>
    <?php 
		if (!isset($_GET['page'])) {
			$page="recherche";
			}
		else {
			$page=$_GET['page'];
				if (!authorized($page)) {
					$page="accueil";
					}
			}
	?>
	<?php include "pages.php" ?>
    
    
<div id="conteneur">

	<div id="header">
	<?php include "header.php" ?>    
    </div>
    
    <div id="content">
	<?php include $url; ?>    
	</div>
    
</div>

</body>
</html>