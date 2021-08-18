<?php 

    require '../data/config.data.php';
    
    $users = $conn->query("SELECT * FROM users");
    $users->execute();
    $row = $users->fetchAll();
    $count = $users->rowCount();

    session_start();

    if($_SESSION['admin'] == 0) {

        header("Location: ../index.php");
    }
?>

<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<link rel="stylesheet" href="admin.css">

<title>Admin - Panel</title>

<html>
    <body>
        <center><br>
        <a class="btn btn-secondary" href="dash.php">Liste des utilisateurs</a>
        <a class="btn btn-secondary" href="news.php">Gestion des news</a>
        <a class="btn btn-secondary" href="matchs.php">Gestion des matchs</a>

        <div id="users"> <br>

            <input type="text" id="recherche" onkeyup="recherche()" placeholder="Chercher un utilisateur">
            <br><br>Nombre totaux d'utilisateurs : <?php echo $count ?>
                <table class="table" id="utilisateur">
                <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom d'utilisateur</th>
                <th scope="col" style="width:20%">Mot de passe</th>
                <th scope="col">Email</th>
                <th scope="col">Date d'enregistrement</th>
                <th scope="col">Administeur</th>

            <?php foreach($row as $gUsers) { 

                 $id = $gUsers['id'];
                 $username = $gUsers['username'];
                 $password = $gUsers['password'];
                 $email = $gUsers['email'];
                 $date = $gUsers['DateRegister'];
                 $admin = $gUsers['admin']; ?>

            </tr>
            </thead>
            <tbody>
            <tr>
            <th scope="row"><?php echo $id ?></th>
                <td><?php echo $username ?></td>
                <td><?php echo $password ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $date ?></td>
                <td><?php if($admin == 0) {echo "Non";} else if($admin == 1) {echo "Oui";}?></td>
            </tr>
            </tbody>
                <?php } ?>
            </table>
            <script>
                function recherche() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("recherche");
                filter = input.value.toUpperCase();
                table = document.getElementById("utilisateur");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
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
        </div>
    </body>
</html>