<?php 

    require '../data/config.data.php';
    
    $users = $conn->query("SELECT * FROM news");
    $users->execute();
    $row = $users->fetchAll();

    session_start();

    if($_SESSION['admin'] == 0) {

        header("Location: ../index.php");
    }

    //Formulaire ajout d'une new
    if(isset($_POST['addnew'])) {

        $titre = ($_POST['titre']);
        $desc = ($_POST['desc']);
        $btn = ($_POST['btnnew']);
        $img = ($_FILES['upload']);
        $article = ($_POST['article']);

        //Upload image new
        $nom = $_FILES['upload']['name'];
        $tmp = $_FILES['upload']['tmp_name'];

        move_uploaded_file($tmp, '../resources/imgs/news/'. $nom);

        if(!empty($titre) AND !empty($desc) AND !empty($btn) AND !empty($img) AND !empty($article)) {

            $ajout = $conn->prepare("INSERT INTO news(titre, descp, article, btn, imgs) VALUES (?, ?, ?, ?, ?)");
            $ajout->execute(array($titre,$desc,$article,$btn,$nom));

            $ajout_new = "La new a été ajouter.<br>";
        }

        else {
            $erreur = "Vous devez remplir tout les champs.<br>";
        }
    }

    //Formulaire edition New
    if(isset($_POST['edit_new'])) {
        
        $id = $_POST['id'];
        $titre = $_POST['titre'];
        $desc = $_POST['desc'];
        $btn = $_POST['btn'];
        $article = $_POST['article'];
        $img = $_POST['img'];
        $carousel = $_POST['carousel'];

        $edit = $conn->prepare("UPDATE news SET titre = ?, descp = ?, article = ?, btn = ?, imgs = ?, carousel = ? WHERE id = ?");
        $edit->execute(array($titre,$desc,$article,$btn,$img,$carousel,$id));
    }

    if(isset($_POST['delete_new'])) {
        
        $id = $_POST['id'];

        $delete = $conn->prepare("DELETE FROM news WHERE id = ?");
        $delete->execute(array($id));
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

        <!-- Formulaire d'enregistrement d'une nouvelle new -->
        <div class="container"><br><br><h5>Ajout d'une news</h5><br>
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm">
                    <input type="text" class="form-control w-50" id="titre" placeholder="Titre de la new" name="titre">
                    </div>
                    <div class="col-sm">
                    <input type="text" class="form-control w-50" id="desc" placeholder="Description de la new" name="desc">
                    </div>
                    <div class="col-sm">
                    <input type="text" class="form-control w-50" id="btn" placeholder="Boutton de la new" name="btnnew"><br>
                    </div>
                </div>

                <div class="row">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="upload">
                        <label class="custom-file-label" for="inputGroupFile01">Choisir l'image de la new</label>
                    </div>

                </div> <br>
                <textarea id="summernote" name="article"></textarea> <br>

                <?php
                    if(isset($ajout_new)) {
                        echo '<br><br><font color="green">'.$ajout_new . "</font>";
                } 
                    if(isset($erreur)) {
                        echo '<br><br><font color="red">'.$erreur . "</font>";
                } ?>

                <button type="submit" name="addnew" class="btn btn-secondary">Ajouter la new</button>
                <input type="hidden" name="new" value="add"/>
                </form>
                <script>
                    $(document).ready(function() {
                    $('#summernote').summernote({
                        height: 450,
                        minHeight: null,
                        maxHeight: null});
                    });
                </script>
        </div>
            <!-- Liste des news -->
            <br><div id="gestion_new"><h5>Liste des news</h5><br>
            <table class="table w-75">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Boutton</th>
                    <th scope="col">Article</th>
                    <th scope="col">Image</th>
                    </tr>
                </thead>

                <?php foreach($row as $newlist) { 
                    
                    $idN = $newlist['id'];
                    $titreN = $newlist['titre'];
                    $descN = $newlist['descp'];
                    $articleN = $newlist['article'];
                    $btnN = $newlist['btn'];
                    $imgN = $newlist['imgs']; 
                    $carousel = $newlist['carousel']; ?>
                <tbody>
                    <tr>
                    <th scope="row"><?php echo $idN ?></th>
                    <td><?php echo $titreN ?></td>
                    <td><?php echo $descN ?></td>
                    <td><?php echo $btnN ?></td>
                    <td   style="max-width:100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><?php echo $articleN ?></td>
                    <td><?php echo $imgN ?></td>
                    <td><button id="edit" class="btn btn-primary" data-toggle="modal" data-target="#EditNew<?php echo $idN ?>">Modifier</button></td>
                    
                    <!-- Modal edition d'une new -->
                    <div class="modal fade" id="EditNew<?php echo $idN ?>" tabindex="-1" role="dialog" aria-labelledby="EditNew" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditNew<?php echo $idN ?>">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="" method="POST">
                                <div class="modal-body"> 1 = Oui / 0 = Non
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="carousel">Carousel?</span>
                                    </div>
                                    <input name="carousel" type="text" class="form-control" aria-describedby="carousel" value="<?php echo $carousel ?>">
                                    </div>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="id" hidden>ID</span>
                                    </div>
                                    <input name="id" type="text" class="form-control" aria-describedby="id" value="<?php echo $idN ?>" hidden>
                                    </div>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="Titre">Titre</span>
                                    </div>
                                    <input name="titre" type="text" class="form-control" aria-describedby="Titre" value="<?php echo $titreN ?>">
                                    </div>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="Description">Description</span>
                                    </div>
                                    <input name="desc" type="text" class="form-control" aria-describedby="Description" value="<?php echo $descN ?>">
                                    </div>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="Boutton">Boutton</span>
                                    </div>
                                    <input name="btn" type="text" class="form-control" aria-describedby="Boutton" value="<?php echo $btnN ?>">
                                    </div>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="Article">Article</span>
                                    </div>
                                    <input name="article" type="text" class="form-control" aria-describedby="Article" value="<?php echo $articleN ?>">
                                    </div>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="Image">Image</span>
                                    </div>
                                    <input name="img" type="text" class="form-control" aria-describedby="Image" value="<?php echo $imgN ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" name="edit_new" class="btn btn-light">Valider</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <td>

                    <!-- Suppression d'une new -->
                    <button id="delete" class="btn btn-danger" data-toggle="modal" data-target="#DeleteNew<?php echo $idN ?>">Suprimer</button></td>
                    <div class="modal fade" id="DeleteNew<?php echo $idN ?>" tabindex="-1" role="dialog" aria-labelledby="DeleteNew" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteNew<?php echo $idN ?>">Supprimer!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form method="POST">
                                    <div class="modal-body">
                                        <input name="id" type="text" class="form-control" aria-describedby="id" value="<?php echo $idN ?>" hidden>
                                        Voulez-vous vraiment supprimer la new?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="submit" name="delete_new" class="btn btn-light">Valider</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            </div>
    </body>
</html>