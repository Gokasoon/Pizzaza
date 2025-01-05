<main id='choix'>
    <?php
        $login = $_GET['login'];
        $mdp = $_GET['mdp'];
        echo "<h1 class='Esp2' style='color:white;'>Choisissez votre compte</h1>";
        echo "<div class='buttons'>";
        echo "<a href='index.php?objet=gens&action=connect&login=".$login."&mdp=".$mdp."&clientOK=OK'><button>Client</button></a>"; 
        echo "<a href='index.php?objet=gens&action=connect&login=".$login."&mdp=".$mdp."&gestOK=OK'><button>Gestionnaire</button></a>"; 
        echo "</div>";
    ?>
<main>