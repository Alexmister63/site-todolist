<?php
include ("../controleur/AffUser.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="PageConnexion.css"/>
</head>
<body>

<div class="menu">
    <nav>
        <a class="lien" href="PageAccueil.php" >Retour Accueil</a>
    </nav>
    <div class="decobouton">
        <button class="champ" name="deconnexion" value="deconnexion">DECONNEXION</button>
    </div>
</div>

<form class="form" method="post">
    <fieldset>

        <legend>Inscription</legend>
        <div class="label">Nom</div>
        <div class="champ">
            <input type="text" name="NomI" required />
        </div>
        <div class="label">Prénom</div>
        <div class="champ">
            <input type="text" name="PrenomI" required />
        </div>
        <div class="label">E-mail</div>
        <div class="champ">
            <input type="email" name="EmailI" required />
        </div>
        <div class="label">Mot De Passe</div>
        <div class="champ">
            <input type="password" name="MDPI" required />
        </div>

        <div class="champ">
            <input type="submit" class="valider" name="Inscription" value="Inscription" />
        </div>
    </fieldset>
</form>
<br>
<?php echo $message1 ?>
<br>
<form class="form" method="post" >
    <fieldset>
        <legend>Connexion</legend>
        <div class="label">E-mail</div>
        <div class="champ">
            <input type="email" name="EmailC" required/>
        </div>
        <div class="label">Mot De Passe</div>
        <div class="champ">
            <input type="password" name="MDPC" required/>
        </div>

        <div class="champ">
            <input type="submit" class="valider" name="Connexion" value="Connexion" />
        </div>
    </fieldset>
</form>
</body>
</html>
