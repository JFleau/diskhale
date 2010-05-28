<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<link rel="stylesheet" type="text/css" href="gabarit.css" />

<?php
require('utils.php');
//reste du code PHP qui appelle les fonctions du fichier utils.php
?>

<?php
switch (isset($_GET['page'])) {
  case 'true': $askedPage=$_GET['page']; break;
  default: $askedPage=welcome;
}

$authorized=checkPage($askedPage);

if($authorized){
    $pageTitle=getPageTitle($askedPage);
}
else{
    $pageTitle="Erreur";
}
?>



<?php
    generateHTMLHeader($pageTitle,"gabarit.css");
?>


<body>

<div class="title">
    <h1><?php echo $pageTitle;?></h1>
    <p>
    Contenu du bandeau, qui est souvent
    le meme pour toutes les pages.
    </p>
</div>






<div id="global">
    <?php
  
        if($askedPage=='welcome'){
            require('content_accueil.php');
        }
        elseif($askedPage=='inscription'){
            require('content_inscription.php');
        }
        elseif($askedPage =='contact'){
            require('content_contact.php');
        }
        elseif($askedPage =='connexion'){
            require('content_connexion.php');
        }
        else require('erreur.php');
        
    ?>
    
   

    <p>
    Contenu de la page.
    </p>
</div>


<!--<div class="footer">
    <p>
    Contenu du pied de page, qui est souvent
    le meme pour toutes les pages.
    </p>
</div>
-->




</body>
</html>