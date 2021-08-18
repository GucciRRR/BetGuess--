<!-- DB / Header -->
<?php
    require 'data/config.data.php';
    require 'includes/header.php';

    //Requête pour récupérrer toutes les news
    $news = $conn->query("SELECT * FROM news");
    $news->execute();
    $row = $news->fetchAll();

    $img_path = "/resources/imgs/news/";
?>

<!-- CSS -->  
<link rel="stylesheet" href="resources/css/index.css">

<link rel="stylesheet" href="resources/css/rank.css">

<title>BetGuess - Acceuil</title>

<htlm>
    <body>
        <div id="new">
        <?php   if(isset($_GET['id'])) { //Si il y'a un ID dans l'url ->
                    foreach($row as $news) {

                        $new_id = $news['id'];
                        $titre = $news['titre'];
                        $article = $news['article'];

                            if($_GET['id'] == $new_id) { //Vérifie que l'ID de l'url est égale a un ID de new

                                echo "<center><strong><h3>" . $titre . "</h3></strong></center><br>";

                                echo $article;
                            }
                        }
                    } ?>
        </div>
    </body>
</htlm>