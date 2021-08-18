<!-- DB / Header -->
<?php
    require 'data/config.data.php';
    require 'includes/header.php';

    //Requête pour le carousel
    $news = $conn->query("SELECT * FROM news WHERE carousel = 1 LIMIT 3");
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
        <!-- Carousel de new -->
        <div id="newSlider" class="carousel slide" data-ride ="carousel">
          <ol class="carousel-indicators">
            <li data-target="#newSlider" data-slide-to="0" class="active"></li>
            <li data-target="#newSlider" data-slide-to="1"></li>
          </ol>

          <div class="carousel-inner">
            <div class="carousel-item active" style="background-image:url(<?php echo $img_path . $row[0]['imgs'] ?>);">
                <div class="container">
                  <h1><strong><?php echo $row[0]['titre'] ?></strong></h1>
                  <h6><?php echo $row[0]['descp'] ?></h6>
                  <a href="new.php?id=<?php echo $row[0]['id']?>"><button type="input" name="btn1" class="btn btn-lg btn-primary"><?php echo $row[0]['btn'] ?></button></a>
                </div>
            </div>

            <div class="carousel-item" style="background-image:url(<?php echo $img_path . $row[1]['imgs'] ?>)">
                <div class="container">
                  <h1><strong><?php echo $row[1]['titre'] ?></strong></h1>
                  <h6><?php echo $row[1]['descp'] ?></h6>
                  <a href="new.php?id=<?php echo $row[1]['id']?>"><button type="input" class="btn btn-lg btn-primary"><?php echo $row[1]['btn'] ?></button></a>
                </div>
            </div>

            <div class="carousel-item" style="background-image:url(<?php echo $img_path . $row[2]['imgs'] ?>)">
                <div class="container">
                  <h1><strong><?php echo $row[2]['titre'] ?></strong></h1>
                  <h6><?php echo $row[2]['descp'] ?></h6>
                  <a href="new.php?id=<?php echo $row[2]['id']?>"><button type="input" class="btn btn-lg btn-primary"><?php echo $row[2]['btn'] ?></button></a>
                </div>
            </div>
          </div>

          <a href="#newSlider" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="sr-only">Précédent</span>
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </a>

          <a href="#newSlider" class="carousel-control-next" role="button" data-slide="next">
            <span class="sr-only">Suivant</span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
        </div>

          <!-- Box info-->
          <div class="servive-block servive-block-grey">
            <h2 class="heading-md">Bienvenue sur BetGuess!</h2><br>
            <h5><a>BetGuess est un site de pronostiques sportif, <br> Tu peut donc donner ton prono sur les matchs sélectionner par l'équipe de BetGuess! <br>
            <br>Ci dessous et rien que pour toi voici les matchs les plus pronostiqué de la semaine.</h5>
            </div>

        <!-- Paris populaire -->
        <center>
                  <div class="row margin-bottom-10">

                  <br><h3>Matchs les plus populaire!</h3><br>

                  <!-- Football -->
                  <div class="col-md-4 col-sm-6">
                  <div class="servive-block servive-block-grey">
                      <i class="icon-2x color-light fa fa-futbol"></i>
                      <h2 class="heading-md">Football</h2>
                      <h6><a>Paris Saint-Germain - Bordeaux</a><br><br>
                      <a>Lorient - Clermont</a><br></h6>
                  </div>
                  </div>

                  <!-- Handball -->
                  <div class="col-md-4 col-sm-6">
                  <div class="servive-block servive-block-grey">
                      <i class="icon-2x color-light fas fa-volleyball-ball"></i>
                      <h2 class="heading-md">Handball</h2>
                      <h6><a>Brest - Lorient</a><br><br>
                      <a>Boulogne - Paris Saint-Germain</a><br></h6>
                  </div>
                  </div>
                      
                  <!-- Basket -->
                  <div class="col-md-4 col-sm-12">
                  <div class="servive-block servive-block-grey">            
                      <i class="icon-2x color-light fas fa-basketball-ball"></i>
                      <h2 class="heading-md">Basket</h2>
                      <h6><a>Orléans - Chalon-Sur-Saône</a><br><br>
                      <a>Limoge - Le Mans</a><br><br>
                      <a>Dijon - Le Portel</a><br></h6>
                  </div>
                  </div>
                  </div>
        </center>
    </body>
</htlm>