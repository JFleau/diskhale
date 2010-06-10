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
	?>