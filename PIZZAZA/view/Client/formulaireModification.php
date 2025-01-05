<form action="index.php" method="get">
    <input type="hidden" name="objet" value="<?php echo $classe; ?>">
    <input type="hidden" name="action" value="update">
    <?php
        echo "<input type=\"hidden\" name=\"$identifiant\" value=\"" . $res->getId() . "\">";
        echo "<label> $classe </label>";
        foreach($champs as $champ => $details){
            if ($champ == "Id_Adresse"){
                continue;
            }
            echo "<div>";
            echo "<label for=\"$champ\"> $details[1]</label>";
            if ($champ == $identifiant){
                echo "<label for=\"$champ\"> ".$res->get($champ)."</label>";
            } else if ($champ == "reduc_client") {
                $f = "pas de réduction pour le prochain achat";
                if ($res->get($champ) == 1){
                    $f = "50% de réduction pour le prochain achat";
                } 
                echo "<label for=\"$champ\"> ".$f."</label>";
            } else if ($champ == "Id_Adresse") {
                echo $selectAdr;
            } else {
                echo "<input type=\"$details[0]\" name=\"$champ\" value=\"".$res->get($champ)."\" required>";
            }
            echo "</div>";
        }

        $adr = Adresse::getOne($res->get("Id_Adresse"));
        $numero_rue = $adr->get("numero_rue");
        $nom_rue = $adr->get("nom_rue");
        $nom_ville = $adr->get("nom_ville");
        $CP_ville = $adr->get("CP_ville");

        echo "<div>";
        echo "<label>Adresse</label>";
        echo "</div>";
        echo "<div>";
        echo "<label for='numero_rue'>Numéro de rue</label>";
        echo "<input type='number' name='numero_rue' value='$numero_rue' required>";
        echo "</div>";
        echo "<div>";
        echo "<label for='nom_rue'>Nom de rue</label>";
        echo "<input type='text' name='nom_rue' value='$nom_rue' required>";
        echo "</div>";
        echo "<div>";
        echo "<label for='nom_ville'>Ville</label>";
        echo "<input type='text' name='nom_ville' value='$nom_ville' required>";
        echo "</div>";
        echo "<div>";
        echo "<label for='CP_ville'>Code postal</label>";
        echo "<input type='number' name='CP_ville' value='$CP_ville' required>";
        echo "</div>";        
    ?>
    <button type="submit">Mettre a jour</button>
</form>