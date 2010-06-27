    <img src="images/img_accueil.jpg" id="formulaire" class="formulaire" style="float:right"/>

<div id="infos" style="">
    <h3 style="color:#009933">LA DISKHALE</h3>
    <p>La <b>Diskh&acirc;le Classique</b>, c'est une CDth&egrave;que de plus de 3000 CDs de musique classique, de Jazz, de Vari&eacute;t&eacute;.
    Le binet poss&egrave;de m&ecirc;me des vinyls. Il y en a pour tous les go&ucirc;ts. Vous pouvez venir &eacute;couter vos disques
    pr&eacute;f&eacute;r&eacute;s au local gr&acirc;ce au mat&eacute;riel audio du binet.</p>
    <p>Pour d'autres informations vous pouvez lire
    <a href="http://frankiz.polytechnique.fr/eleves/binets/wikix/Diskhale_classique"
       style="color: inherit ! important;text-decoration: inherit; "><b>l'article
wikix de la Diskh&acirc;le</b>.</a></p>

    <h3 style="color:#009933">LES PERMANENCES</h3>
    <p>La <b>Diskh&acirc;le</b> est ouverte tous les midis entre 12h30 et 13h20.</p>
    <div style="text-align: center;">
        <table style="margin-left:30px">
        <tr>
            <td width="150">Lundi</td>
            <td>Beno&icirc;t SCHMAUCH</td>
        </tr>
        <tr>
            <td>Mardi</td>
            <td>Jean-Beno&icirc;t SAINT-PIERRE</td>
        </tr>
        <tr>
            <td>Mercredi</td>
            <td>Thomas CHARTIER</td>
        </tr>
        <tr>
            <td>Jeudi</td>
            <td>Pierre BELLEC</td>
        </tr>
        <tr>
            <td>Vendredi</td>
            <td>Jean-L&eacute;opold VI&Eacute;</td>
        </tr>
        </table>
    </div>
        <h3 style="color:#009933; padding-top:20px">LE DISQUE DU MOIS</h3>

    <?php
function affiche_ddm($code,$numero){
    $query="SELECT * FROM `ddm` WHERE `Code disque` LIKE '".$code."' AND `numero` ='".$numero."'";
    $result=mysql_query($query) or die(mysql_error());
	$array=mysql_fetch_assoc($result);
    mysql_num_rows($result);
    if(mysql_num_rows($result) == 0){
        echo 'Aucun article pour ce disque';
    } else{
        $query2="SELECT compositeurs, oeuvres, interpretes FROM `dhc`.`disques` WHERE `codelettres` LIKE '".$code."' AND `numero` =".$numero." LIMIT 0 , 30";
        $result2=mysql_query($query2);
        $res=mysql_fetch_array($result2);
		$texte=$array['Contenu'];
        echo '<div>';
        echo '<h2 style="text-align:center">'.$res["compositeurs"].', '.$res["oeuvres"].', '.$res["interpretes"].'</h2>';
        echo '<p style="margin-right:20px; margin-left:20px">'.$texte.'</p>';
    }
}

affiche_ddm("tch","16");

    ?>


</div>