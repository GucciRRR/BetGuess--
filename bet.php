<!-- DB / Header -->
<?php
    require 'data/config.data.php';
    require 'includes/header.php';

    //Redirection si non connecter
    if($_SESSION['id'] == NULL) {
        header("Location: ../index.php");
    }

    $user_id = $_SESSION['id'];

    //Requête "Mes Paris" Football
    $parisF = $conn->prepare("SELECT bets.match_id, bets.victoire_dom, bets.nul, bets.victoire_ext, matchs.dom, matchs.ext FROM bets JOIN matchs ON matchs.id = bets.match_id WHERE `user_id` = ? AND matchs.sport_id = 1");
    $parisF->execute(array($user_id));
    $rowF = $parisF->fetchAll();

    //Requête "Mes Paris" Handball
    $parisH = $conn->prepare("SELECT bets.match_id, bets.victoire_dom, bets.nul, bets.victoire_ext, matchs.dom, matchs.ext FROM bets JOIN matchs ON matchs.id = bets.match_id WHERE `user_id` = ? AND matchs.sport_id = 2");
    $parisH->execute(array($user_id));
    $rowH = $parisH->fetchAll();

    //Requête "Mes Paris" Bascket
    $parisB = $conn->prepare("SELECT bets.match_id, bets.victoire_dom, bets.nul, bets.victoire_ext, matchs.dom, matchs.ext FROM bets JOIN matchs ON matchs.id = bets.match_id WHERE `user_id` = ? AND matchs.sport_id = 3");
    $parisB->execute(array($user_id));
    $rowB = $parisB->fetchAll();

    //Requête pour afficher le résulta des matchs
    $result = $conn->prepare("SELECT bets.match_id, result.r_victoire_dom, result.r_nul, result.r_victoire_ext FROM bets JOIN result ON result.match_id = bets.match_id WHERE `user_id` = ?");
    $result->execute(array($user_id));
    $rRow = $result->fetchAll();
?>

<!-- CSS -->  
<link rel="stylesheet" href="resources/css/index.css">

<link rel="stylesheet" href="resources/css/rank.css">

<link rel="stylesheet" href="resources/css/bet.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<title>BetGuess - Mes paris</title>

<htlm>
    <body>
        <center>

        <br><h3>Paris les plus récents</h3> <br>

        <h5>Analysez vos paris les plus récents et découvrez si vous avez gagné!<br> La liste est nettoyer par notre robot toute les semaines.<br><br> Bonne chance!</h5><br>

            <!--Boutton Paris Football -->
            <button type="button" id="football" class="btn btn-secondary btn-lg">Football</button>&ensp;&ensp;
            <div id="btnfootball"><br>
            <div class="col-md-4 col-sm-6">
                <div class="servive-block servive-block-grey">
                    <i class="icon-2x color-light fa fa-futbol"></i>
                        <h2 class="heading-md">Football</h2>
                <?php 
                foreach($rowF as $listeparisF) { 
                    $match_id = $listeparisF['match_id'];
                    $dom = $listeparisF['dom'];
                    $vic_dom = $listeparisF['victoire_dom'];
                    $nul = $listeparisF['nul'];
                    $ext = $listeparisF['ext'];
                    $vic_ext = $listeparisF['victoire_ext']; ?>

                    <button type="button" id="openf<?php echo $match_id ?>" class="btn btn-secondary btn-lg"><?php echo $dom ?> - <?php echo $ext ?></button><br><br>
                    
                    <div id="pronof<?php echo $match_id ?>">

                    <h5>Pronostique : <?php if($vic_dom == 1) { echo "Victoire ". $dom;}        //Affiche le pronostique donné par l'utilisateur pour ce match
                                        if($nul == 1) { echo "Match nul";}
                                        if($vic_ext == 1) { echo "Victoire ". $ext;}?></h5> <br>

                    <h5>Résultat :    <?php foreach($rRow as $result) {         //Affiche le résulta du match en question
                                        $match_id_f = $result['match_id'];
                                        $result_dom = $result['r_victoire_dom'];
                                        $result_nul = $result['r_nul'];
                                        $result_ext = $result['r_victoire_ext'];
                                        $result_total = $result_dom + $result_nul + $result_ext;

                                        if($match_id == $match_id_f) {
                                        if($result_dom == 1) { echo "Victoire ". $dom . "<br>";}
                                        if($result_nul == 1) { echo "Match nul <br>";}
                                        if($result_ext == 1) { echo "Victoire ". $ext . "<br>";}
                                        if($result_total == 0) { echo "Le match n'est pas fini. <br>";} //Si le total est de 0, le match n'est pas fini.

                                        if($result_total != 0) {

                                            if($vic_dom & $result_dom == 1 || $nul & $result_nul == 1 || $vic_ext & $result_ext == 1) { //Vérif si le pronotique est gagnant
                                                
                                                $checkmatch = $conn->prepare("SELECT * FROM ratio WHERE user = ? AND match_id = ?");
                                                $checkmatch->execute(array($user_id,$match_id));
                                                $checkmatchRow = $checkmatch->rowCount();

                                                if($checkmatchRow == 0) { //Si gagnant -> Augmente le classement victoire de +1
                                
                                                    $validbet = $conn->prepare("INSERT INTO ratio(user, match_id, sport, gagner, perdu) VALUES (?, ?, 1, 1, 0)");
                                                    $validbet->execute(array($user_id,$match_id));
                                                }

                                                echo "<br> <font color='green'> <i class='fas fa-check-circle'></i> GAGNER!</font>";}

                                            else if($vic_dom != $result_dom || $nul != $result_nul || $vic_ext != $result_ext) { //Verif si le pronostique est perdu
                                                
                                                $checkmatch = $conn->prepare("SELECT * FROM ratio WHERE user = ? AND match_id = ?");
                                                $checkmatch->execute(array($user_id,$match_id));
                                                $checkmatchRow = $checkmatch->rowCount();

                                                if($checkmatchRow == 0) { //Si perdant -> Augmente le classement perdu de +1
                                
                                                    $validbet = $conn->prepare("INSERT INTO ratio(user, match_id, sport, gagner, perdu) VALUES (?, ?, 1, 0, 1)");
                                                    $validbet->execute(array($user_id,$match_id));
                                                }

                                                echo "<br> <font color='red'> <i class='fas fa-times'></i> PERDU!</font>";}
                                                }
                                            }
                                        } ?> </h5>
                    </div>

                    <!-- CSS Pour cacher les bouttons -->
                    <style>#pronof<?php echo $match_id ?> {display: none;}
                           #btnfootball {display: none;}
                    </style>

                    <!-- Ouverture des bouttons -->
                    <script>
                    jQuery(document).ready(function(){
                        jQuery('#openf<?php echo $match_id ?>').on('click', function(event) {        
                            jQuery('#pronof<?php echo $match_id ?>').toggle('show');
                        });
                    });
                    </script>

               <?php } ?>

               <!-- Ouverture Football -->
               <script>
                    jQuery(document).ready(function(){
                        jQuery('#football').on('click', function(event) {        
                            jQuery('#btnfootball').toggle('show');
                        });
                    });
                </script>
                </div>
            </div>
        </div>

            <!--Boutton Paris Handball -->
            <button type="button" id="handball" class="btn btn-secondary btn-lg">Handball</button>&ensp;&ensp;
            <div id="btnhandball"><br>
            <div class="col-md-4 col-sm-6">
                <div class="servive-block servive-block-grey">
                    <i class="icon-2x color-light fas fa-volleyball-ball"></i>
                        <h2 class="heading-md">Handball</h2>
                <?php 
                foreach($rowH as $listeparisH) { 
                    $match_id = $listeparisH['match_id'];
                    $dom = $listeparisH['dom'];
                    $vic_dom = $listeparisH['victoire_dom'];
                    $nul = $listeparisH['nul'];
                    $ext = $listeparisH['ext'];
                    $vic_ext = $listeparisH['victoire_ext']; ?>

                    <button type="button" id="openh<?php echo $match_id ?>" class="btn btn-secondary btn-lg"><?php echo $dom ?> - <?php echo $ext ?></button><br><br>
                    
                    <div id="pronoh<?php echo $match_id ?>">

                    <h5>Pronostique : <?php if($vic_dom == 1) { echo "Victoire ". $dom;}
                                        if($nul == 1) { echo "Match nul";}
                                        if($vic_ext == 1) { echo "Victoire ". $ext;}?></h5> <br>

                    <h5>Résultat :    <?php foreach($rRow as $result) {
                                        $match_id_f = $result['match_id'];
                                        $result_dom = $result['r_victoire_dom'];
                                        $result_nul = $result['r_nul'];
                                        $result_ext = $result['r_victoire_ext'];
                                        $result_total = $result_dom + $result_nul + $result_ext;

                                        if($match_id == $match_id_f) {
                                        if($result_dom == 1) { echo "Victoire ". $dom . "<br>";}
                                        if($result_nul == 1) { echo "Match nul <br>";}
                                        if($result_ext == 1) { echo "Victoire ". $ext . "<br>";}
                                        if($result_total == 0) { echo "Le match n'est pas fini. <br>";}

                                        if($result_total != 0) {

                                            if($vic_dom & $result_dom == 1 || $nul & $result_nul == 1 || $vic_ext & $result_ext == 1) {
                                                
                                                $checkmatch = $conn->prepare("SELECT * FROM ratio WHERE user = ? AND match_id = ?");
                                                $checkmatch->execute(array($user_id,$match_id));
                                                $checkmatchRow = $checkmatch->rowCount();

                                                if($checkmatchRow == 0) {
                                
                                                    $validbet = $conn->prepare("INSERT INTO ratio(user, match_id, sport, gagner, perdu) VALUES (?, ?, 2, 1, 0)");
                                                    $validbet->execute(array($user_id,$match_id));
                                                }

                                                echo "<br> <font color='green'> <i class='fas fa-check-circle'></i> GAGNER!</font>";}

                                            else if($vic_dom != $result_dom || $nul != $result_nul || $vic_ext != $result_ext) {
                                                
                                                $checkmatch = $conn->prepare("SELECT * FROM ratio WHERE user = ? AND match_id = ?");
                                                $checkmatch->execute(array($user_id,$match_id));
                                                $checkmatchRow = $checkmatch->rowCount();

                                                if($checkmatchRow == 0) {
                                
                                                    $validbet = $conn->prepare("INSERT INTO ratio(user, match_id, sport, gagner, perdu) VALUES (?, ?, 2, 0, 1)");
                                                    $validbet->execute(array($user_id,$match_id));
                                                }

                                                echo "<br> <font color='red'> <i class='fas fa-times'></i> PERDU!</font>";}
                                                }
                                            }
                                        } ?> </h5>
                    </div>

                    <!-- CSS Pour cacher les bouttons -->
                    <style>#pronoh<?php echo $match_id ?> {display: none;}
                           #btnhandball {display: none;}
                    </style>

                    <!-- Ouverture des bouttons -->
                    <script>
                    jQuery(document).ready(function(){
                        jQuery('#openh<?php echo $match_id ?>').on('click', function(event) {        
                            jQuery('#pronoh<?php echo $match_id ?>').toggle('show');
                        });
                    });
                    </script>

               <?php } ?>

               <!-- Ouverture Handball -->
               <script>
                    jQuery(document).ready(function(){
                        jQuery('#handball').on('click', function(event) {        
                            jQuery('#btnhandball').toggle('show');
                        });
                    });
                </script>
                </div>
            </div>
        </div>

            <!--Boutton Paris Basket -->
            <button type="button" id="basket" class="btn btn-secondary btn-lg">Basket</button><br><br>
            <div id="btnbasket"><br>
            <div class="col-md-4 col-sm-6">
                <div class="servive-block servive-block-grey">
                    <i class="icon-2x color-light fas fa-basketball-ball"></i>
                        <h2 class="heading-md">Basket</h2>
                <?php 
                foreach($rowB as $listeparisB) { 
                    $match_id = $listeparisB['match_id'];
                    $dom = $listeparisB['dom'];
                    $vic_dom = $listeparisB['victoire_dom'];
                    $nul = $listeparisB['nul'];
                    $ext = $listeparisB['ext'];
                    $vic_ext = $listeparisB['victoire_ext']; ?>

                    <button type="button" id="openb<?php echo $match_id ?>" class="btn btn-secondary btn-lg"><?php echo $dom ?> - <?php echo $ext ?></button><br><br>
                    
                    <div id="pronob<?php echo $match_id ?>">

                    <h5>Pronostique : <?php if($vic_dom == 1) { echo "Victoire ". $dom;}
                                        if($nul == 1) { echo "Match nul";}
                                        if($vic_ext == 1) { echo "Victoire ". $ext;}?></h5> <br>

                    <h5>Résultat :    <?php foreach($rRow as $result) {
                                        $match_id_f = $result['match_id'];
                                        $result_dom = $result['r_victoire_dom'];
                                        $result_ext = $result['r_victoire_ext'];
                                        $result_total = $result_dom + $result_ext;

                                        if($match_id == $match_id_f) {
                                        if($result_dom == 1) { echo "Victoire ". $dom . "<br>";}
                                        if($result_ext == 1) { echo "Victoire ". $ext . "<br>";}
                                        if($result_total == 0) { echo "Le match n'est pas fini. <br>";}

                                        if($result_total != 0) {

                                            if($vic_dom & $result_dom == 1 || $vic_ext & $result_ext == 1) {
                                                
                                                $checkmatch = $conn->prepare("SELECT * FROM ratio WHERE user = ? AND match_id = ?");
                                                $checkmatch->execute(array($user_id,$match_id));
                                                $checkmatchRow = $checkmatch->rowCount();

                                                if($checkmatchRow == 0) {
                                
                                                    $validbet = $conn->prepare("INSERT INTO ratio(user, match_id, sport, gagner, perdu) VALUES (?, ?, 3, 1, 0)");
                                                    $validbet->execute(array($user_id,$match_id));
                                                }

                                                echo "<br> <font color='green'> <i class='fas fa-check-circle'></i> GAGNER!</font>";}

                                            else if($vic_dom != $result_dom || $vic_ext != $result_ext) {
                                                
                                                $checkmatch = $conn->prepare("SELECT * FROM ratio WHERE user = ? AND match_id = ?");
                                                $checkmatch->execute(array($user_id,$match_id));
                                                $checkmatchRow = $checkmatch->rowCount();

                                                if($checkmatchRow == 0) {
                                
                                                    $validbet = $conn->prepare("INSERT INTO ratio(user, match_id, sport, gagner, perdu) VALUES (?, ?, 3, 0, 1)");
                                                    $validbet->execute(array($user_id,$match_id));
                                                }

                                                echo "<br> <font color='red'> <i class='fas fa-times'></i> PERDU!</font>";}
                                                }
                                            }
                                        } ?> </h5>
                    </div>

                    <!-- CSS Pour cacher les bouttons -->
                    <style>#pronob<?php echo $match_id ?> {display: none;}
                           #btnbasket {display: none;}
                    </style>

                    <!-- Ouverture des bouttons -->
                    <script>
                    jQuery(document).ready(function(){
                        jQuery('#openb<?php echo $match_id ?>').on('click', function(event) {        
                            jQuery('#pronob<?php echo $match_id ?>').toggle('show');
                        });
                    });
                    </script>

               <?php } ?>

               <!-- Ouverture Basket -->
               <script>
                    jQuery(document).ready(function(){
                        jQuery('#basket').on('click', function(event) {        
                            jQuery('#btnbasket').toggle('show');
                        });
                    });
                </script>
                </div>
            </div>
        </div>
    </body>
</html>