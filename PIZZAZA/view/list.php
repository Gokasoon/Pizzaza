<main>
    <table id="liste">
        <tr>
            <?php
            foreach( $champs as $champ => $valeur ) {
                echo "<th>";
                echo "$champ";
                echo "</th>";
            }
            

            echo "</tr>";
            foreach( $tab as $elt ){
                echo "<tr>";
                $id = $elt->get($identifiant);
                $lienModif = "<a href='index.php?objet=$classeRecup&action=displayUpdateForm&$identifiant=$id'>modifier</a>";
                $lienSuppr = "<a href='index.php?objet=$classeRecup&action=delete&$identifiant=$id'>supprimer</a>";
                foreach( $champs as $champ => $valeur ) {
                    echo "<td>";
                    if ($champ == "mdp_gestionnaire"){
                        for($i=0; $i<strlen($elt->get($champ)); $i++){
                            echo "*";
                        }
                    } else if ($champ == "Id_Ingredient"){
                        if ($elt->get($champ) != 0){
                            $id = $elt->get($champ);
                            $ingr = Ingredient::getOne($id);
                            echo $ingr->get("nom_ingredient");
                        } else {
                            echo "";
                        }
                        
                    } else if ($champ == "Id_Produit"){
                        if ($elt->get($champ) != 0){
                            $id = $elt->get($champ);
                            $prod = Produit::getOne($id);
                            echo $prod->get("nom_produit");
                        } else {
                            echo "";
                        }
                        
                    } else if ($champ == "Id_Gestionnaire"){
                        if ($elt->get($champ) != 0){
                            $id = $elt->get($champ);
                            $gest = Gestionnaire::getOne($id);
                            if ($gest) {
                                echo $gest->get("login_gestionnaire");
                            }
                        } else {
                            echo "";
                        }
                        
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
            echo "</table>";
            if ($lienAjoutOk){
                echo "<button class='BoutAjout'><a href='index.php?objet=$classeRecup&action=displayCreationForm'>Ajouter</a></button>";
            }
       ?>
</main>