<?php

function authorized($page) {
if ($_SESSION['loggedIn']==0) {
	if ($page=="accueil"||$page=="inscription"||$page=="recherche") $authorized=true; else $authorized=false;
	}
if ($_SESSION['loggedIn']==1) {
	if ($page=="accueil"||$page=="madiskhale"||$page=="recherche") $authorized=true; else $authorized=false;
	}
if ($_SESSION['loggedIn']==2) {
	if ($page=="accueil"||$page=="administration"||$page=="recherche"||$page=="retardataires") $authorized=true; else $authorized=false;
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
                    VALUES('".$trigramme."', '".$nom."', '".$prenom."','".$mdp1."','".$categorie."',
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


        $string5="SELECT `categorie` FROM `disques` WHERE `codelettres`='$codeajout' AND `numero`='$numeroajout'";
        $query5=mysql_query($string5);
        $tab5 = mysql_fetch_assoc($query5);
        $cat2=$tab5['categorie'] ;

        $string6="SELECT * FROM `clients` WHERE `trigramme`='$trigramme'";
        $query6=mysql_query($string6);
        $tab6 = mysql_fetch_assoc($query6);
        $nom2=$tab6['nom'] ;
        $prenom2=$tab6['prenom'] ;

        $string7="INSERT INTO `emprunts` (`codelettres`,`numero`,`categorie`,
        `trigramme`,`dateemprunt`,`daterendu`) VALUES('$codeajout',
        '$numeroajout','$cat2','$trigramme',CURRENT_DATE(),'0000-00-00')";
        //$query7=mysql_query($string7);
        if (!mysql_query($string7)) echo 'Erreur SQL '.mysql_error().': '.$string7;
		else $message="Emprunt effectué avec succès.";
		return $message;
}




function afficherformmodif(){
    ?>




    <div id="formulaire" class="formulaire" style="height:470px;">
	<h3>Modifier son compte</h3><hr size="2" style="margin-bottom:20px; margin-top:0px; padding:0px; size:1px; height:1px; border-top:none; border-width:1px; border-color:#FFFFFF"/>
    <form action="" method="post">
    <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0">
    <tr>
    <td width="250" colspan="3">Trigramme souhaité</td>
    <td width=""><input type="text" name="trigramme2" value="<?php if(isset($_POST["trigramme2"])){ echo $_POST["trigramme2"];} else {echo 'exemple: DHC';}?>" onFocus="this.value=verify(this,'exemple: DHC');" onblur="this.value=verify(this,'exemple: DHC');" /></td>
    </tr>
    <tr>
    <td colspan="3">Nouveau mot de passe</td>
    <td><input type="password" name="password" /></td>
    </tr>
    <tr>
    <td colspan="3">Confirmer le mot de passe</td>
    <td><input type="password" name="password2" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td>Nom</td>
    <td><input type="text" name="nom" value="<?php if(isset($_POST["nom"])){ echo $_POST["nom"];} ?>" /></td>
    <td>Prénom</td>
    <td><input type="text" name="prenom" value="<?php if(isset($_POST["prenom"])){ echo $_POST["prenom"];} ?>" /></td>
    </tr>
    <tr>
    <td>Casert</td>
    <td><input type="text" name="kazert" value="<?php if(isset($_POST["kzert"])){ echo $_POST["kzert"];} else{ echo 'exemple: 691009';} ?>" onFocus="this.value=verify(this,'exemple: 691009');" onblur="this.value=verify(this,'exemple: 691009');" /></td>
    <td>Téléphone</td>
    <td><input type="text" name="telephone" value="<?php if(isset($_POST["tel"])){ echo $_POST["tel"];} else{ echo 'exemple: 6419';}?>" onFocus="this.value=verify(this,'exemple: 6419');" onblur="this.value=verify(this,'exemple: 6419');" /></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td>e-mail</td>
    <td colspan="3" style="font-weight:normal; text-align:left">
    <input type="text" name="email" style="width:240px;" value="<?php if(isset($_POST["mail"])){ echo $_POST["mail"];} else {echo "exemple: pierre.dupont";}?>" onFocus="this.value=verify(this,'exemple: pierre.dupont');" onblur="this.value=verify(this,'exemple: pierre.dupont');" />
    <select name="ecole" style="margin-right:3px; width:150px;">
    	<option value="polytechnique.edu">@polytechnique.edu</option>
        <option value="institutoptique.fr">@institutoptique.fr</option>
    </select></td>
    </tr>

    <tr><td height="20" colspan="3"></td><td></td></tr>

    <tr>
    <td colspan="2">Catégorie préférée</td>
    <td colspan="2">
    <select name="categorie" style="margin-right:3px; width:230px">
         <option value="">-</option>
         <option value="classique">Classique</option>
         <option value="opera">Op&eacute;ra</option>
         <option value="interprete">Interprète</option>
         <option value="jazz">Jazz</option>
         <option value="varietes">Vari&eacute;t&eacute;s</option>
         <option value="film">Musique de film</option>
         <option value="compil">Compilations</option>
         <option value="anc">Musique ancienne + Liturgies</option>
         <option value="tradi">Musiques traditionnelles</option>
         <option value="electro">Electromusique</option>
         <option value="mili">Musique militaire</option>
         <option value="part">Partitions</option>
    </select>
    </td>
    </tr>
    <tr>
    <td colspan="4">Recevoir la newsletter de cette catégorie :
    <input checked="true" name="statut" value="oui" type="radio" style="width:20px; border:none" />oui
    <input name="news" value="non" type="radio"  style="width:20px; border:none" />non
    <input type="hidden" name="action" value="inscription" /></td>
    </tr>

    <?php
    if($_SESSION['loggedIn']==2){
    ?>

    <tr>
    <td colspan="3">Cotisation</td>
    <td><input type="text" name="cotisation" /></td>
    </tr>
    <tr>
    <td colspan="3">Caution</td>
    <td><input type="text" name="caution" /></td>
    </tr>

    <?php
    }
    ?>

    <tr><td height="20" colspan="3"></td><td></td></tr>

	</table>

	<div align="right">
            <input type="reset" value="Annuler" style="margin-top:20px; margin-bottom:20px; margin-right:10px; width:auto"/>
            <input type="submit" value="Modifier" style="margin-top:20px; margin-bottom:20px; margin-right:10px;"/></div>
    </form>
    </div>

<?php
}


function modifier($trigramme){
    
    $a=array("password","password2","trigramme2","nom","prenom","kazert","telephone",
        "email","categorie","statut","cotisation","caution");

    if(isset($_POST[$a[0]]) && isset($_POST[$a[1]]) && $_POST[$a[0]]!="" && $_POST[$a[0]]==$_POST[$a[1]]){
        //$trigramme=$_SESSION['trigramme'];
        $pass=$_POST[$a[1]];
        $query="UPDATE `clients` SET `password`='$pass' WHERE `trigramme`='$trigramme'";
        if (!mysql_query($query)) echo 'Erreur SQL '.mysql_error().': '.$query;
    }

    if(isset($_POST[$a[2]]) && $_POST[$a[2]]!=""){
        if($_POST[$a[2]]!="exemple: DHC"){
            $trlen=strlen($_POST[$a[2]]);
            if($trlen!=3){
                echo "un trigramme contient 3 lettres!!!<br/>";
            }
            else{
                $trigramme=$_POST[$a[2]];
                $sql2 =mysql_query("SELECT * FROM `clients` WHERE `trigramme`='$trigramme'");
                $res=mysql_numrows($sql2);
                if($res>0){
                    echo "trigramme deja utilise";
                }
                else{
                    $newtri=$_POST[$a[2]];
                    $query="UPDATE `clients` SET `trigramme`='$newtri' WHERE `trigramme`='$trigramme'";
                    if (!mysql_query($query)) echo 'Erreur SQL '.mysql_error().': '.$query;
                }


            }
        }

    }

    for($i=3;$i<12;$i++){
        
        if(isset($_POST[$a[$i]]) && $_POST[$a[$i]]!=""){
            $trigramme=$_SESSION['trigramme'];
            $cle=$a[$i];
            $val=$_POST[$cle];

            if($cle=="kazert"){
                if($val!="exemple: 691009"){
                    if(!is_numeric($val) || (int)$val!=$val ){
                        echo "le champ kzert doit contenir un entier";
                    }
                    else{
                        $query="UPDATE `clients` SET `$cle`='$val' WHERE `trigramme`='$trigramme'";
                        if (!mysql_query($query)) echo 'Erreur SQL '.mysql_error().': '.$query;
                    }
                }
                
                
            }
            elseif($cle=="telephone" ){
                if($val!="exemple: 6419"){
                    if(!is_numeric($val) || (int)$val!=$val){
                        echo "le champ telephone doit contenir un entier";
                    }
                    else{
                        $query="UPDATE `clients` SET `$cle`='$val' WHERE `trigramme`='$trigramme'";
                        if (!mysql_query($query)) echo 'Erreur SQL '.mysql_error().': '.$query;
                    }
                }
               
            }
            else{
                $query="UPDATE `clients` SET `$cle`='$val' WHERE `trigramme`='$trigramme'";
                if (!mysql_query($query)) echo 'Erreur SQL '.mysql_error().': '.$query;
            }
            
        }
    }


    
}






?>