<?php


$search= array(1 => "categorie", 2 => "codelettres",3 => "numero",4 => "compositeurs",5 => "oeuvres",6 =>"interpretes");

$string="";
$h=' disques';
$k=0;
$l=0;

printSearchForm($askedPage);

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
        $l=$l+1;


    }
}

    if($l>0){

        connect();
        $query="SELECT * FROM disques" .$string;
        $squery=mysql_query($query);
        if (!$squery) echo 'Erreur SQL '.mysql_error().': '.$squery;
        while ($tab = mysql_fetch_assoc($squery)) {
            foreach ($tab as $cle=>$val) {
                echo $cle.' => '.$val.'<br />';
                if($cle=="codelettres"){
                    $code=$val;
                }
                if($cle=="numero"){
                    $num=$val;
                }

            }
            $string2='codelettres = '.'\''.$code.'\''.' AND numero = '.'\''.$num.'\'';
            $query2="SELECT * FROM emprunts WHERE ".$string2;
            $sl=mysql_query($query2);
            //echo $query2;
            $tab2 = mysql_fetch_assoc($sl);
            //print_r($tab2);
            if($tab2!=""){
                foreach ($tab2 as $cle2=>$val2) {
                    if($cle2=="trigramme"){

                        if($_SESSION["loggedIn"]==2){
                        echo "emprunte par".' => <a href="index.php?page=traiter_client"/>'.
                        $val2.'</a><br />'.'<br />';

                       
                        ?>


                        <form action="index.php?" method="post">
                            <p><input type="hidden" name="trigramme" value="<?php echo $cle2;?>" ></p>
                        </form>

                        <?php
                        }
                        else{
                            echo "emprunte par".' => '.
                        $val2.'<br />'.'<br />';
                        }
                    }
                }
            }
            else{
                echo "non emprunte ".'<br />'.'<br />';
            }
       
        
        

        }
    mysql_close();
    }








?>

<!--<a href="index.php?page=";
   "\">";
   "</a>
-->