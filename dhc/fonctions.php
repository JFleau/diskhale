<?php



function suppr_trig($trigramme){


//    if(ConfirmMessage()){
        $query="SELECT * FROM `emprunts` WHERE `trigramme` = '".$trigramme."' AND `daterendu`=0000-00-00";
        $res=mysql_query($query);
        $query3="SELECT * FROM `clients` WHERE `trigramme` = '".$trigramme."'";
        $res3=mysql_query($query3);
        if(mysql_numrows($res3)>0){
            if(mysql_numrows($res) == 0){
                $query2="DELETE FROM `dhc`.`clients` WHERE `clients`.`trigramme` = '".$trigramme."'";
                mysql_query($query2);
                return "Client supprimé";
            }
            else{
                return "Il reste des emprunts: on ne peut pas supprimer cet utilisateur";
            }
        }
        else{
            
        }

    }
//}

    
    




?>

<?php

function authorized($page) {
if ($_SESSION['loggedIn']==0) {
	if ($page=="accueil"||$page=="inscription"||$page=="recherche") $authorized=true; else $authorized=false;
	}
if ($_SESSION['loggedIn']==1) {
	if ($page=="accueil"||$page=="madiskhale"||$page=="recherche") $authorized=true; else $authorized=false;
	}
if ($_SESSION['loggedIn']==2) {
	if ($page=="accueil"||$page=="administration"||$page=="recherche"
            || $page=="ddm" || $page=="retardataires") $authorized=true; else $authorized=false;
	}

return $authorized;
}

function connect(){
mysql_connect("localhost", "root", "2uh5ZpjB7CsceR3w") or die("Erreur de connexion � MySQL");
mysql_select_db("dhc") or die("Erreur de connexion � la base de donn�es");
mysql_query("SET NAMES UTF8");
}

function checkaction() {
	if (isset($_POST['action'])) {
		$action=$_POST['action'];
		if ($action=="login") logIn();
		if ($action=="logout") logOut();
	}
}

function logIn() {
	$trigramme=$_POST['trigramme'];
	$password=$_POST['password'];
	$query="SELECT prenom FROM `clients` WHERE `trigramme` = '".$trigramme."' AND `password` = '".$password."' LIMIT 0 , 30";
	$result=mysql_query($query);
	if (mysql_num_rows($result)==0) {
		$_SESSION['bienvenue']="echec";
	}
	else {
		if ($trigramme=="dhc"){
                    $_SESSION['loggedIn']=2;
                    $_SESSION['bienvenue']="Session administrateur";
                }
                else{
					if (!isset($_SESSION['trigramme'])) $_SESSION['trigramme']=$trigramme; else $_SESSION['trigramme']=$trigramme;
                    $_SESSION['loggedIn']=1;
                    $array=mysql_fetch_assoc($result);
                    $_SESSION['bienvenue']="Bienvenue, <b>".$array['prenom']."</b> !";
                    $_SESSION['trigramme']=$trigramme;
                }
		
	}
}

//il faut creer l'administrateur dhc melodix dans la base de données.

function logOut() {
	$_SESSION['loggedIn']=0;
	$_SESSION['bienvenue']="0";
	unset($_SESSION['trigramme']);
}

function nombreresultats() {
	$deja=0;
	$query="SELECT oeuvres FROM `disques` WHERE ";
	if ($_POST['artiste']!="") {
		$query=$query."`compositeurs` LIKE '%".$_POST['artiste']."%'";
		$deja=1;
		}
	if ($_POST['oeuvre']!="") {
		if ($deja==1) $query=$query."AND `oeuvres` LIKE '%".$_POST['oeuvre']."%'"; else $query=$query."`oeuvres` LIKE '%".$_POST['oeuvre']."%'";
		$deja=1;
		}
	if ($_POST['interprete']!="") {
		if ($deja==1) $query=$query."AND `interpretes` LIKE '%".$_POST['interprete']."%'"; else $query=$query."`interpretes` LIKE '%".$_POST['interprete']."%'";
		$deja=1;
		}
	if ($_POST['categorie']!="") {
		if ($deja==1) $query=$query."AND `categorie` = '".$_POST['categorie']."'"; else $query=$query."`categorie` = '".$_POST['categorie']."'";
		$deja=1;
		}
	if ($_POST['code']!="") {
		if ($deja==1) $query=$query."AND `codelettres` LIKE '%".$_POST['code']."%'"; else $query=$query."`codelettres` LIKE '%".$_POST['code']."%'";
		$deja=1;
		}
	if ($_POST['numero']!="") {
		if ($deja==1) $query=$query."AND `numero` LIKE '%".$_POST['numero']."%'"; else $query=$query."`numero` LIKE '%".$_POST['numero']."%'";
		$deja=1;
		}
	if ($_POST['artiste']!=""||$_POST['oeuvre']!=""||$_POST['interprete']!=""||$_POST['categorie']!=""||$_POST['code']!=""||$_POST['numero']!="") {
	$result=mysql_query($query);
	return mysql_num_rows($result);
	}
}

function recherche($begin) {
	$deja=0;
	$query="SELECT `oeuvres`,`compositeurs`,`interpretes`,`categorie`,`codelettres`,`numero` FROM `disques` WHERE ";
	if ($_POST['artiste']!="") {
		$query=$query."`compositeurs` LIKE '%".$_POST['artiste']."%'";
		$deja=1;
		}
	if ($_POST['oeuvre']!="") {
		if ($deja==1) $query=$query."AND `oeuvres` LIKE '%".$_POST['oeuvre']."%'"; else $query=$query."`oeuvres` LIKE '%".$_POST['oeuvre']."%'";
		$deja=1;
		}
	if ($_POST['interprete']!="") {
		if ($deja==1) $query=$query."AND `interpretes` LIKE '%".$_POST['interprete']."%'"; else $query=$query."`interpretes` LIKE '%".$_POST['interprete']."%'";
		$deja=1;
		}
	if ($_POST['categorie']!="") {
		if ($deja==1) $query=$query."AND `categorie` = '".$_POST['categorie']."'"; else $query=$query."`categorie` = '".$_POST['categorie']."'";
		$deja=1;
		}
	if ($_POST['code']!="") {
		if ($deja==1) $query=$query."AND `codelettres` LIKE '%".$_POST['code']."%'"; else $query=$query."`codelettres` LIKE '%".$_POST['code']."%'";
		$deja=1;
		}
	if ($_POST['numero']!="") {
		if ($deja==1) $query=$query."AND `numero` LIKE '%".$_POST['numero']."%'"; else $query=$query."`numero` LIKE '%".$_POST['numero']."%'";
		$deja=1;
		}
	$query=$query." LIMIT ".($begin*5).", 5";
	if ($_POST['artiste']!=""||$_POST['oeuvre']!=""||$_POST['interprete']!=""||$_POST['categorie']!=""||$_POST['code']!=""||$_POST['numero']!="") {
	$result=mysql_query($query);
	return $result;
	}
}


function inscription(){

	$message="";

	if(isset($_POST['trigramme']) && $_POST['trigramme'] != "" &&
            isset($_POST['nom']) && $_POST['nom'] != "" &&
            isset($_POST['prenom']) && $_POST['prenom'] != "" &&
            isset($_POST['password']) && $_POST['password'] != "" &&
            isset($_POST['password2']) && $_POST['password2'] != "" &&
            $_POST['password2'] == $_POST['password'] &&
            isset($_POST['mail']) && $_POST['mail'] != "" &&
            isset($_POST['kzert']) && $_POST['kzert'] != "" &&
            isset($_POST['tel']) && $_POST['tel'] != "") {


            
            $trigramme=$_POST['trigramme'];
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $mdp1=$_POST['password'];
            $email=$_POST['mail'].$_POST['ecole'];
            $kzert=$_POST['kzert'];
            $numero=$_POST['tel'];
            $categorie=$_POST['categorie'];
            $news=$_POST['news'];
            $remarques=" ";
            $statut=" ";
            $cotisation="non";
            $caution="non";

            $trlen=strlen($trigramme);
//            echo !is_numeric($kzert);
//            echo !is_numeric($numero);
            if($trlen!=3 || !is_numeric($kzert) || !is_numeric($numero)|| (int)$kzert!=$kzert|| (int)$numero!=$numero){
                if($trlen!=3){
                    $message="Un trigramme contient 3 lettres !";
                }
                if(!is_numeric($kzert) || (int)$kzert!=$kzert){
                    $message="Le casert doit être un entier.";
                    //echo $kzert;
                    
                }
                if(!is_numeric($numero) || (int)$numero!=$numero){
                    $message="Le numéro de téléphone doit être un entier.";
                    //echo $numero;
                }
            }
            
            else{
                /* connect(); */
                $tr=mysql_query("SELECT * FROM `clients` WHERE `trigramme`='$trigramme'");
                $res=mysql_numrows($tr);
                if($res==0){
                    $quer ="INSERT INTO `clients` (`trigramme`, `nom`, `prenom`,`password`,`categorie`,
                    `nbmax`,`remarques`,`email`, `kazert`,`telephone`, `statut`, `cotisation`,`caution`)
                    VALUES('".$trigramme."', '".addslashes($nom)."', '".addslashes($prenom)."','".$mdp1."','".$categorie."',
                    '5','".$remarques."','".$email."', '".$kzert."','".$numero."', '".$statut."', '".$cotisation."','".$caution."')";
                    if (!mysql_query($quer)) echo 'Erreur SQL '.mysql_error().': '.$quer;
                    else {
					$_SESSION['loggedIn']=1;
					if (!isset($_SESSION['trigramme'])) $_SESSION['trigramme']=$trigramme; else $_SESSION['trigramme']=$trigramme;
					$_SESSION['bienvenue']="Bienvenue, <b>".$prenom."</b> !";
					$message="Vous êtes désormais inscrits à la diskhâle classique.";

					}
                }

                else{
                    $message="Le trigramme est déjà attribué.";
                }

            }
        }

        elseif(isset($_POST['action'])){
			if ($_POST['action']=="inscription") {
            $message="Le formulaire est mal rempli !";
        }
		}


return $message;


}

function emprunter($trigramme){
    	$numeroajout=$_POST['numero'];
        $codeajout=$_POST['codelettres'];
		$cat2=$_POST['categorie'];

		$query="SELECT * FROM `emprunts` WHERE (`codelettres`, `numero`, `categorie`, `trigramme`, `daterendu`)=('".$codeajout."','".$numeroajout."','".$cat2."','".$trigramme."','0000-00-00')";
		$result=mysql_query($query);
		$num=mysql_num_rows($result);
		
		if ($num!=0) return "Erreur. Vous avez déjà emprunté ce disque.";
		
        $string6="SELECT * FROM `clients` WHERE `trigramme`='".$trigramme."'";
        $query6=mysql_query($string6);
        $tab6 = mysql_fetch_assoc($query6);
        $nom2=$tab6['nom'] ;
        $prenom2=$tab6['prenom'] ;
	
		$query2="SELECT * FROM `emprunts` WHERE `trigramme`='".$trigramme."' AND `daterendu`='0000-00-00'";
		$result2=mysql_query($query2);
		$nombre=mysql_num_rows($result2);
		if ($nombre<5) {
        $string7="INSERT INTO `emprunts` (`codelettres`,`numero`,`categorie`,
        `trigramme`,`dateemprunt`,`daterendu`) VALUES('".$codeajout."',
        '".$numeroajout."','".$cat2."','".$trigramme."',CURRENT_DATE(),'0000-00-00')";
        //$query7=mysql_query($string7);
        if (!mysql_query($string7)) echo 'Erreur SQL '.mysql_error().': '.$string7;
		else return "Emprunt effectué avec succès.";
		}
		else return "Vous ne pouvez pas détenir plus de 5 disques simultanément.";
}

function modifier($trigramme){

    $a=array("password","password2","trigramme2","kazert","telephone","nom","prenom",
        "email","categorie","statut","cotisation","caution","remarques","nbmax","oldpassword");

    //$trigramme=$_SESSION['trigramme'];
    if($_SESSION['loggedIn']==2 || (isset($_POST[$a[14]]) && $_POST[$a[14]]!="")){
	
		if ($_SESSION['loggedIn']==1) {
        $pwd=$_POST[$a[14]];
        $s="SELECT * FROM `clients` WHERE `trigramme`='$trigramme' AND `password`='".$pwd."'";
		}
		if ($_SESSION['loggedIn']==2) {
        $s="SELECT * FROM `clients` WHERE `trigramme`='$trigramme'";
		}
        $se=mysql_query($s);
        $re=mysql_numrows($se);
                if($re==0 && $_SESSION['loggedIn']!=2){
                    return "Mot de passe incorrect.";
                }
                else{
                    for($i=3;$i<14;$i++){

                        if(isset($_POST[$a[$i]]) && $_POST[$a[$i]]!=""){
                            //$trigramme=$_SESSION['trigramme'];
                            $cle=$a[$i];
                            $val=$_POST[$cle];

                            if($cle=="kazert"){
                                if($val!="exemple: 691009"){
                                    if(!is_numeric($val) || (int)$val!=$val ){
                                        return "Le casert doit être un entier.";
                                    }
                                    else{
                                        $query="UPDATE `clients` SET `".$cle."`='".$val."' WHERE `trigramme`='".$trigramme."'";
                                        if (!mysql_query($query)) return 'Erreur SQL '.mysql_error().': '.$query;
                                        
                                    }
                                }


                            }
                            elseif($cle=="telephone" ){
                                if($val!="exemple: 6419"){
                                    if(!is_numeric($val) || (int)$val!=$val){
                                        return "Le numéro de téléphone doit être un entier.";
                                    }
                                    else{
                                        $query="UPDATE `clients` SET `".$cle."`='".$val."' WHERE `trigramme`='".$trigramme."'";
                                        if (!mysql_query($query)) return 'Erreur SQL '.mysql_error().': '.$query;
                                        
                                    }
                                }

                            }
                            else{
                                $query="UPDATE `clients` SET `".$cle."`='".addslashes($val)."' WHERE `trigramme`='".$trigramme."'";
                                if (!mysql_query($query)) return 'Erreur SQL '.mysql_error().': '.$query;
                                
                            }

                        }
                    }
				    if(isset($_POST[$a[0]]) && isset($_POST[$a[1]]) && $_POST[$a[0]]!="") {
						if ($_POST[$a[0]]==$_POST[$a[1]]){
                    //$trigramme=$_SESSION['trigramme'];
                    $pass=$_POST[$a[1]];
                    $query="UPDATE `clients` SET `password`='".$pass."' WHERE `trigramme`='".$trigramme."'";
                    if (!mysql_query($query)) return 'Erreur SQL '.mysql_error().': '.$query;
						}
						else return "Le nouveau mot de passe et sa confirmation doivent être identiques.";
                    }

				return "Modifications effectuées avec succès.";
                }
    }
    elseif(isset($_POST['action']) && $_POST['action']=='modifier'){
        return "Mot de passe incorrect.";
    }
}

function ajmod(){
    $a=array("categorie","compositeurs","oeuvres","interpretes","remarques");
    $b=array("categorie_m","artiste_m","oeuvre_m","interprete_m","remarques_m");


    if(isset($_POST['codem']) && isset($_POST['numerom'])
       && $_POST['codem']!="" && $_POST['numerom']!=""){
       $code=$_POST['codem'];
       $numero=$_POST['numerom'];
       $query="SELECT * FROM `disques` WHERE `codelettres`= '".$code."' AND `numero`= '".$numero."'";
       $rquery=mysql_query($query);
       $res=mysql_numrows($rquery);
       if($res==0){

           if(isset($_POST['categorie_m']) && $_POST['categorie_m']!=""
                && isset($_POST['interprete_m']) && $_POST['interprete_m']!=""
                && isset($_POST['oeuvre_m']) && $_POST['oeuvre_m']!=""
                && isset($_POST['artiste_m']) && $_POST['artiste_m']!=""){

                $categorie=$_POST['categorie_m'];
                $interpretes=$_POST['interprete_m'];
                $oeuvre=$_POST['oeuvre_m'];
                $artiste=$_POST['artiste_m'];
                if(isset($_POST['remarques_m'])) {$remarques=$_POST['remarques_m'];} else $remarques="";
                $query2="INSERT INTO `disques`(`codelettres`,`numero`,`categorie`,`compositeurs`,
            `oeuvres`,`interpretes`,`remarques`) VALUES ('".$code."', '".$numero."', '".
                $categorie."','".$artiste."','".$oeuvre."','".$interpretes."','".$remarques."')";  //a modifier
                if (!mysql_query($query2)) return 'Erreur SQL '.mysql_error().': '.$query2;
           }

           else{
               ?>
                <!--<div id="infos" style="height:310px;">-->
                    <p>Formulaire mal rempli</p>
                <!--</div>-->

               <?php

           }

        }
        else{
            for($i=0;$i<5;$i++){
                if(isset($_POST[$b[$i]]) && $_POST[$b[$i]]!=""){
                    $cle=$_POST[$b[$i]];
                    $val=$a[$i];
                    $query3="UPDATE `disques` SET `$val`='$cle' WHERE `codelettres`='".$code."' AND `numero`='".$numero."'";
                    if (!mysql_query($query3)) return 'Erreur SQL '.mysql_error().': '.$query3;

                    if($b[$i]=="categorie_m"){
                        $query4="UPDATE `emprunts` SET `$val`='$cle' WHERE `codelettres`='".$code."' AND `numero`='".$numero."'";
                        if (!mysql_query($query4)) return 'Erreur SQL '.mysql_error().': '.$query4;
                    }

                }
            }

        }


    }
    else{
        $y=0;
        for($i=0;$i<5;$i++){
                if(isset($_POST[$b[$i]]) && $_POST[$b[$i]]!=""){
                    $y++;
                }
        }
        if($y>0){

        ?>
        <!--<div id="infos" style="height:310px;">-->
            <p>Donnez un disque valide</p>
        <!--</div>-->
        <?php
        }
    }
}

?>