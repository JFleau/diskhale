<?php
//require('utils.php');
if(isset($_GET["prenom"]) && $_GET["prenom"] != null && isset($_GET["genre"])){
        generateHTMLHeader('Formulaire','css');
    ?>
    <p>Formulaire soumis.</p>
    <p>
    <?php
        echo "Bonjour, " . ($_GET["genre"] == "f" ? "Mlle " : "M. ") . $_GET["prenom"] . " !";
    ?>
    </p>
    <?php generateHTMLFooter();
} else{
    generateHTMLHeader('Formulaire', 'css');
    ?>
    

    <form action="Inscription.php" method=post>

    <table align="center" border="0">
    <tr>
      <td>Trigramme
      <td><input type=text name="trigramme" size=6 maxlength=6 value=""><br>
    </tr>
    <tr>
      <td>Mot de passe
      <td><input type=password name="mdp1" size=3 maxlength=3 value=""><br>
    </tr>

    </table>

    </form>

<?php
generateHTMLFooter();
}
?>