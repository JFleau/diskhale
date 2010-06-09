<?php
$askedPage='modification';
$form_values_valid2=FALSE;
$arr = array(1 => "nom", 2 => "prenom",3 => "email",4 => "kzert",5 => "numero",6 =>"news");
$brr = array(1 => "nom", 2 => "prenom",3 => "email",4 => "kazert",5 => "telephone",6 =>"newsletter");


	if(isset($_POST["trigramme"]) && $_POST["trigramme"] != "" &&
        isset($_POST["old_password"]) && $_POST["old_password"] != ""){
//        
//        isset($_POST["new_password"]) && $_POST["new_password"] != "" &&
//        isset($_POST["new_password2"]) && $_POST["new_password2"] != "" &&
//        $_POST["new_password"]==$_POST["new_password2"]
//        isset($_POST["nom"]) && $_POST["nom"] != "" &&
//        isset($_POST["prenom"]) && $_POST["prenom"] != "" &&
//        isset($_POST["email"]) && $_POST["email"] != "" &&
//        isset($_POST["kzert"]) && $_POST["kzert"] != "" &&
//        isset($_POST["numero"]) && $_POST["numero"] != "") {

            connect();
            $trigramme=$_POST["trigramme"];
            $old_password=$_POST["old_password"];
//            $new_password=$_POST["new_password"];
//            $nom=$_POST["nom"];
//            $prenom=$_POST["prenom"];
//            $email=$_POST["email"];
//            $kzert=$_POST["kzert"];
//            $numero=$_POST["numero"];
//            $categorie=$_POST["categorie"];
//            $news=$_POST["news"];




//            echo !isUser($trigramme,$old_password);
//            echo !isUser($trigramme,$new_password);

            if(isUser2($trigramme,$old_password)){
                if(isset($_POST["new_password"]) && $_POST["new_password"] != "" &&
                   isset($_POST["new_password2"]) && $_POST["new_password2"] != "" &&
                   $_POST["new_password"]==$_POST["new_password2"]){
                        $new_password=$_POST["new_password"];
                        $sqlquery=mysql_query("UPDATE `clients` SET `password`='$new_password' WHERE `trigramme`='$trigramme' AND `password`='$old_password'");
                        if (!$sqlquery) echo 'Erreur SQL '.mysql_error().': '.$sqlquery;
                   }
                for($i=1;$i<=6;$i++){
                    if(isset($_POST["$arr[$i]"]) && $_POST["$arr[$i]"]!=""){
                        $val=$_POST["$arr[$i]"];
                        $db=$brr[$i];
                        $squery=mysql_query("UPDATE `clients` SET `$db`='$val' WHERE `trigramme`='$trigramme' AND `password`='$old_password'");
                        if (!$squery) echo 'Erreur SQL '.mysql_error().': '.$squery;
                    }
                    

                }
                
            }
            else{
                echo "modification non autoris&eacute;e";
                changepassword($askedPage);
            }

            mysql_close();
            $form_values_valid2=TRUE;
          // tous les champs requis cités ici
	  // code de traitement, à écrire maintenant
	  // si le traitement réussi, on passe $form_value_valid à TRUE
	}

	if (!$form_values_valid2) {
            changepassword($askedPage);
	  // code du formulaire, qui vient d'être écrit
	  // où les valeurs par défaut des champs sont pris dans le tableau $_GET
	  // ($_GET["champ"] est vide si non défini)
	}


?>
