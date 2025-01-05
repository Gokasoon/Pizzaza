<form action="index.php" method="get">
    <input type="hidden" name="objet" value="<?php echo $classe; ?>">
    <input type="hidden" name="action" value="create">
    <?php
        foreach($champs as $champ => $details){
            if( $champ == "Id_Alerte"){
                continue;
            }
            echo "<div>";
            echo "<label for=\"$champ\">$details[1]</label>";
            if ($champ == "Id_Ingredient"){
                echo $selectIngr;
            } else if ($champ == "Id_Produit"){
                echo $selectProd;
            } else if ($champ == "Id_Gestionnaire"){
                echo $selectGest;
            } else {
                echo "<input type=\"$details[0]\" name=\"$champ\" placeholder=\"$details[1]\" required>";
            }
            echo "</div>";
        }
    ?>
    <button type="submit">Créer</button>
</form>