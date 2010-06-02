

        <div id="entete">Contact</div>
	<div id="centre">
            <div id="centre-bis">

                <div id="secondaire">
                    <p>Liens externes</p>
                </div>
                <div id="principal">
                    <p>Actualit&ecirc;</p>
                    <p>Disque du mois</p>
                </div>
                <div id="navigation">
                    Menu
                    <?php
                    $logInOut=$_SESSION["loggedIn"];
                    generateMenu($askedPage,$logInOut);
                    ?>
                </div>


            </div>

            <div id="pied">Contact : envoyer un mail à dhc@binets.polytechnique.fr ou appeler le 2630</div>

        </div>
