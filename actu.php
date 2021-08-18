<!-- DB / Header -->
<?php 
    require 'data/config.data.php';
    require 'includes/header.php';

    $actu = $conn->prepare("SELECT * FROM news LIMIT 7");
    $actu->execute();
    $row = $actu->fetchAll();

    $img_path = "/resources/imgs/news/";
?>

<title>BetGuess - Actualités </title>

<!-- CSS -->

<link rel="stylesheet" href="resources/css/actu.css">

<html>
    <head>
        <div class="container">
            <div class="row" id="1er">

                <div class="col">
                        <a href="new.php?id=<?php echo $row[0]['id']?>">
                        <img src="<?php echo $img_path . $row[0]['imgs'] ?>" class="img-thumbnail" alt="#">
                        <div class="overlay overlay--blur">
                        <div class="titre"> <p><?php echo $row[0]['titre'] ?></p> </div>
                        <div class="descp"> <p><?php echo $row[0]['descp'] ?></p> </div>
                    </div>
                    </a>
                </div>

                <div class="col">
                        <a href="new.php?id=<?php echo $row[1]['id']?>">
                        <img src="<?php echo $img_path . $row[1]['imgs'] ?>" class="img-thumbnail" alt="#">
                        <div class="overlay overlay--blur">
                        <div class="titre"> <p><?php echo $row[1]['titre'] ?></p> </div>
                        <div class="descp"> <p><?php echo $row[1]['descp'] ?></p> </div>
                    </div>
                    </a>
                </div>
            </div>


            <div class="row" id="2eme">

                <div class="col">
                        <a href="new.php?id=<?php echo $row[2]['id']?>">
                        <img src="<?php echo $img_path . $row[2]['imgs'] ?>" class="img-thumbnail" alt="#">
                        <div class="overlay overlay--blur">
                        <div class="titre"> <p><?php echo $row[2]['titre'] ?></p> </div>
                        <div class="descp"> <p><?php echo $row[2]['descp'] ?></p> </div>
                    </div>
                    </a>
                </div>

                <div class="col">
                        <a href="new.php?id=<?php echo $row[3]['id']?>">
                        <img src="<?php echo $img_path . $row[3]['imgs'] ?>" class="img-thumbnail" alt="#">
                        <div class="overlay overlay--blur">
                        <div class="titre"> <p><?php echo $row[3]['titre'] ?></p> </div>
                        <div class="descp"> <p><?php echo $row[3]['descp'] ?></p> </div>
                    </div>
                    </a>
                </div>

                <div class="col">
                        <a href="new.php?id=<?php echo $row[4]['id']?>">
                        <img src="<?php echo $img_path . $row[4]['imgs'] ?>" class="img-thumbnail" alt="#">
                        <div class="overlay overlay--blur">
                        <div class="titre"> <p><?php echo $row[4]['titre'] ?></p> </div>
                        <div class="descp"> <p><?php echo $row[4]['descp'] ?></p> </div>
                    </div>
                    </a>
                </div>
            </div>


            <div class="row" id="3eme">

                <div class="col">
                        <a href="new.php?id=<?php echo $row[5]['id']?>">
                        <img src="<?php echo $img_path . $row[5]['imgs'] ?>" class="img-thumbnail" alt="#">
                        <div class="overlay overlay--blur">
                        <div class="titre"> <p><?php echo $row[5]['titre'] ?></p> </div>
                        <div class="descp"> <p><?php echo $row[5]['descp'] ?></p> </div>
                    </div>
                    </a>
                </div>

                <div class="col">
                        <a href="new.php?id=<?php echo $row[6]['id']?>">
                        <img src="<?php echo $img_path . $row[6]['imgs'] ?>" class="img-thumbnail" alt="#">
                        <div class="overlay overlay--blur">
                        <div class="titre"> <p><?php echo $row[6]['titre'] ?></p> </div>
                        <div class="descp"> <p><?php echo $row[6]['descp'] ?></p> </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </head>
</html>