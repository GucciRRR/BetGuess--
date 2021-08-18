<!-- DB / Header -->
<?php
    require 'data/config.data.php';
    require 'includes/header.php';

    if(isset($_GET['id']) AND $_GET['id'] > 0) {

        $getid = $_GET['id'];
        
        $getuser = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $getuser->execute(array($getid));
        $userinfo = $getuser->fetch();
    }
?>

<!-- A completer ou a supprimer -->

<link rel="stylesheet" href="resources/css/profile.css">
<script src="resources/js/chart.js"></script>
<title>BetGuess - <?php echo $userinfo['username'] ?></title>

<html>
    <body>
        <div class="Username"><center>
        <h2><?php echo $userinfo['username'] ?></h2>
        </div>

        <div class="profile-pic"><center>
        <img src="resources/imgs/profile.png" width="240" height="180">
        </div>

        <div class="StatGeneral"><center>
        <h5>Statistique Générale</h5>
        </div>
    </body>
</html>