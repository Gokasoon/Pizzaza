<main>
    <table id="liste">
        <tr>
            <th>Nom Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
        </tr>
            <?php
            if (is_array($produits) || is_object($produits)) {
                foreach ($produits as $elt) {
                    echo "<tr>";
                    $id = $elt->get("Id_Commande");
                    $id2 = $elt->get("Id_Produit");
                    $lienSuppr = "<a href='index.php?objet=autre_produit&action=delete&Id_Commande=$id&Id_Produit=$id2'>supprimer</a>";
                    $produit = Produit::getOne($elt->get("Id_Produit"));
                    $name = $produit->get("nom_produit"); 
                    $price = $produit->get("prix_produit"); 
                    $qt = $elt->get("quantité");
    
                    echo "<td>$name</td>";
                    echo "<td>$price €</td>";
                    echo "<td>$qt</td>";
                    echo "<td>$lienSuppr</td>";
    
                    echo "</tr>";
                }
            }
            ?>
    </table>
    <table id="liste">
        <tr>
            <th>Nom Pizza</th>
            <th>Prix</th>
        </tr>
            <?php
            if (is_array($pizzas) || is_object($pizzas)) {
                foreach ($pizzas as $elt) {
                    echo "<tr>";
                    $id = $elt->get("Id_estDans");
                    $lienSuppr = "<a href='index.php?objet=est_dans&action=delete&Id_estDans=$id'>supprimer</a>";
                    $pizza = Pizza::getOne($elt->get("Id_Pizza"));
                    $name = $pizza->get("nom_pizza"); 
                    $price = $pizza->get("prix_pizza"); 
                    echo "<td>$name</td>";
                    echo "<td>$price €</td>";
                    echo "<td>$lienSuppr</td>";
    
                    echo "</tr>";
                }
            }
            ?>
    </table>

    <?php
        paiement::updatePaiement($_SESSION["Id_Commande"]);
        $res = paiement::getOne($_SESSION["Id_Commande"]);
        $prix = $res->get("montant");
        echo "<h2> Prix total : $prix €</h2>";
        echo "<div class='buttons'>";
        echo "<a href='index.php?objet=paiement&action=displayUpdateForm&Id_Commande=".$_SESSION['Id_Commande']."'><button>Payer</button></a>";
        echo "</div>";
    ?>
    
</main>