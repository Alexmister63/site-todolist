<?php
//require


//déclaration des éléments important de la page



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="PageAccueil.css">
    <title>To do list</title>
</head>


<body>
    <div class="menu">
        <nav>
              <a class="lien" href="PageConnexion.php" >Connexion</a>
        </nav>

    </div>
    <form method="post" >
    <div class="container">
        <header class="text-center text-light my-4">
            <h1 >Todo List</h1>
        </header>


            <?php
                include('../controleur/AffListe.php');

                echo $affichage;

            ?>




            <label class="text-light">Ajouter une Liste</label>
            <div class="champ">
                <input type="text" class="form-control m-auto" name="NomListe" />
            </div>


        <div class="champ">
            <input type="submit" name="validerListe" value="Ajout Liste" />
        </div>
        <?php  echo $messageListe ?>
    </div>
    </form>
</body>

</html>