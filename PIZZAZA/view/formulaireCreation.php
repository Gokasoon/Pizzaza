<form action="index.php" method="get">
    <input type="hidden" name="objet" value="<?php echo $classe; ?>">
    <input type="hidden" name="action" value="create">
    <?php
        foreach($champs as $champ => $details){
            if ($champ == $identifiant){
                continue;
            }
            echo "<div>";
           
            if ($champ == "type_produit"){
                if ($classe == "Dessert"){
                    echo "<input type='hidden' name='type_produit' value='Dessert'>";
                } else {
                    echo "<input type='hidden' name='type_produit' value='Boisson'>";
                }
            } else {
                echo "<label for=\"$champ\">$details[1]</label>";
                if ($champ == "quantité"){
                    $v = "quantite";
                } else {
                    $v = $champ;
                }
                echo "<input type=\"$details[0]\" name=\"$v\" placeholder=\"$details[1]\" required>";
            }
            echo "</div>";
        }
    ?>
    <button type="submit">Créer</button>
</form>