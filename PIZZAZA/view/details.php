<main id='details'>
    <?php
        if (isset($_SESSION["login_gestionnaire"])){
            $gest = true;
        } else {
            $gest = false;
        }
        $identifiant = static::$identifiant;

        echo"<div id='Affdetails'>";
        echo"<div id='Affpizza'>";

        echo "<div class='details-gauche'>";
        echo "<h2 class='nom'>".$res->getNom()."</h2>";
        echo "<img src='".$res->getImg()."'>";
        echo "<p class='prix'>".$res->getPrix()." €</p>";
        echo "</div>";
        
        echo "<div class='details-mid'>";
        if ($classeRecup == "Pizza") {
            echo "<div class='ingredients'>";
            echo "<p>Ingredients : </p>";
            echo "<ul>";
            foreach($ingredients as $ingredient) {
                echo '<li>'.$ingredient["nom_ingredient"].' </li>';
            }
            echo "</ul>";
            echo "</div>";
        }
        echo "</div>";
        echo "<div class='details-droite'>";
        echo "<div class='allergenes'>";
        echo "<p>Allergenes : </p>";
        echo "<ul>";
        foreach($allergenes as $allergene) {
            echo '<li>'.$allergene["nom_allergene"].' </li>';
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";

        echo"</div>";

        echo"<div>";
        
        if (!$gest){
            echo "<div class='buttons'>";
            echo "<a href='index.php?objet=".$classeRecup."'><button>Retour</button></a>";
            echo "<a href='index.php?objet=".$classeRecup."&action=addToCart&".$identifiant."=".$_GET[$identifiant]."'><button>Ajouter au Panier</button></a>"; // TODO: ajouter au panier

            // if ($classeRecup == "Pizza") {
            //     echo "<a href='index.php?objet=".$classeRecup."'><button>Personnaliser</button></a>";
            // }
            echo "</div>";
        } else {
            echo "<div class='buttons'>";
            echo "<a href='index.php?objet=".$classeRecup."&action=displayAll'><button>Retour</button></a>";
            echo "<a href='index.php?objet=".$classeRecup."&action=displayUpdateForm&".$identifiant."=".$_GET[$identifiant]."'><button>Modifier</button></a>";
            echo "<a href='index.php?objet=".$classeRecup."&action=delete&".$identifiant."=".$_GET[$identifiant]."'><button>Supprimer</button></a>";
            echo "</div>";

 
        }
        
        echo"</div>";
        echo"</div>";
        
        
        

    ?>
<main>