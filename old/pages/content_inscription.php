<?php


$askedPage='inscription';




$form_values_valid=FALSE;

	if(isset($_POST["trigramme"]) && $_POST["trigramme"] != "" &&
            isset($_POST["nom"]) && $_POST["nom"] != "" &&
            isset($_POST["prenom"]) && $_POST["prenom"] != "" &&
            isset($_POST["mdp1"]) && $_POST["mdp1"] != "" &&
            isset($_POST["mdp2"]) && $_POST["mdp2"] != "" &&
            $_POST["mdp2"] == $_POST["mdp1"] &&
            isset($_POST["email"]) && $_POST["email"] != "" &&
            isset($_POST["kzert"]) && $_POST["kzert"] != "" &&
            isset($_POST["numero"]) && $_POST["numero"] != "") {


            connect();
            $trigramme=$_POST["trigramme"];
            $nom=$_POST["nom"];
            $prenom=$_POST["prenom"];
            $mdp1=$_POST["mdp1"];
            $email=$_POST["email"];
            $kzert=$_POST["kzert"];
            $numero=$_POST["numero"];
            $categorie=$_POST["categorie"];
            $news=$_POST["news"];
            $remarques=" ";
            $statut=" ";
            $cotisation="non";
            $caution="non";

            //echo isUser($trigramme,$mdp1);
            

            if(!isUser($trigramme)){
                $quer ="INSERT INTO `clients` (`trigramme`, `nom`, `prenom`,`password`,`categorie`,
                `nbmax`,`remarques`,`email`, `kazert`,`telephone`, `statut`, `cotisation`,`caution`)
                VALUES('$trigramme', '$nom', '$prenom','$mdp1','$categorie',
                '5','$remarques','$email', '$kzert','$numero', '$statut', '$cotisation','$caution')";
                if (!mysql_query($quer)) echo 'Erreur SQL '.mysql_error().': '.$quer;
                else $_SESSION["loggedIn"];
            }
            else{
                echo "utilisateur déjà inscrit";
                printRegisterForm($askedPage);
            }

            mysql_close();
            $form_values_valid=TRUE;
          // tous les champs requis cités ici
	  // code de traitement, à écrire maintenant
	  // si le traitement réussi, on passe $form_value_valid à TRUE
	}

	if (!$form_values_valid) {
            printRegisterForm($askedPage);
	  // code du formulaire, qui vient d'être écrit
	  // où les valeurs par défaut des champs sont pris dans le tableau $_GET
	  // ($_GET["champ"] est vide si non défini)
	}


?>