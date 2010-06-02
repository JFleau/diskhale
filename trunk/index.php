<?php
    session_name("dhc" );
    // ne pas mettre d'espace dans le nom de session !
    session_start();
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    }
    // Décommenter la ligne suivante pour afficher le tableau $_SESSION pour le debuggage
    // print_r($_SESSION);


    require ('fonctions/printForms.php');
    require ('fonctions/logInOut.php');
    require ('fonctions/utils.php');
    require ('auth.php');

//reste du code PHP qui appelle les fonctions du fichier utils.php




echo '<?xml version="1.0" encoding="UTF-8"?>';


echo '<link rel="stylesheet" type="text/css" href="gabarit.css" />';


    if($_GET["action"] == "login") {
  	    logIn();
    }

    if($_GET["action"] == "logout") {
  	    logOut();
    }


    

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
            require('pages/content_accueil.php');
        }
        elseif($askedPage=='inscription'){
            require('pages/content_inscription.php');
        }
        elseif($askedPage =='contact'){
            require('pages/content_contact.php');
        }
        elseif($askedPage =='connexion'){
            require('pages/content_connexion.php');
            
        }
        elseif($askedPage =='modification'){
            require('pages/content_modification.php');
        }
        else require('pages/erreur.php');
        
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

<?php
//if($_SESSION["loggedIn"]) {
//    }
   
    ?>