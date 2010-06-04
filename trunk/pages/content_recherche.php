<?php


$search= array(1 => "categorie", 2 => "codelettres",3 => "numero",4 => "compositeurs",5 => "oeuvres",6 =>"interpretes");

$string="";
$h=' disques';
$k=0;

//printSearchForm();

for($i=1;$i<=6;$i++){
    if(isset($_POST[$search[$i]]) && $_POST[$search[$i]]!=""){
        $tr=$_POST[$search[$i]];
        $tv=$search[$i];
        if($k==0){
            $string=$string. ' WHERE '.$tv.' LIKE '.'\''.$tr.'\'';
        }
        else{
            $string=$string.' AND '.$tv.' LIKE '.'\''.$tr.'\'';
        }


    }
echo $string;

connect();
$query="SELECT * FROM disques" .$string;
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
