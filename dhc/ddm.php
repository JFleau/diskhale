<?php

///////////////////////////////////////////////////////////////////////
// FORMULAIRE DE CRÉATION DE ddm ACCESSIBLE AU SEULS ADMINISTRATEURS //
///////////////////////////////////////////////////////////////////////

$test = isset($_POST["code"]) && $_POST["code"] != null && isset($_POST["numero"]) && $_POST["numero"] != null && isset($_POST["texte"]) && $_POST["texte"] != null ;

if($test){
mysql_connect("localhost", "root", "2uh5ZpjB7CsceR3w") or die("Erreur de connexion � MySQL");
mysql_select_db("dhc") or die("Erreur de connexion � la base de donn�es");
mysql_query("SET NAMES UTF8");

    $query="INSERT INTO `ddm` (`Code disque`, `Numero`, `Contenu`) VALUES ('".$_POST["code"]."', '".$_POST["numero"]."', '".nl2br($_POST["texte"])."')";
    if (!mysql_query($query)){
        echo 'Erreur SQL'.mysql_error().': '.$query;
    } else{
        mysql_query($query);
    }
} else{
    echo<<< END
        <div id="formulaire" class="formulaire" style="height:450px; width:920px; float:auto; margin:0px; padding:20px;">
        <h3>Nouveau disque du mois !</h3>
            <form method="post" action="index.php?page=accueil">
                <table border="0" style="text-align:right; vertical-align:middle" cellpadding="0">
                    <tr>
                        <td>
                            Code du disque (Compositeur, numéro) :
                            <input type="text" name="code" value="">
                            <input type="int" name="numero" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <TEXTAREA NAME = "texte" COLS = 80 ROWS = 13 style="width: 584" OnChange="tstS(this)"></TEXTAREA>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Publier">
                        </td>
                    </tr>
                    <p>
                </table>
            </form>
        </div>
END;
}

?>
