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
      <td>Nom
      <td><input type=text name="nom" size=3 maxlength=3 value=""><br>
    </tr>
    <tr>
      <td>Prénom
      <td><input type=text name="prenom" size=3 maxlength=3 value=""><br>
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
      <td><input type=text name="numero" size=3 maxlength=3 value=""><br>
    </tr>
    <tr>
      <td>Kazert :
      <td><input type=text name="numero" size=3 maxlength=3 value=""><br>
    </tr>
    <tr>
      <td>Téléphone
      <td><input type=text name="numero" size=3 maxlength=3 value=""><br>
    </tr>
    <tr>
      <td>Catégorie préférée :
      <td><select name="categorie">
        <option value="">-<option value="classique">Classique<option value="opera">Opéra<option value="interprete">Interprète<option value="jazz">Jazz<option value="varietes">Variétés<option value="film">Musique de film<option value="compil">Compilations<option value="anc">Musique ancienne + Liturgies<option value="tradi">Musiques traditionnelles<option value="electro">Electromusique<option value="mili">Musique militaire<option value="part">Partitions        </select><br>
    </tr>
    <tr>
        <td>Je souhaite recevoir la newsletter de cette catégorie
        <input checked="true" name="news" value="oui" type="radio" />oui
        <input name="news" value="non" type="radio" />non
    </tr>
    </table>

    </form>

<?php
generateHTMLFooter();
}
?>