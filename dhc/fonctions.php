<?php

function authorized($page) {
if ($_SESSION['loggedIn']==0) {
	if ($page=="accueil"||$page=="inscription"||$page=="recherche") $authorized=true; else $authorized=false;
	}
if ($_SESSION['loggedIn']==1) {
	if ($page=="accueil"||$page=="madiskhale"||$page=="recherche") $authorized=true; else $authorized=false;
	}
if ($_SESSION['loggedIn']==2) {
	if ($page=="accueil"||$page=="administration"||$page=="recherche") $authorized=true; else $authorized=false;
	}

return $authorized;
}

function connect(){
mysql_connect("localhost", "root", "2uh5ZpjB7CsceR3w") or die("Erreur de connexion à MySQL");
mysql_select_db("dhc") or die("Erreur de connexion à la base de données");
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
		if ($trigramme=="dhc") $_SESSION['loggedIn']=2; else $_SESSION['loggedIn']=1;
		$array=mysql_fetch_assoc($result);
		$_SESSION['bienvenue']="Bienvenue, <b>".$array['prenom']."</b> !";
	}
}

function logOut() {
	$_SESSION['loggedIn']=0;
	$_SESSION['bienvenue']="0";
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
	?>	