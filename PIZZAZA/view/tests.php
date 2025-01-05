<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tests</title>
</head>

<body>

    <h1>Tests</h1>

    <?php

    require_once("../config/connexion.php");
    require_once("../model/Pizza.php"); 
    require_once("../model/Pizza_perso.php"); 
    require_once("../model/Produit.php"); 
    require_once("../model/Ingredient.php"); 
    require_once("../model/Allergene.php"); 
    require_once("../model/Commande.php"); 
    require_once("../model/contient.php"); 
    require_once("../model/contient_perso.php"); 
    require_once("../model/peut_contenir.php"); 
    require_once("../model/peut_contenirV2.php"); 
    require_once("../model/est_dans.php");
    require_once("../model/est_dans_v2.php"); 
    require_once("../model/autre_produit.php"); 

    connexion::connect();

    echo "<h2>Test Pizza</h2>";
    $pizzas = Pizza::getAll();
    echo "<ul>";
    foreach ($pizzas as $pizza) {
        echo "<li>$pizza</li>";
    }
    echo "</ul>";

    echo "<h2>Test Pizza Perso</h2>";
    $pizzasperso = Pizza_perso::getAll();
    echo "<ul>";
    foreach ($pizzasperso as $pizzaperso) {
        echo "<li>$pizzaperso</li>";
    }
    echo "</ul>";

    echo "<h2>Test Produit</h2>";
    $produits = Produit::getAll();
    echo "<ul>";
    foreach ($produits as $produit) {
        echo "<li>$produit</li>";
    }
    echo "</ul>";

    echo "<h2>Test Ingredient</h2>";
    $ingredients = Ingredient::getAll();
    echo "<ul>";
    foreach ($ingredients as $ingredient) {
        echo "<li>$ingredient</li>";
    }
    echo "</ul>";

    echo "<h2>Test Allergene</h2>";
    $allergenes = Allergene::getAll();
    echo "<ul>";
    foreach ($allergenes as $allergene) {
        echo "<li>$allergene</li>";
    }
    echo "</ul>";

    echo "<h2>Test Commande</h2>";
    $commandes = Commande::getAll();
    echo "<ul>";
    foreach ($commandes as $commande) {
        echo "<li>$commande</li>";
    }
    echo "</ul>";

    echo "<h2>Test contient</h2>";
    $contients = contient::getAll();
    echo "<ul>";
    foreach ($contients as $contient) {
        echo "<li>$contient</li>";
    }
    echo "</ul>";

    echo "<h2>Test contient_perso</h2>";
    $contientpersos = contient_perso::getAll();
    echo "<ul>";
    foreach ($contientpersos as $contientperso) {
        echo "<li>$contientperso</li>";
    }
    echo "</ul>";

    echo "<h2>Test peut_contenir</h2>";
    $peut_contenirs = peut_contenir::getAll();
    echo "<ul>";
    foreach ($peut_contenirs as $peut_contenir) {
        echo "<li>$peut_contenir</li>";
    }
    echo "</ul>";

    echo "<h2>Test peut_contenirV2</h2>";
    $peut_contenirs2 = peut_contenirV2::getAll();
    echo "<ul>";
    foreach ($peut_contenirs2 as $peut_contenir2) {
        echo "<li>$peut_contenir2</li>";
    }
    echo "</ul>";

    echo "<h2>Test est_dans</h2>";
    $est_danss = est_dans::getAll();
    echo "<ul>";
    foreach ($est_danss as $est_dans) {
        echo "<li>$est_dans</li>";
    }
    echo "</ul>";

    echo "<h2>Test est_dans2</h2>";
    $est_danss2 = est_dans_v2::getAll();
    echo "<ul>";
    foreach ($est_danss2 as $est_dans2) {
        echo "<li>$est_dans2</li>";
    }
    echo "</ul>";

    echo "<h2>Test autre_produit</h2>";
    $autre_produits = autre_produit::getAll();
    echo "<ul>";
    foreach ($autre_produits as $autre_produit) {
        echo "<li>$autre_produit</li>";
    }
    echo "</ul>";

    ?>

</body>
</html>
