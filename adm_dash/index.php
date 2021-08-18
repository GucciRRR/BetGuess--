<?php 
    require '../data/config.data.php';

    //Formulaire de connection
    if(isset($_POST['form_loggin'])) {

        $username_c = ($_POST['username_c']);
        $mdp_c = ($_POST['mdp_c']);

        if(!empty($username_c) AND !empty($mdp_c)) {

            $checkuser = $conn->prepare("SELECT * FROM users WHERE username = ? AND admin = 1");
            $checkuser->execute(array($username_c));
            $result = $checkuser->fetch();

                if($result && password_verify($_POST['mdp_c'], $result['password'])) {
                    
                    session_start();
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['admin'] = $result['admin'];
                    header("Location: dash.php");
                }
                else {
                    $erreur = "Vous n'êtes pas administrateur.";
                }
        }
        else {
            $erreur = "Les champs doivent être rempli.";
        }
    }
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<title> Admin - Connection </title>

<html>
    <body>
        <form method="POST" action="">

            <div class="Username">
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Nom d'utilisateur</span>
            </div>
                <input type="text" class="form-control" placeholder="Admin" aria-label="Username" aria-describedby="basic-addon1" name="username_c">
            </div>
            </div>

            <div class="MDP">
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Mot de passe</span>
            </div>
                <input type="password" class="form-control" placeholder="••••••••••" aria-label="Password" aria-describedby="basic-addon1" name="mdp_c">
            </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                Se souvenir de moi!
            </label>
            </div>

            <button type="submit" name="form_loggin" class="btn btn-secondary">C'est parti!</button>
        </form>

            <?php
            if(isset($erreur)) {
            echo '<font color="red">'.$erreur . "</font>";
            }
            ?>

    </body>
</html>