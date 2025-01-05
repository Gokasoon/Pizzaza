<form action="index.php" method="get">
    <input type="hidden" name="objet" value="<?php echo $classe; ?>">
    <input type="hidden" name="action" value="create">
    <input type="hidden" name="Id_Pizza" value="<?php echo isset($_GET['Id_Pizza']) ? $_GET['Id_Pizza'] : ''; ?>">    
    <?php
        foreach($champs as $champ => $details){
            if( $champ == "Id_Pizza"){
                continue;
            }
            echo "<div>";
            echo "<label for=\"$champ\">$details[1]</label>";

            if ($champ == "Id_Ingredient"){
                echo $selectIngr;
            } else {
                echo "<input type=\"$details[0]\" name=\"$champ\" placeholder=\"$details[1]\" required>";
            }
            
            echo "</div>";
        }
    ?>
    <button type="submit">Ajouter</button>
</form>