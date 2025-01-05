<main id='grid'>
    <?php
    if (is_array($tab)){

        $classe = $tab[0]->getClasse();

        if(isset($_SESSION["login_gestionnaire"])){
            echo "<div class='case'>";
            echo "<a href='index.php?objet=".$classe."&action=displayCreationForm'>";
            echo "<img src='./img/plus.png'>";
            echo "<h2>Créer ".$classe."</h2>";
            echo "</a>";
            echo "</div>";

        }

        foreach($tab as $obj) {
            echo "<div class='case'>";
            echo "<a href='index.php?objet=".$obj->getClasse()."&action=displayOne&".$identifiant."=".$obj->getId()."'>";
            try{
                echo "<img src='".$obj->getImg()."'>";
            } catch (Exception $e) {
            }
            echo "<h2>".$obj->getNom()."</h2>";
            echo "<p>".$obj->getPrix()." €</p>";
            if ($obj->getClasse() != "Pizza" && isset($_SESSION["login_gestionnaire"])){
                echo "<p>".$obj->getQt()." en stock</p>";
            }
            echo "</a>";
            echo "</div>";
        }
        if (count($tab) <= 5) { // to show only on the home page
            echo "<div class='case'>";
            echo "<a href='index.php?objet=".$classe."'>";
            echo "<img src='./img/fleche.png'>";
            echo "<h2>Voir la carte entière des ".$classe."s</h2>";
            echo "</a>";
            echo "</div>";
        }
    }
    ?>
</main>
