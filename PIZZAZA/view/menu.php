<header>
    <nav>        
        <?php

        echo"<div><a href='index.php?objet=Accueil'> <img src='./img/Logo.png' /> </a></div>";

        if (isset($_SESSION["login_client"]) && isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1){

            echo"<div class='Menu'>";
            echo "<div class='Bouton' ><a href='index.php?objet=Gestionnaire'> Gestionnaire</a></div>";
            echo "<div class='Bouton' ><a href='index.php?objet=Client&action=displayUpdateForm&login_client=".$_SESSION['login_client']."'>Mon profil</a></div>";
            echo "<div class='Bouton' ><a href='index.php?objet=gens&action=disconnect'>Se déconnecter</a></div>";
            echo"</div>";

        } else {
            // if (isset($_SESSION["login_client"])){
            //     echo "<div class='Bouton' ><a href='index.php?objet=Accueil'>Accueil</a></div>";
            // }
            if (!isset($_SESSION["login_gestionnaire"])){

                echo"<div class='Menu'>";
                echo "<div class='Bouton' ><a href='index.php?objet=Pizza'>Pizza</a></div>";
                echo "<div class='Bouton' ><a href='index.php?objet=Boisson'>Boisson</a></div>";
                echo "<div class='Bouton' ><a href='index.php?objet=Dessert'>Dessert</a></div>";
                echo"</div>";

                echo"<div class='Menu'>";
                echo "<div class='Bouton' ><a href='index.php?objet=Commande&action=displayUpdateForm'>Panier</a></div>";
                echo"</div>";
            }

            if (isset($_SESSION["login_gestionnaire"])){

                echo"<div class='Menu'>";
                echo "<div class='Bouton' ><a href='index.php?objet=Pizza&action=displayAll'>Pizza</a></div>";
                echo "<div class='Bouton' ><a href='index.php?objet=Boisson&action=displayAll'>Boisson</a></div>";
                echo "<div class='Bouton' ><a href='index.php?objet=Dessert&action=displayAll'>Dessert</a></div>";
                echo"</div>";

                echo "<div class='Bouton' ><a href='index.php?objet=Ingredient'>Ingredient</a></div>";
                echo "<div class='Bouton' ><a href='index.php?objet=Alerte&action=displayAlerte'>Alerte</a></div>";
                echo "<div class='Bouton' ><a href='index.php?objet=Gestionnaire&action=displayCA'>CA</a></div>";
                
                echo"<div class='Menu'>";
                echo "<div class='Bouton' ><a href='index.php?objet=Gestionnaire&action=displayUpdateForm&login_gestionnaire=".$_SESSION['login_gestionnaire']."'>Mon profil</a></div>";
                echo "<div class='Bouton' ><a href='index.php?objet=gens&action=disconnect'>Se déconnecter</a></div>";
                echo"</div>";

            } else if (isset($_SESSION["login_client"]) && !isset($_SESSION["isAdmin"])){
                echo "<div class='Bouton' ><a href='index.php?objet=Client&action=displayUpdateForm&login_client=".$_SESSION['login_client']."'>Mon profil</a></div>";
                echo "<div class='Bouton' ><a href='index.php?objet=gens&action=disconnect'>Se déconnecter</a></div>";
            } else { 
                echo "<div class='Bouton' ><a href='index.php?objet=gens&action=displayConnectionForm'>Se connecter</a></div>";
            }
        } 
        
        ?>
    </nav>
</header>

<div>
    <?php
        if ($_GET["objet"] == "Accueil")
        {
            echo "<div> <img id='Bandeau' src='./img/Bandeau.png' /> </div>";
        }
        if ($_GET["objet"] == "gens" && ($_GET["action"] == "disconnect" || $_GET["action"] == "connect") && !isset($_SESSION["isAdmin"]) && !isset($_SESSION["login_gestionnaire"]) && !isset($choix))
        {
            echo "<div> <img id='Bandeau' src='./img/Bandeau.png' /> </div>";
        }
        
    ?>
</div>
