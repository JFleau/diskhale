<?php


function printLoginForm($askedPage){
generateHTMLHeader('Connexion','gabarit.css');



?>




    <body>

        <div id="entete">Bienvenue sur le site de la Diskh&acirc;le Classique</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <form action="index.php?action=login" method="post">
                    <table align="center" border="0">
                        <tr>
                        <td>Trigramme
                        <td><input type=text name="trigramme" size=10 maxlength=10 value="<?php if(isset($_POST["trigramme"])) echo $_POST["trigramme"];?>"><br>
                        </tr>
                        <tr>
                        <td>Mot de passe
                        <td><input type=password name="mdp1" size=10 maxlength=10 value=""><br>
                        </tr>
                        <tr>
                        <td><input type="submit" value="Valider" ><br>
                        </tr>
                        <tr>
                        <td><input type="hidden" name="askedPage" value="<?php echo $_SESSION['currentPage'];?>" ><br>
                        </tr>

                    </table>
                    </form>
                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $logInOut=$_SESSION['loggedIn'];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail à dhc@binets.polytechnique.fr ou appeler le 2630</div>

        </div>

                
        

    </body>

</html>

<?php
        
}


?>

<?php
function printLogOutForm(){
generateHTMLHeader('D&eacute;connexion','gabarit.css');
?>

    <body>
	<form action="index.php?action=logout<?php if($askedPage!=""){echo "?page=$askedPage";}?> " method="post">

	<p><input type="submit" value="D&eacute;connecter" /></p>
        <p><input type="hidden" name="askedPage" value="<?php echo $_SESSION['currentPage'];?>" ></p>
	</form>
    </body>

</html>
<?php
}
?>

<?php
function printAdminForm($askedPage){
generateHTMLHeader('Admministrateur','gabarit.css');
?>

    <body>

        <div id="entete">Bienvenue sur le site de la Diskh&acirc;le Classique</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <form action="index.php?action=logadmin" method="post">
                    <table align="center" border="0">
                        <tr>
                        <td>Trigramme
                        <td><input type=text name="trigramme" size=10 maxlength=10 value="<?php if(isset($_POST["trigramme"])) echo $_POST["trigramme"];?>"><br>
                        </tr>
                        <tr>
                        <td>Mot de passe
                        <td><input type=password name="mdp1" size=10 maxlength=10 value=""><br>
                        </tr>
                        <tr>
                        <td><input type="submit" value="Valider" ><br>
                        </tr>
                        <tr>
                        <td><input type="hidden" name="askedPage" value="<?php echo $_SESSION['currentPage'];?>" ><br>
                        </tr>
                    </table>
                    </form>
                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $logInOut=$_SESSION['loggedIn'];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail à dhc@binets.polytechnique.fr ou appeler le 2630</div>

        </div>




    </body>
</html>
<?php
}
?>

<?php

function printRegisterForm($askedPage){
    generateHTMLHeader('Inscription','gabarit.css');
?>


<body>

        <div id="entete">Bienvenue sur le site de la Diskh&acirc;le Classique</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <form action="" method=post>
                    <table align="center" border="0">
                        <tr>
                        <td>Trigramme
                        <td><input type=text name="trigramme" size=6 maxlength=6 value="<?php if(isset($_POST["trigramme"])) echo $_POST["trigramme"];?>"><br>
                        </tr>
                        <tr>
                        <td>Nom
                        <td><input type=text name="nom" size=3 maxlength=3 value="<?php if(isset($_POST["nom"])) echo $_POST["nom"];?>"><br>
                        </tr>
                        <tr>
                        <td>Pr&eacute;nom
                        <td><input type=text name="prenom" size=3 maxlength=3 value="<?php if(isset($_POST["prenom"])) echo $_POST["prenom"];?>"><br>
                        </tr>
                        <tr>
                        <td>Mot de passe
                        <td><input type=password name="mdp1" size=3 maxlength=3 value=""><br>
                        </tr>
                        <tr>
                        <td>Confirmer le mot de passe
                        <td><input type=password name="mdp2" size=3 maxlength=3 value=""><br>
                        </tr>
                        <tr>
                        <td>E-mail :
                        <td><input type=text name="email" size=3 maxlength=3 value="<?php if(isset($_POST["email"])) echo $_POST["email"];?>"><br>
                        </tr>
                        <tr>
                        <td>Kazert :
                        <td><input type=text name="kzert" size=3 maxlength=3 value="<?php if(isset($_POST["kzert"])) echo $_POST["kzert"];?>"><br>
                        </tr>
                        <tr>
                        <td>T&eacute;l&eacute;phone
                        <td><input type=text name="numero" size=3 maxlength=3 value="<?php if(isset($_POST["numero"])) echo $_POST["numero"];?>"><br>
                        </tr>
                        <tr>
                        <td>Cat&eacute;gorie pr&eacute;f&eacute;r&eacute;e :
                        <td><select name="categorie">
                        <option value="">-<option value="classique">Classique<option value="opera">Op&eacute;ra<option value="interprete">Interprète<option value="jazz">Jazz<option value="varietes">Vari&eacute;t&eacute;s<option value="film">Musique de film<option value="compil">Compilations<option value="anc">Musique ancienne + Liturgies<option value="tradi">Musiques traditionnelles<option value="electro">Electromusique<option value="mili">Musique militaire<option value="part">Partitions        </select><br>
                        </tr>
                        <tr>
                        <td>Je souhaite recevoir la newsletter de cette cat&eacute;gorie
                        <input checked="true" name="news" value="oui" type="radio" />oui
                        <input name="news" value="non" type="radio" />non
                        </tr>
                        <tr>
                        <td><input type="submit" value="Valider" ><br>
                        </tr>
                        <tr>
                        <td><input type="hidden" name="askedPage" value="<?php echo $_SESSION['currentPage'];?>" ><br>
                        </tr>
                    </table>

                    </form>

                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $logInOut=$_SESSION['loggedIn'];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail à dhc@binets.polytechnique.fr ou appeler le 2630</div>

        </div>




    </body>

</html>

<?php

}


?>


<?php
function changepassword($askedPage){
    generateHTMLHeader('Modification','gabarit.css');
?>


    <body>

        <div id="entete">Modification du Compte</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <form action="" method="post">
                    <table align="center" border="0">
                        <tr>
                        <td>Trigramme
                        <td><input type=text name="trigramme" size=6 maxlength=6 value="<?php if(isset($_POST["trigramme"])) echo $_POST["trigramme"];?>"><br>
                        </tr>
                        <tr>
                        <td>Mot de passe
                        <td><input type=password name="old_password" size=3 maxlength=3 value=""><br>
                        </tr>
                        <tr>
                        <td>Nouveau Mot de passe
                        <td><input type=password name="new_password" size=3 maxlength=3 value=""><br>
                        </tr>
                        <tr>
                        <td>Confirmer Nouveau Mot de passe
                        <td><input type=password name="new_password2" size=3 maxlength=3 value=""><br>
                        </tr>
                        <tr>
                        <td>Nom
                        <td><input type=text name="nom" size=3 maxlength=3 value="<?php if(isset($_POST["nom"])) echo $_POST["nom"];?>"><br>
                        </tr>
                        <tr>
                        <td>Pr&eacute;nom
                        <td><input type=text name="prenom" size=3 maxlength=3 value="<?php if(isset($_POST["prenom"])) echo $_POST["prenom"];?>"><br>
                        </tr>
                        <tr>
                        <td>E-mail :
                        <td><input type=text name="email" size=3 maxlength=3 value="<?php if(isset($_POST["email"])) echo $_POST["email"];?>"><br>
                        </tr>
                        <tr>
                        <td>Kazert :
                        <td><input type=text name="kzert" size=3 maxlength=3 value="<?php if(isset($_POST["kzert"])) echo $_POST["kzert"];?>"><br>
                        </tr>
                        <tr>
                        <td>T&eacute;l&eacute;phone
                        <td><input type=text name="numero" size=3 maxlength=3 value="<?php if(isset($_POST["numero"])) echo $_POST["numero"];?>"><br>
                        </tr>
                        <tr>
                        <td>Cat&eacute;gorie pr&eacute;f&eacute;r&eacute;e :
                        <td><select name="categorie">
                        <option value="">-<option value="classique">Classique<option value="opera">Op&eacute;ra<option value="interprete">Interprète<option value="jazz">Jazz<option value="varietes">Vari&eacute;t&eacute;s<option value="film">Musique de film<option value="compil">Compilations<option value="anc">Musique ancienne + Liturgies<option value="tradi">Musiques traditionnelles<option value="electro">Electromusique<option value="mili">Musique militaire<option value="part">Partitions        </select><br>
                        </tr>
                        <tr>
                        <td>Je souhaite recevoir la newsletter de cette cat&eacute;gorie
                        <input checked="true" name="news" value="oui" type="radio" />oui
                        <input name="news" value="non" type="radio" />non
                        </tr>
                        <tr>
                        <td><input type="submit" value="Valider" ><br>
                        </tr>
                        <tr>
                        <td><input type="hidden" name="askedPage" value="<?php echo $_SESSION['currentPage'];?>" ><br>
                        </tr>
                    </table>
                    </form>
                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $logInOut=$_SESSION['loggedIn'];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail &agrave; dhc@binets.polytechnique.fr ou appeler le 2630</div>
        </div>




    </body>

</html>

<?php
}
?>


<?php
function printDeleteForm($askedPage){
    generateHTMLHeader('Suppression','gabarit.css');
    ?>

<body>

        <div id="entete">Bienvenue sur le site de la Diskh&acirc;le Classique</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <form action="index.php?action=logout" method="post">
                    <table align="center" border="0">
                        <tr>
                        <td>Trigramme
                        <td><input type=text name="login" size=6 maxlength=6 value="<?php if(isset($_POST["login"])) echo $_POST["login"];?>"><br>
                        </tr>
                        <tr>
                        <td>Mot de passe
                        <td><input type=password name="password" size=3 maxlength=3 value=""><br>
                        </tr>
                        <tr>
                        <td><input type="submit" value="Valider" ><br>
                        </tr>
                        <tr>
                        <td><input type="hidden" name="askedPage" value="<?php echo $_SESSION['currentPage'];?>" ><br>
                        </tr>
                    </table>
                    </form>
                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $logInOut=$_SESSION['loggedIn'];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail à dhc@binets.polytechnique.fr ou appeler le 2630</div>

        </div>




    </body>

</html>

<?php
}
?>

<?php
function printSearchForm($askedPage){

?>
<div id="entete">Bienvenue sur le site de la Diskh&acirc;le Classique</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <form action="" method="post">
                    <table align="center" border="0">
                        <tr>
                        <td>Cat&eacute;gorie
                        <td><select name="categorie">
                        <option value="">-<option value="classique">Classique<option value="opera">Op&eacute;ra<option value="interprete">Interprète<option value="jazz">Jazz<option value="varietes">Vari&eacute;t&eacute;s<option value="film">Musique de film<option value="compil">Compilations<option value="anc">Musique ancienne + Liturgies<option value="tradi">Musiques traditionnelles<option value="electro">Electromusique<option value="mili">Musique militaire<option value="part">Partitions        </select><br>
                        </tr>
                        <tr>
                        <td>Code Lettres
                        <td><input type=text name="codelettres" size=3 maxlength=3 value="<?php if(isset($_POST["codelettres"])) echo $_POST["codelettres"];?>"><br>
                        </tr>
                        <tr>
                        <td>Num&eacute;ro
                        <td><input type=text name="numero" size=3 maxlength=3 value="<?php if(isset($_POST["numero"])) echo $_POST["numero"];?>"><br>
                        </tr>
                        <tr>
                        <td>Artiste/Compositeur
                        <td><input type=text name="compositeurs" size=10 maxlength=10 value="<?php if(isset($_POST["artiste"])) echo $_POST["artiste"];?>"><br>
                        </tr>
                        <tr>
                        <td>Oeuvre
                        <td><input type=text name="oeuvres" size=10 maxlength=10 value="<?php if(isset($_POST["oeuvre"])) echo $_POST["oeuvre"];?>"><br>
                        </tr>
                        <tr>
                        <td>Interpr&egrave;te
                        <td><input type=text name="interpretes" size=10 maxlength=10 value="<?php if(isset($_POST["interprete"])) echo $_POST["interprete"];?>"><br>
                        </tr>
                        <tr>
                        <td><input type="submit" value="Valider" ><br>
                        </tr>
                    </table>
                    </form>
                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $_SESSION['currentPage']='recherche';
                    $logInOut=$_SESSION['loggedIn'];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail à dhc@binets.polytechnique.fr ou appeler le 2630</div>

        </div>





<?php
}
?>

<?php
function printSearchClientForm($askedPage){
connect();
$string = "SELECT * FROM `categories`";
$query=mysql_query($string);
?>
<div id="entete">Bienvenue sur le site de la Diskh&acirc;le Classique</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <form action="" method="post">
                    <table align="center" border="0">
                        <tr>
                        <td>Cat&eacute;gorie
                        <td><select name="categorie">
                        <option value="">-
                        <?php
                        while ($tab = mysql_fetch_assoc($query)) {
                            foreach ($tab as $cle=>$val) {
                            echo "<option value=\"".$val."\">".$val;
                            }
                        }
                        ?>

                        </select><br>
                        </tr>
                        <tr>
                        <td>Trigramme
                        <td><input type=text name="trigramme" size=10 maxlength=10 value="<?php if(isset($_POST["trigramme"])) echo $_POST["trigramme"];?>"><br>
                        </tr>
                        <tr>
                        <td>Pr&eacute;nom
                        <td><input type=text name="prenom" size=10 maxlength=10 value="<?php if(isset($_POST["prenom"])) echo $_POST["prenom"];?>"><br>
                        </tr>
                        <tr>
                        <td>Nom
                        <td><input type=text name="nom" size=10 maxlength=10 value="<?php if(isset($_POST["nom"])) echo $_POST["nom"];?>"><br>
                        </tr>
                        <tr>
                        <td>Newsletter
                        <td><input type=text name="newsletter" size=10 maxlength=10 value="<?php if(isset($_POST["newsletter"])) echo $_POST["newsletter"];?>"><br>
                        </tr>
                        <tr>
                        <td>Caution
                        <td><input type=text name="caution" size=10 maxlength=10 value="<?php if(isset($_POST["caution"])) echo $_POST["caution"];?>"><br>
                        </tr>
                        <tr>
                        <td>Cotisation
                        <td><input type=text name="cotisation" size=10 maxlength=10 value="<?php if(isset($_POST["cotisation"])) echo $_POST["cotisation"];?>"><br>
                        </tr>
                        <tr>
                        <td><input type="submit" value="Valider" ><br>
                        </tr>
                    </table>
                    </form>
                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $_SESSION['currentPage']='chercher_client';
                    $logInOut=$_SESSION['loggedIn'];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail à dhc@binets.polytechnique.fr ou appeler le 2630</div>

            

        </div>





<?php
}
?>

<?php
function printTraiterClientForm($askedPage){

?>
<div id="entete">Bienvenue sur le site de la Diskh&acirc;le Classique</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <form action="" method="post">
                    <table align="center" border="0">
                        <tr>
                        <td>Trigramme
                        <td><input type=text name="trigramme" size=10 maxlength=10 value="<?php if(isset($_POST["trigramme"])) echo $_POST["trigramme"];?>"><br>
                        </tr>
                        <tr>
                        <td><input type="submit" value="Valider" ><br>
                        </tr>
                    </table>
                    </form>
                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $_SESSION['currentPage']='traiter';
                    $logInOut=$_SESSION['loggedIn'];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail à dhc@binets.polytechnique.fr ou appeler le 2630</div>



        </div>





<?php
}
?>
