<?php 

    require '../data/config.data.php';

    //Requête liste des matchs
    $listM = $conn->query("SELECT * FROM matchs");
    $listM->execute();
    $rowM = $listM->fetchAll();
    
    //Requête Equipe Foot
    $equipeF = $conn->query("SELECT * FROM equipes WHERE sport_id = 1");
    $equipeF->execute();
    $rowF = $equipeF->fetchAll();

    //Requête Equipe Hand
    $equipeH = $conn->query("SELECT * FROM equipes WHERE sport_id = 2");
    $equipeH->execute();
    $rowH = $equipeH->fetchAll();

    //Requête Equipe Basket
    $equipeB = $conn->query("SELECT * FROM equipes WHERE sport_id = 3");
    $equipeB->execute();
    $rowB = $equipeB->fetchAll();

    session_start();

    if($_SESSION['admin'] == 0) {

        header("Location: ../index.php");
    }

    //Formulaire ajout de match
    if(isset($_POST['addmatch'])) {

        $sport_id = $_POST['sport_id'];
        $eqF = $_POST['eq_foot']; $eqF2 = $_POST['eq_foot2'];
        $eqH = $_POST['eq_hand']; $eqH2 = $_POST['eq_hand2'];
        $eqB = $_POST['eq_basket']; $eqB2 = $_POST['eq_basket2'];
        $date = $_POST['date'];

        //Verif si il n'y a pas déjà un match crée. (Foot)
        $checkF = $conn->prepare("SELECT * FROM matchs WHERE dom = ? AND ext = ? AND sport_id = 1");
        $checkF->execute(array($eqF,$eqF2));
        $countF = $checkF->rowCount();

        //Verif si il n'y a pas déjà un match crée. (HandBall)
        $checkH = $conn->prepare("SELECT * FROM matchs WHERE dom = ? AND ext = ? AND sport_id = 2");
        $checkH->execute(array($eqH,$eqH2));
        $countH = $checkH->rowCount();

        //Verif si il n'y a pas déjà un match crée. (Basket)
        $checkB = $conn->prepare("SELECT * FROM matchs WHERE dom = ? AND ext = ? AND sport_id = 3");
        $checkB->execute(array($eqB,$eqB2));
        $countB = $checkB->rowCount();
        
        if($eqF != $eqF2 & $date != NULL & $countF == 0) {

            //Ajoute le match
            $matchs = $conn->prepare("INSERT INTO matchs(dom, ext, `date`, sport_id) VALUES (?, ?, ?, ?)");
            $matchs->execute(array($eqF, $eqF2, $date, $sport_id));

            $match_id = $conn->lastInsertId();

            //Ajoute un résulta (Match non fini)
            $result = $conn->prepare("INSERT INTO result(match_id, r_victoire_dom, r_nul, r_victoire_ext) VALUES (?, 0, 0, 0)");
            $result->execute(array($match_id));

            $ajout = "Le match <strong>" . $eqF . " - " . $eqF2 . "</strong> a bien été ajouter";;
        }

        if($eqH != $eqH2 & $date != NULL & $countH == 0) {

            //Ajoute le match
            $matchs = $conn->prepare("INSERT INTO matchs(dom, ext, `date`, sport_id) VALUES (?, ?, ?, ?)");
            $matchs->execute(array($eqH, $eqH2, $date, $sport_id));

            $match_id = $conn->lastInsertId();

            //Ajoute un résulta (Match non fini)
            $result = $conn->prepare("INSERT INTO result(match_id, r_victoire_dom, r_nul, r_victoire_ext) VALUES (?, 0, 0, 0)");
            $result->execute(array($match_id));

            $ajout = "Le match <strong>" . $eqH . " - " . $eqH2 . "</strong> a bien été ajouter";;
        }

        if($eqB != $eqB2 & $date != NULL & $countB == 0) {

            //Ajoute le match
            $matchs = $conn->prepare("INSERT INTO matchs(dom, ext, `date`, sport_id) VALUES (?, ?, ?, ?)");
            $matchs->execute(array($eqB, $eqB2, $date, $sport_id));

            $match_id = $conn->lastInsertId();

            //Ajoute un résulta (Match non fini)
            $result = $conn->prepare("INSERT INTO result(match_id, r_victoire_dom, r_nul, r_victoire_ext) VALUES (?, 0, 0, 0)");
            $result->execute(array($match_id));

            $ajout = "Le match <strong>" . $eqB . " - " . $eqB2 . "</strong> a bien été ajouter";;
        }
    }

    //Formulaire Edition Match
    if(isset($_POST['edit_match'])) {

        $victoire = $_POST['victoire'];

        if($victoire == "dom") {
            $match_id = $_POST['id'];
            
            $editMatch = $conn->prepare("UPDATE result SET r_victoire_dom = 1 WHERE match_id = ?");
            $editMatch->execute(array($match_id));
        }

        if($victoire == "nul") {
            $match_id = $_POST['id'];
            
            $editMatch = $conn->prepare("UPDATE result SET r_nul = 1 WHERE match_id = ?");
            $editMatch->execute(array($match_id));
        }

        if($victoire == "ext") {
            $match_id = $_POST['id'];
            
            $editMatch = $conn->prepare("UPDATE result SET r_victoire_ext = 1 WHERE match_id = ?");
            $editMatch->execute(array($match_id));
        }
    }

?>

<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<title>Admin - Panel</title>

<html>
    <body>
        <center><br>
        <a class="btn btn-secondary" href="dash.php">Liste des utilisateurs</a>
        <a class="btn btn-secondary" href="news.php">Gestion des news</a>
        <a class="btn btn-secondary" href="matchs.php">Gestion des matchs</a>

        <!-- Formulaire d'enregistrement d'un nouveau match -->
        <div class="container"><br><br><h5>Ajout d'un match</h5><br>
            <form method="POST">
                <div class="row">
                    <div class="col-sm">
                    <label>Sport</label>
                    <select class="form-control w-50" name="sport_id">
                        <option value="1">Football</option>
                        <option value="2">Handball</option>
                        <option value="3">Basket</option>
                    </select>
                    </div>
                    
                    <script>
                        $(document).ready(function() {
                            $('.sport_id').val('1');
                            $('select[name="sport_id"]').on('change', function() {
                                if($(this).val() == '1') {
                                    $('select[name="eq_foot"]').show();
                                    $('select[name="eq_foot2"]').show();
                                    $('select[name="eq_hand"]').hide();
                                    $('select[name="eq_hand2"]').hide();
                                    $('select[name="eq_basket"]').hide();
                                    $('select[name="eq_basket2"]').hide();
                                }
                                else if ($(this).val() == '2') {
                                    $('select[name="eq_hand"]').show();
                                    $('select[name="eq_hand2"]').show();
                                    $('select[name="eq_foot"]').hide();
                                    $('select[name="eq_foot2"]').hide();
                                    $('select[name="eq_basket"]').hide();
                                    $('select[name="eq_basket2"]').hide();
                                }
                                else if ($(this).val() == '3') {
                                    $('select[name="eq_basket"]').show();
                                    $('select[name="eq_basket2"]').show();
                                    $('select[name="eq_foot"]').hide();
                                    $('select[name="eq_foot2"]').hide();
                                    $('select[name="eq_hand"]').hide();
                                    $('select[name="eq_hand2"]').hide();
                                }
                            });
                        });
                    </script>

                    <div class="col-sm">
                    <label>Equipe domicile</label><br> <!-- Liste des équipes de football -->
                    <select class="form-control" name="eq_foot" style="max-width:55%">
                        <?php foreach($rowF as $equipeFoot) { ?>
                            <?php $nom = $equipeFoot['nom'] ?>
                        <option value="<?php echo $nom ?>"><?php echo $nom ?></option>
                        <?php } ?>
                    </select>

                    <select class="form-control" name="eq_hand" id="box-dom" style="max-width:65%"> <!-- Liste des équipes de handball -->
                        <?php foreach($rowH as $equipeHand) { ?>
                            <?php $nom = $equipeHand['nom'] ?>
                        <option value="<?php echo $nom ?>"><?php echo $nom ?></option>
                        <?php } ?>
                    </select>

                    <select class="form-control" name="eq_basket" id="box-dom" style="max-width:65%"> <!-- Liste des équipes de basket -->
                        <?php foreach($rowB as $equipeBasket) { ?>
                            <?php $nom = $equipeBasket['nom'] ?>
                        <option value="<?php echo $nom ?>"><?php echo $nom ?></option>
                        <?php } ?>
                    </select>
                    </div>

                    <div class="col-sm">
                    <label>Equipe extérieur</label><br>
                    <select class="form-control" name="eq_foot2" style="max-width:55%"> <!-- Liste des équipes de football -->
                        <?php foreach($rowF as $equipeFoot) { ?>
                            <?php $nom = $equipeFoot['nom'] ?>
                        <option value="<?php echo $nom ?>"><?php echo $nom ?></option>
                        <?php } ?>
                    </select>

                    <select class="form-control" name="eq_hand2" id="box-dom" style="max-width:65%"> <!-- Liste des équipes de handball -->
                        <?php foreach($rowH as $equipeHand) { ?>
                            <?php $nom = $equipeHand['nom'] ?>
                        <option value="<?php echo $nom ?>"><?php echo $nom ?></option>
                        <?php } ?>
                    </select>

                    <select class="form-control" name="eq_basket2" id="box-dom" style="max-width:55%"> <!-- Liste des équipes de basket -->
                    <?php foreach($rowB as $equipeBasket) { ?>
                            <?php $nom = $equipeBasket['nom'] ?>
                        <option value="<?php echo $nom ?>"><?php echo $nom ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>

                <style>#box-dom {display: none;}</style>

                <label>Date du match</label>
                <input type="datetime-local" class="form-control" name="date" style="max-width:20%"><br>

                <button type="submit" name="addmatch" class="btn btn-secondary">Ajouter le match</button>
                    <?php
                    if(isset($ajout)) {
                        echo '<br><br><font color="green">'.$ajout . "</font>";
                    } ?>
                <input type="hidden" name="match" value="add"/>
                </form>
        </div>

        <br><h5>Modifier résultat d'un match</h5><br>

        <input type="text" id="recherche" onkeyup="recherche()" placeholder="Chercher par sport">

        <script>
                function recherche() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("recherche");
                filter = input.value.toUpperCase();
                table = document.getElementById("matchs");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[3];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                        }
                    }
                }
            </script>

        <table class="table w-50" id="matchs">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Domicile</th>
                <th scope="col">Extérieur</th>
                <th scope="col">Date</th>
                <th scope="col">Sport</th>
                <th scope="col">Victoire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rowM as $listeMatch) { ?>
                <tr>
                <th scope="row"><?php echo $listeMatch['id']?></th>
                <td><?php echo $listeMatch['dom']?></td>
                <td><?php echo $listeMatch['ext']?></td>
                <td><?php echo $listeMatch['date']?></td>
                <td><?php if($listeMatch['sport_id'] == 1) { echo "Football" ;} 
                          if($listeMatch['sport_id'] == 2) { echo "Handball" ;}
                          if($listeMatch['sport_id'] == 3) { echo "Basket" ;}?></td>
                <td><?php     $gagnant = $conn->query("SELECT * FROM result");
                              $gagnant->execute();
                              $rowG = $gagnant->fetchAll(); 
                          foreach($rowG as $gagnants) {
                                if($listeMatch['id'] == $gagnants['match_id']) { 
                                    if($gagnants['r_victoire_dom'] == 0 & $gagnants['r_nul'] == 0 & $gagnants['r_victoire_ext'] == 0) { echo "Pas fini" ;}
                                    else if($gagnants['r_victoire_dom'] == 1 & $gagnants['r_nul'] == 0 & $gagnants['r_victoire_ext'] == 0) { echo "Domicile" ;}
                                    else if($gagnants['r_victoire_dom'] == 0 & $gagnants['r_nul'] == 1 & $gagnants['r_victoire_ext'] == 0) { echo "Nul" ;}
                                    else if($gagnants['r_victoire_dom'] == 0 & $gagnants['r_nul'] == 0 & $gagnants['r_victoire_ext'] == 1) { echo "Extérieur" ;}
                                }
                          } ?></td>

                <td><button id="edit" class="btn btn-primary" data-toggle="modal" data-target="#EditMatch<?php echo $listeMatch['id'] ?>">Modifier</button></td>

                <div class="modal fade" id="EditMatch<?php echo $listeMatch['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="EditMatch" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditMatch<?php echo $listeMatch['id'] ?>">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST">
                        <div class="modal-body">
                            <label>Gagnant du match :</label>
                            <select class="form-control" name="victoire" style="max-width:55%">
                                <option value="dom"><?php echo $listeMatch['dom'] ?></option>
                                <?php if($listeMatch['sport_id'] <= 2) { ?>
                                <option value="nul">Nul</option> <?php } ?>
                                <option value="ext"><?php echo $listeMatch['ext'] ?></option>
                            </select>
                            <input name="id" type="text" class="form-control" aria-describedby="id" value="<?php echo $listeMatch['id'] ?>" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" name="edit_match" class="btn btn-light">Valider</button>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>