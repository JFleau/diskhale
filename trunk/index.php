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
    if($_GET["action"] == "logadmin") {
  	    logAdmin();
    }


    

        switch (isset($_GET['page'])) {
        case 'true': $askedPage=$_GET['page']; break;
        default: $askedPage=welcome;
        }

        $logInOut=$_SESSION["loggedIn"];
        $authorized=checkPage($askedPage,$logInOut);

        if($authorized){
            $pageTitle=getPageTitle($askedPage,$logInOut);
        }
        else{
            $pageTitle="Erreur";
        }
//        echo $pageTitle;
//        echo $logInOut;
//        echo $authorized;
//        echo getPageTitle($askedPage,$logInOut);




    generateHTMLHeader($pageTitle,"gabarit.css");
    //echo $askedPage;
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

            

        if($_SESSION["loggedIn"]==1){
            if($askedPage =='modification'){
                require('pages/content_modification.php');
            }
            elseif($askedPage =='suppression'){
                require('pages/content_delete_user.php');
            }
            elseif($askedPage=='welcome'){
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
            elseif($askedPage =='recherche'){
                require('pages/content_recherche.php');
            }
            elseif($askedPage =='administrateur'){
                require('pages/content_admin.php');
            }
            else{
                require('pages/erreur.php');
            }
        }


        elseif($_SESSION["loggedIn"]==2){

            if($askedPage=='welcome'){
                require('pages/content_accueil.php');
            }
            elseif($askedPage =='contact'){
                require('pages/content_contact.php');
            }
            elseif($askedPage =='recherche'){
                require('pages/content_recherche.php');
            }
            else{
                require('pages/erreur.php');
            }
        }

        else{
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
            elseif($askedPage =='recherche'){
                require('pages/content_recherche.php');
            }
            elseif($askedPage =='administrateur'){
                require('pages/content_admin.php');
            }
            else{
                require('pages/erreur.php');
            }
        }

        
            
        
       
       
        
        
    ?>
    
   

    
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
//echo $_SESSION["loggedIn"];
   
    ?>