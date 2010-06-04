<?php


$search= array(1 => "categorie", 2 => "code",3 => "numero",4 => "artiste",5 => "oeuvre",6 =>"interprete");
$string="";
$h=' clients';
$k=0;

for($i=1;$i<=6;$i++){
    if(isset($_POST["$search[$i]"]) && $_POST["$search[$i]"]!=""){
        if($k==0){
            $string=$string. ' WHERE '.`$search[$i]`.' LIKE '.'$_POST["$search[$i]"]';
        }
        else{
            $string=$string.' AND '.`$search[$i]`.' LIKE '.'$_POST["$search[$i]"]';
        }


    }


connect();
$query="SELECT * FROM clients" .$string;
$squery=mysql_query($query);
if (!$squery) echo 'Erreur SQL '.mysql_error().': '.$squery;
while ($tab = mysql_fetch_assoc($squery)) {
   foreach ($tab as $cle=>$val) {
       echo $cle.' => '.$val.'<br />';
   }


}
mysql_close();

}

?>

