<?php
function connect(){
mysql_connect("localhost", "root", "2uh5ZpjB7CsceR3w") or die("Erreur de connexion à MySQL");       // Connexion à MySQL avec username "root" et mot de passe ""
mysql_select_db("dhc") or die("Erreur de connexion à la base de données");     // Sélection de la base de donnée
mysql_query("SET NAMES UTF8");
}
?>