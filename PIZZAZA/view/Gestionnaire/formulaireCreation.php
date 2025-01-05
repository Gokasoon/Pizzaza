<form action="index.php" method="get">
    <input type="hidden" name="objet" value="Gestionnaire">
    <input type="hidden" name="action" value="create">
    <?php
        
        echo "<div>";
        echo "<label for=\"Gestionnaire\">Gestionnaire</label>";
        echo $selectClient;
        echo "</div>";
        
    ?>
    <button type="submit">Creer</button>
</form>