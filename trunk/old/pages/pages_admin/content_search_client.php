<?php


$search= array(1 => "categorie", 2 => "nom",3 => "prenom",4 => "trigramme",
    5 => "newsletter",6 =>"cotisation",7 => "caution");

$string="";
$h=' disques';
$k=0;
$l=0;

printSearchClientForm($askedPage);

for($i=1;$i<=7;$i++){
    if(isset($_POST[$search[$i]]) && $_POST[$search[$i]]!=""){
        $tr=$_POST[$search[$i]];
        $tv=$search[$i];
        if($k==0){
            $string=$string. ' WHERE '.$tv.' LIKE '.'\''.$tr.'\'';
        }
        else{
            $string=$string.' AND '.$tv.' LIKE '.'\''.$tr.'\'';
        }
        $l=$l+1;


    }
}

    if($l>0){

        connect();
        $query="SELECT * FROM clients" .$string;
        $squery=mysql_query($query);
        if (!$squery) echo 'Erreur SQL '.mysql_error().': '.$squery;
//        $res=mysql_numrows($squery);
//        echo $res;
        while ($tab = mysql_fetch_assoc($squery)) {
            foreach ($tab as $cle=>$val) {
                echo $cle.' => '.$val.'<br />';
//                if($cle=="codelettres"){
//                    $code=$val;
//                }
//                if($cle=="numero"){
//                    $num=$val;
//                }

            }
            echo "<br />";
//            $string2='codelettres = '.'\''.$code.'\''.' AND numero = '.'\''.$num.'\'';
//            $query2="SELECT * FROM emprunts WHERE ".$string2;
//            $sl=mysql_query($query2);
//            //echo $query2;
//            $tab2 = mysql_fetch_assoc($sl);
//            //print_r($tab2);
//            if($tab2!=""){
//                foreach ($tab2 as $cle2=>$val2) {
//                    if($cle2=="trigramme"){
//                        echo "emprunte par".' => '.$val2.'<br />'.'<br />';
//
//
//
//                    }
//                }
//            }
//            else{
//                echo "non emprunte ".'<br />'.'<br />';
//            }




        }
    mysql_close();
    }








?>

