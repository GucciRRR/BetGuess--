<?php
    // DB
    require 'data/config.data.php';

    //Formulaire de connection
    if(isset($_POST['form_loggin'])) {

        $username_c = ($_POST['username_c']);
        $mdp_c = ($_POST['mdp_c']);

        if(!empty($username_c) AND !empty($mdp_c)) { //Vérif si les champs ne sont pas vide

            $checkuser = $conn->prepare("SELECT * FROM users WHERE username = ?"); //Vérif si le nom d'utilisateur entré dans le champ existe dans la base de donné
            $checkuser->execute(array($username_c));
            $result = $checkuser->fetch();

                if($result && password_verify($_POST['mdp_c'], $result['password'])) {
                    
                    session_start();
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['admin'] = $result['admin'];
                    header("Location: index.php");
                }
                else {
                    $erreur = "Nom d'utilisateur ou mot de passe incorrect";
                }
        }
        else {
            $erreur = "Les champs doivent être rempli.";
        }
    }

    // Après la function header pour éviter les bugs
    require 'includes/header.php';
?>

<link rel="stylesheet" href="resources/css/login.css">


<html>
    <body>
        <title>BetGuess - S'identifier</title>

        <form method="POST" action="">

        <!-- Username -->
        <center>
        <div class="username">
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" id="user">Nom d'utilisateur</span>
            <input type="text" class="form-control" placeholder="JeSuisMajeur" aria-label="Username" aria-describedby="user" name="username_c">
        </div>
        </div><br>

        <!-- Mot de passe -->
        <div class="MDP">
        <div class="input-group mb-3">
            <span class="input-group-text" id="mdp">Mot de passe</span>
            <input type="password" class="form-control" placeholder="••••••••••" aria-label="Password" aria-describedby="mdp" name="mdp_c">
        </div>
        </div><br>
        
            <button type="submit" name="form_loggin" class="btn btn-secondary">C'est parti!</button>

        </form>

        <?php
        if(isset($erreur)) {
        echo '<font color="red">'.$erreur . "</font>";
        }
        ?>

    </body>
</html>