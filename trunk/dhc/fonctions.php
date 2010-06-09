<?php

function authorized($page) {
if ($page=="accueil"||$page=="inscription"||$page=="recherche") $authorized=true; else $authorized=false;
return $authorized;
}

?>