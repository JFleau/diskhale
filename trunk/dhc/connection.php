<?php
  $mysql_host="localhost";
  $mysql_bdd="dhc";
  $mysql_link = mysql_connect($mysql_host,$mysql_user,$mysql_pswd) ;
  if (!$mysql_link) die('') ;
  mysql_select_db($mysql_bdd) or die('') ;
?>