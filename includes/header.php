<?php
session_start();
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="resources/css/header.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="jquery/jquery.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/e971e1d66f.js" crossorigin="anonymous"></script>
    </head>
   <body>
       
       <img class="logo" src="../resources/imgs/logo.png">

        <nav class="navbar navbar-expand-lg">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse" id="nav" style="background: #cfcfcf">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active link-secondary" aria-current="page" href="index.php"><i class="fas fa-home"></i>  Acceuil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-secondary" href="actu.php"><i class="fas fa-newspaper"></i>  Actualité</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-secondary" href="rank.php"><i class="fab fa-hackerrank"></i>  Classement</a>
                </li>

                <?php if(isset($_SESSION['id']) && $_SESSION['id'] >= 1) {?>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle  link-secondary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class='fas fa-basketball-ball'></i>  Sport
                    </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: #cfcfcf;">
                <li><a class="dropdown-item link-secondary" href="/sports/football.php">Football</a></li>
                <li><a class="dropdown-item link-secondary" href="/sports/handball.php">Handball</a></li>
                <li><a class="dropdown-item link-secondary" href="/sports/basket.php">Basket</a></li>
                </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-secondary" href="bet.php"><i class="fas fa-award"></i> Mes paris</a>
                </li>
                <?php } ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['id']) && $_SESSION['id'] >=1): ?>
                    <span class="navbar-text">Hello <?php echo $_SESSION['username']."!" ?></span>
                    <li class="nav-item">
                        <a class="nav-link link-secondary" href="logout.php"><i class="fas fa-sign-out-alt"></i>  Déconnexion</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link link-secondary" href="register.php"><i class="fas fa-sign"></i>  Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-secondary" href="login.php"><i class="fas fa-sign-in-alt"></i>  S'identifier</a>
                    </li>
                </ul>
                <?php endif ?>
                </div>
            </div>
        </nav>
    </body>
</html>
