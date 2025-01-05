<form action="index.php" method="get">
    <input type="hidden" name="objet" value="paiement">
    <input type="hidden" name="action" value="update">
    <?php
        echo "<input type=\"hidden\" name=\"$identifiant\" value=\"" . $res->getId() . "\">";
        echo "<label> Paiement </label>";

       echo "<div>";
       echo "<label> Numero de carte bleue </label>";
       echo "<input type=\"number\" name=\"numCB\" value=\"\">";
       echo "</div>";

       echo "<div>";
       echo "<label> Cryptogramme</label>";
       echo "<input type=\"number\" name=\"cryptogramme\" value=\"\">";
       echo "</div>";

       echo "<div>";
       echo "<label> Date de péremption </label>";
       echo "<input type=\"date\" name=\"date_peremption\" value=\"\">";
       echo "</div>";

       $res = paiement::getOne($_SESSION["Id_Commande"]);
       $prix = $res->get("montant");
       echo "<h2> Prix total : $prix €</h2>";
    ?>
    <button type="submit">Payer</button>
</form>