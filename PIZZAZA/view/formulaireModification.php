<form action="index.php" method="get">
    <input type="hidden" name="objet" value="<?php echo $classe; ?>">
    <input type="hidden" name="action" value="update">
    <?php
        echo "<input type=\"hidden\" name=\"$identifiant\" value=\"" . $res->getId() . "\">";
        echo "<label> $classe </label>";
        foreach($champs as $champ => $details){
            echo "<div>";
            if ($champ == "type_produit"){
                echo "<input type=\"hidden\" name=\"type_produit\" value=\"" . $res->getType() . "\">";
            } else {
                echo "<label for=\"$champ\">$details[1] : </label>";
            if ($champ == $identifiant){
                echo "<label for=\"$champ\">".$res->get($champ)."</label>";
            } else {
                if ($details[0] == "decimal"){
                    if ($champ == "quantité"){
                        $v = "quantite";
                    } else {
                        $v = $champ;
                    }
                    echo "<input type=\"number\" step=\".01\" name=\"$v\" value=\"".$res->get($champ)."\" required>";

                } else {
                    echo "<input type=\"$details[0]\" name=\"$champ\" value=\"".$res->get($champ)."\" required>";
                }
            }
            }
            echo "</div>";
        }

        if ($identifiant == "Id_Produit"){   //TODO
            // $classeRecup = contient::getClassee();
            // $identifiant = contient::getId();
            // $champs = contient::getChamps();
            // $id = $_GET[$identifiant];
            // $tab = contient::getAlli($id);
            // $lienModifOk = true;
            // $lienSupprOk = true;
            // $lienAjoutOk = true;
            // include("./view/list.php");
        }
    ?>
    <button type="submit">Mettre a jour</button>
</form>