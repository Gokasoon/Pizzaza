<form action="index.php" method="get">
    <input type="hidden" name="objet" value="<?php echo $classe; ?>">
    <input type="hidden" name="action" value="update">
    <?php
        echo "<input type=\"hidden\" name=\"$identifiant\" value=\"" . $res->getId() . "\">";
        echo "<label> $classe </label>";
        foreach($champs as $champ => $details){
            echo "<div>";
            echo "<label for=\"$champ\"> $details[1]</label>";
            if ($champ == $identifiant){
                echo "<label for=\"$champ\"> ".$res->get($champ)."</label>";
            } else if ($champ == "Id_Ingredient"){
                echo $selectIngr;
            } else if ($champ == "Id_Produit"){
                echo $selectProd;
            } else if ($champ == "Id_Gestionnaire"){
                echo $selectGest;
            } else {
                echo "<input type=\"$details[0]\" name=\"$champ\" value=\"".$res->get($champ)."\" required>";
            }
            echo "</div>";
        }
    ?>
    <button type="submit">Mettre a jour</button>
</form>