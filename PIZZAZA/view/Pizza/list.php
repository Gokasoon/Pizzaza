<main>
    <table id="liste">
        <tr>
            <?php
            if (is_array($champs) || is_object($champs))
            {
                foreach( $champs as $champ => $valeur ) {
                    if ($champ == $identifiant){
                        continue;
                    }   
                    if ($champ == "Id_Ingredient"){
                        $champ = "nom_ingredient";
                    }
                    echo "<th>";
                    echo "$champ";
                    echo "</th>";
                }
            }

            echo "</tr>";
            if (is_array($tab) || is_object($tab)){
                foreach( $tab as $elt ){
                    echo "<tr>";
                    $id = $elt->get($identifiant);
                    $lienModif = "<a href='index.php?objet=$classeRecup&action=displayUpdateForm&$identifiant=$id'>modifier</a>";
                    $lienSuppr = "<a href='index.php?objet=$classeRecup&action=delete&$identifiant=$id'>supprimer</a>";
                    foreach( $champs as $champ => $valeur ) {
                        if ($champ == $identifiant){
                            continue;
                        }
                        echo "<td>";
                        if ($champ == "Id_Ingredient"){
                            $id =  $elt->get($champ);
                            $ingr = Ingredient::getOne($id);
                            echo $ingr->get("nom_ingredient");

                        } else {
                            echo $elt->get($champ); 
                        }
                        echo "</td>";
                    }
                    if ($lienModifOk){
                        echo "<td> $lienModif </td>";
                    }
                    if ($lienSupprOk){
                        echo "<td> $lienSuppr </td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</table>";
            if ($lienAjoutOk){
                echo "<button><a href='index.php?objet=contient&action=displayCreationForm&Id_Pizza=".$_GET['Id_Pizza']."'>Ajouter</a></button>";
            }
       ?>
</main>