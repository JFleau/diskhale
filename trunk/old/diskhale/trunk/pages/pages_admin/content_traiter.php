<?php


printTraiterClientForm($askedPage);


    if(isset($_POST['trigramme']) && $_POST['trigramme']!=""){
        $tr=$_POST['trigramme'];
        connect();
        $query="SELECT * FROM `emprunts` WHERE `trigramme`= '$tr' AND `daterendu`='0000-00-00'";
        $squery=mysql_query($query);
        if (!$squery) echo 'Erreur SQL '.mysql_error().': '.$squery;
        while ($tab = mysql_fetch_assoc($squery)) {
            foreach ($tab as $cle=>$val) {
                if($cle=='codelettres'){
                    $query2="SELECT * FROM `compositeurs` WHERE `codelettres`='$val'";
                    $squery2=mysql_query($query2);
                    while ($tab2 = mysql_fetch_assoc($squery2)) {
                        foreach ($tab2 as $cle2=>$val2) {
                            if($cle2=='nom'){
                                echo "compositeur => ".$val2.'<br />';
                            }
                        }
                    }
                }
                elseif($cle=='dateemprunt'){
                    echo "date".' => '.$val.'<br />';
                }
                elseif($cle=='daterendu'){
                    
                }
                else{
                   echo $cle.' => '.$val.'<br />';
                }
                

            }
            echo '<br />';

        }

    
    mysql_close();
    }








?>

