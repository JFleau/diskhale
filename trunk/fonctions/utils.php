<?php
    function generateHTMLHeader($titre,$css){
        echo <<<CHAINE_DE_FIN

        <!DOCTYPE html PUBLIC "-//W3C//DTD Xhtml 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <title> $titre </title>
        </head>
        <link rel="stylesheet" type="text/css" href="$css" />
CHAINE_DE_FIN;
    }


    function generateHTMLFooter(){
        echo <<<CHAINE_DE_FIN
        </body><br>
        </html>
CHAINE_DE_FIN;
    }
?>


<?php
    function checkPage($askedPage){
        //Chargement du fichier
        if($logInOut==1){
            $xml = simplexml_load_file("pages/pages_connected_user.xml");
        //echo "<div id=\"navigation\">";
        }
        elseif($logInOut==2) {
            $xml = simplexml_load_file("pages/pages_admin.xml");
        }
        else{
            $xml = simplexml_load_file("pages/pages_user.xml");
        }

	//Recuperation de l'ensemble des noeuds correspondant aux balises "note"
	//$tableauDesPages = $xml->page
	//Parcours du tableau des notes (on peut utiliser egalement une boucle "for")
	foreach($xml as $page){
            //Recuperation du contenu de la balise "titre" de chaque note
            $nom=$page->name;
            
            
            if ($nom == $askedPage){
            return true;
            }

        }
        return false;
    }
?>

<?php
function getPageTitle($nom){
    //Chargement du fichier
        if($logInOut==1){
            $xml = simplexml_load_file("pages/pages_connected_user.xml");
        //echo "<div id=\"navigation\">";
        }
        elseif($logInOut==2) {
            $xml = simplexml_load_file("pages/pages_admin.xml");
        }
        else{
            $xml = simplexml_load_file("pages/pages_user.xml");
        }

	//Recuperation de l'ensemble des noeuds correspondant aux balises "note"
	//$tableauDesPages = $xml->page;

	//Parcours du tableau des notes (on peut utiliser egalement une boucle "for")
	foreach($xml as $page){
            
            $page->name;

            if ($nom==$page->name){ //Premier cas possible
            $titre=$page->menutitle;
            return $titre;
            }


        }
        return "Erreur";
}


function generateMenu($askedPage,$logInOut){
    if($logInOut==1){
        $xml = simplexml_load_file("pages/pages_connected_user.xml");
        //echo "<div id=\"navigation\">";
    }
    elseif($logInOut==2) {
        $xml = simplexml_load_file("pages/pages_admin.xml");
    }
    else{
        $xml = simplexml_load_file("pages/pages_user.xml");
    }
    echo "<ul>";
    
    foreach($xml as $page){
        if($askedPage==$page->name){

            echo "<li class=\"selectedItem\"><a href=\"index.php?page=";
            echo $page->name;
            echo "\">";
            echo $page->title;
            echo "</a></li>".PHP_EOL;
        }
        else{
            echo "<li><a href=\"index.php?page=";
            echo $page->name;
            echo "\">";
            echo $page->title;
            echo "</a></li>".PHP_EOL;
        }
    }
    if($logInOut>0){
        printLogOutForm();
    }
    
    echo "</ul>";
    echo "</div>";

    
//    <div id="centre">
//              <div>
//                  Si tu n'es pas connecté, tu peux t'identifier
//              </div>
//              <div>Si tu es connecté, tu peux :
//                  <ul>
//                      <li>Faire une commande</li>
//                      <li>Consulter tes emprunts</li>
//                  </ul>
//              </div>
//              <div>Si en plus tu es admin, tu peux :
//                  <ul>
//                      <li>Gérer les disques</li>
//                      <li>Gérer les utilisateurs</li>
//                      <li>Gérer les emprunts</li>
//                  </ul>
//              </div>
//          </div>

}

?>