<!-- DB / Header-->
<?php 
    require 'data/config.data.php';
    require 'includes/header.php';

    //Requête classement Football
    $rankFoot = $conn->prepare("SELECT SUM(gagner) AS gagner, SUM(perdu) AS perdu, ratio.user, users.username FROM ratio JOIN users ON users.id = ratio.user AND sport = 1 GROUP BY users.id ORDER BY perdu ASC");
    $rankFoot->execute();
    $rowFoot = $rankFoot->fetchAll();

    //Requête classement Handball
    $rankHand = $conn->prepare("SELECT SUM(gagner) AS gagner, SUM(perdu) AS perdu, ratio.user, users.username FROM ratio JOIN users ON users.id = ratio.user AND sport = 2 GROUP BY users.id ORDER BY perdu ASC");
    $rankHand->execute();
    $rowHand = $rankHand->fetchAll();

    //Requête classement Basket
    $rankBasket = $conn->prepare("SELECT SUM(gagner) AS gagner, SUM(perdu) AS perdu, ratio.user, users.username FROM ratio JOIN users ON users.id = ratio.user AND sport = 3 GROUP BY users.id ORDER BY perdu ASC");
    $rankBasket->execute();
    $rowBasket = $rankBasket->fetchAll();
?>

<!-- CSS -->  
<link rel="stylesheet" href="resources/css/rank.css">

<title>BetGuess - Classement</title>

<html>
    <body>
        <center>

        <br><h3>Meilleur Pronostiqueur</h3> <br>

        <h5>Ici vous pouvez trouver les meilleurs pronostiqueurs triés par sport!</h5><br>

        <div class="container bootstrap snippets bootdey">

            <div class="row margin-bottom-10">

            <!-- Box classement FootBall -->
            <div class="col-md-4 col-sm-6">
            <div class="servive-block servive-block-grey">
                <i class="icon-2x color-light fa fa-futbol"></i>
                <h2 class="heading-md">Football</h2>

                <?php foreach($rowFoot as $ranking) {
                        
                        //Calcul du pourcentage
                        $cent = 100; 
                        $total = $ranking['gagner'] + $ranking['perdu'];
                        $pourcent = $ranking['gagner']/$total*$cent;

                        echo "<p><a href='profile.php?id=" . $ranking['user'] . "'>" . $ranking['username'] . "</a>" .  " | "; //Affichage + href vers le profile
                        echo "<font color='green'>" . $ranking['gagner'] . "</font> "; //Affichage du nombre de victoire
                        echo "- <font color='red'>" . $ranking['perdu'] . "</font> | "; //Affichage du nombre de défaite
                        echo number_format($pourcent,0) . "%"; //Affichage poucentage victoire ?>
                        <?php } ?>
            </div>
            </div>

            <!-- Box classement HandBall -->
            <div class="col-md-4 col-sm-6">
            <div class="servive-block servive-block-grey">
                <i class="icon-2x color-light fas fa-volleyball-ball"></i>
                <h2 class="heading-md">Handball</h2>
                
                <?php foreach($rowHand as $ranking) {

                        //Calcul du pourcentage
                        $cent = 100; 
                        $total = $ranking['gagner'] + $ranking['perdu'];
                        $pourcent = $ranking['gagner']/$total*$cent;

                        echo "<p><a href='profile.php?id=" . $ranking['user'] . "'>" . $ranking['username'] . "</a>" .  " | "; //Affichage + href vers le profile
                        echo "<font color='green'>" . $ranking['gagner'] . "</font> "; //Affichage du nombre de victoire
                        echo "- <font color='red'>" . $ranking['perdu'] . "</font> | "; //Affichage du nombre de défaite
                        echo number_format($pourcent,0) . "%"; //Affichage poucentage victoire ?>                    
                <?php } ?>
            </div>
            </div>
                
            <!-- Box classement Basket -->
            <div class="col-md-4 col-sm-12">
            <div class="servive-block servive-block-grey">            
                <i class="icon-2x color-light fas fa-basketball-ball"></i>
                <h2 class="heading-md">Basket</h2>
                
                <?php foreach($rowBasket as $ranking) {

                    //Calcul du pourcentage
                    $cent = 100; 
                    $total = $ranking['gagner'] + $ranking['perdu'];
                    $pourcent = $ranking['gagner']/$total*$cent;

                    echo "<p><a href='profile.php?id=" . $ranking['user'] . "'>" . $ranking['username'] . "</a>" .  " | "; //Affichage + href vers le profile
                    echo "<font color='green'>" . $ranking['gagner'] . "</font> "; //Affichage du nombre de victoire
                    echo "- <font color='red'>" . $ranking['perdu'] . "</font> | "; //Affichage du nombre de défaite
                    echo number_format($pourcent,0) . "%"; //Affichage poucentage victoire ?> 
                <?php } ?>
            </div>
            </div>
        </div>
        </center>
    </body>
</html>