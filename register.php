<!-- Declaration DB / Header -->
<?php 
    require 'data/config.data.php';
    require 'includes/header.php';

    if(isset($_POST['form_inscription'])) {

        //Sécurité et encryptage des mdps
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = ($_POST['mdp']);
        $mdpc = ($_POST['mdpc']);

        $hashed = password_hash($mdp, PASSWORD_DEFAULT);

        //Vérification si les champs ne sont pas vide
        if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['mdpc'])) {

            //Longeur max des variables + vérification
            $username_max = strlen($username);
            $username_min = strlen($username);
            $mdp_min = strlen($mdp);
            $mdpc_min = strlen($mdpc);

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) { //Vérification si l'email est valide

                $checkuser = $conn->prepare("SELECT * FROM users WHERE username = ?");
                $checkuser->execute(array($username));
                $checkexistU = $checkuser->rowCount();
                if($checkexistU == 0) { //Si le nom d'utilisateur n'est pas déjà utilisé ->

                    if($username_max <= 16 AND $username_min >= 8) { //Si le nom d'utilisateur est inférieur ou égale a 16 characters et suppérieur ou égale a 8 ->

                        $checkmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
                        $checkmail->execute(array($email));
                        $checkexistM = $checkmail->rowCount();
                        if($checkexistM == 0) { //Si l'email n'est pas utilisé ->

                        if($mdp_min >= 8) { //Si le mot de passe est suppérieur ou égale a 8 character

                            if($mdpc_min >= 8) { //Si la confimation du mot de passe est suppérieur ou égale a 8 character

                                if($mdp == $mdpc) { //Vérifi si les deux mots de passe sont identique

                                    $inscription = $conn->prepare("INSERT INTO users(username, password, email) VALUES (?, ?, ?)");
                                    $inscription->execute(array($username,$hashed,$email)); //Enregistre l'utilisateur
                                    header("Location: index.php");
                                }
                                else {
                                    $erreur = "Les mots de passe ne correspondent pas!";
                                }
                            }
                            else {
                                $erreur = "Mot de passe trop court! Min 8 characters.";
                            }
                        }
                        else {
                            $erreur = "Mot de passe trop court! Min 8 characters.";
                        }
                    }
                    else {
                        $erreur = "Adresse email déjà utilisé!";
                    }
                    }
                    else {
                        if($username_min <= 8) {
                        $erreur = "Nom d'utilisateur trop court! Min 8 characters."; }
                        if($username_max >= 16) {
                        $erreur = "Nom d'utilisateur trop long! Max 16 characters."; }
                    }
                }
                else {
                    $erreur = "Nom d'utilisateur déjà utilisé!";
                }
                }
                else{
                    $erreur = "Adresse email non valide.";
                }
            
            }
        else {
            $erreur = "Les champs ne sont pas tous remplis!";
        }
    }
?>

<link rel="stylesheet" href="resources/css/register.css">

<html>
    <head>

        <title>BetGuess - Inscription</title>

    </head>
        <body>

        <!-- Formulaire d'enregistrement -->
        <center>
        <form method="POST" action="">
        <div class="username">
        <div class="input-group mb-3">
            <span class="input-group-text" id="user">Nom d'utilisateur</span>
            <input type="text" class="form-control" name="username" placeholder="JeSuisMajeur" aria-label="Username" aria-describedby="user" value="<?php if(isset($username)) { echo $username;} ?>">
        </div>
        </div><br>

        <div class="email">
        <div class="input-group mb-3">
            <span class="input-group-text" id="email">Adresse email</span>
            <input type="email" class="form-control" name="email" placeholder="exemple@betguess.fr" aria-label="Email" aria-describedby="email" value="<?php if(isset($email)) { echo $email;} ?>">
        </div>
        </div><br>

        <div class="MDP">
        <div class="input-group mb-3">
            <span class="input-group-text" id="pass">Mot de passe</span>
            <input type="password" class="form-control" name="mdp" placeholder="••••••••••" aria-label="Password" aria-describedby="pass">
        </div>
        </div><br>
        
        <div class="MDPC">
        <div class="input-group mb-3">
            <span class="input-group-text" id="passc">Confirmation</span>
            <input type="password" class="form-control" name="mdpc" placeholder="••••••••••" aria-label="Password" aria-describedby="passc">
        </div>
        </div><br>
        
            <button type="submit" name="form_inscription" class="btn btn-secondary">C'est parti!</button>

        </form>

    <?php
    if(isset($erreur)) {
        echo '<font color="red">'.$erreur . "</font>";
    }
    ?>

    </body>
</html>