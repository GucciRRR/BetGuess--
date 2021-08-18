<!-- DB / Header -->
<?php 
    require '../data/config.data.php';
    require '../includes/header_sports.php';

    $temps = $conn->query("SELECT CURRENT_TIMESTAMP");

    $handballB = $conn->query("SELECT * FROM matchs WHERE sport_id =  3 AND date >= CURRENT_TIMESTAMP");
    $handballB->execute();
    $row = $handballB->fetchAll();


    //Redirection si non connecter
    if($_SESSION['id'] == NULL) {
        header("Location: ../index.php");
    }
?>

<link rel="stylesheet" href="../resources/css/basket.css">

<title>BetGuess - Basket</title>

<html>
    <body>
        <center>    
        <br><h3>Basket!</h3> <br>

        <h5>Paris sur les matchs du championnat de France de Basket-Ball.<br><br>Selectionne tes pronostiques pour les matchs du jour.</h5><br>

        <?php foreach($row as $matchbasket) {
            $id = $matchbasket['id'];
            $domicile = $matchbasket['dom'];
            $exterieur = $matchbasket['ext']; ?>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="box-basket">
                                <button name="ConfBTNDom" type="submit" data-toggle="modal" data-target="#ConfirmationModalDom<?php echo $id ?>"><?php echo $domicile ?></button>
                            </div>
                            <div class="box-basket">
                                <button name="ConfBTNExt" type="submit" data-toggle="modal" data-target="#ConfirmationModalExt<?php echo $id ?>"><?php echo $exterieur ?></button>
                            </div>
                        </div>
                    </div>
                    

        <!-- Confirmation Victoire Domicile -->
        <form methode="GET" action="">
        <?php 
            $match_id = $id;
            $user_id = $_SESSION['id'];

            $checkbetD = $conn->prepare("SELECT * FROM bets WHERE `match_id` = ? AND `user_id` = ? AND `victoire_dom` IS NOT NULL");
            $checkbetD->execute(array($match_id, $user_id));
            $checkbetDD = $checkbetD->rowCount();

            if($checkbetDD == 0) { ?>
                <div class="modal fade" id="ConfirmationModalDom<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="ConfirmationModalDom" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ConfirmationModalDom">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                Confirmez vous votre pronostique <br>"<strong>Victoire <?php echo  $domicile ?></strong>" pour le match<br> <?php echo $domicile ?> - <?php echo $exterieur ?>?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" name="bet" value="vic_dom" onclick="valid_dom()" class="btn btn-light">Valider</button>
                                <input type="hidden" name="dom" value="<?php echo $id ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } 

                else { ?>
                    <div class="modal fade" id="ConfirmationModalDom<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="ConfirmationModalDom" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ConfirmationModalDom">Oops!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    Vous avez déjà un pronostique pour le match<br> <?php echo $domicile ?> - <?php echo $exterieur ?>.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                </div>
               <?php } ?>
        </form>

        <!-- Confirmation Victoire Extérieur -->
        <form methode="GET" action="">
        <?php 
            $match_id = $id;
            $user_id = $_SESSION['id'];

            $checkbetE = $conn->prepare("SELECT * FROM bets WHERE `match_id` = ? AND `user_id` = ? AND `victoire_ext` IS NOT NULL");
            $checkbetE->execute(array($match_id, $user_id));
            $checkbetEE = $checkbetE->rowCount();

            if($checkbetDD == 0) { ?>
                <div class="modal fade" id="ConfirmationModalExt<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="ConfirmationModalExt" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ConfirmationModalExt">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                Confirmez vous votre pronostique <br>"<strong>Victoire <?php echo $exterieur ?></strong>" pour le match<br> <?php echo $domicile ?> - <?php echo $exterieur ?>?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" name="bet" value="vic_ext" onclick="valid_ext()" class="btn btn-light">Valider</button>
                                <input type="hidden" name="ext" value="<?php echo $id ?>"/>
                            </div>
                        </div>
                    </div>
                </div> 
                <?php }

                else { ?>
                    <div class="modal fade" id="ConfirmationModalExt<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="ConfirmationModalExt" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ConfirmationModalExt">Oops!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    Vous avez déjà un pronostique pour le match<br> <?php echo $domicile ?> - <?php echo $exterieur ?>.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                </div>
               <?php } ?>
        </form>
        <?php } ?>

        <script>
            //Function onClick domicile
            function valid_dom() {
                <?php

                    $match_id = $_GET['dom']; 
                    $user_id = $_SESSION['id'];

                    if($user_id != NULL) {
                        $checkbet = $conn->prepare("SELECT * FROM bets WHERE `match_id` = ? AND `user_id` = ?");
                        $checkbet->execute(array($match_id, $user_id));
                        $checkbetB = $checkbet->rowCount();

                        if($checkbetB == 0) {
                            $valid = $conn->prepare("INSERT INTO bets(`match_id`, `user_id`, `victoire_dom`) VALUES ($match_id, $user_id, 1)");
                            $valid->execute();
                        }
                    }?>
                }

                //Function onClick extérieur
                function valid_nul() {
                <?php

                    $match_id = $_GET['ext']; 
                    $user_id = $_SESSION['id'];

                    if($user_id != NULL) {
                        $checkbet = $conn->prepare("SELECT * FROM bets WHERE `match_id` = ? AND `user_id` = ?");
                        $checkbet->execute(array($match_id, $user_id));
                        $checkbetB = $checkbet->rowCount();

                        if($checkbetB == 0) {
                            $valid = $conn->prepare("INSERT INTO bets(`match_id`, `user_id`, `victoire_ext`) VALUES ($match_id, $user_id, 1)");
                            $valid->execute();
                        }
                    }?>
                }
        </script>
    </body>
</html>