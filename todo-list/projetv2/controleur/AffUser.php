<?php
require('../modeles/GateWayUtilisateur.php');
require ('../config/config.php');
//Infos Inscription
@$nomIns=$_POST["NomI"];
@$prenomIns =$_POST["PrenomI"];
@$emailIns = $_POST["EmailI"];
@$mdpIns = $_POST["MDPI"];

//Infos Connection
@$emailCon = $_POST["EmailC"];
@$mdpCon = $_POST["MDPC"];

//Infos Validation
@$Connect =$_POST["Connexion"];
@$Inscript =$_POST["Inscription"];
$message1 = '';
$Affuse = new AffUser();

//deconnexion
@$sedeconnecter = $_POST["deconnexion"];


session_start();
if (isset($Inscript)){
    $message1 = $Affuse->ValidationInscription($nomIns,$prenomIns,$emailIns,$mdpIns);
    $message1 = "<div> $message1 </div>";
    unset($Inscript);
}

if (isset($Connect)){
    $message1 = $Affuse->ValidationConnect($emailCon,$mdpCon);
    $_SESSION['test'] = $message1;
    $_POST["Connexion"]='';
}

if (isset($sedeconnecter)){
    $message1 = '<div>Au revoir</div>';
    $_SESSION['test'] = '0';
}

class AffUser
{

    public function __construct()
    {

    }

    public function ValidationInscription($nom, $prenom, $email, $mdp)
    {
        global $con;
        $message = '';
        $vide = (empty($nom) || empty($prenom));
        $pasChaine = (!is_string($nom) || !is_string($prenom));
        if ($vide || $pasChaine) :
            $message = "Nom ou Prenom Incorrect<br>";
        else:
            $nom = strtoupper($nom);
            $prenom = strtolower($prenom);
            $prenom[0] = strtoupper($prenom[0]);
        endif;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = $message . "Email Incorrect<br>";
        }
        if (empty($mdp)) {
            $message = $message . "Mot de passe Vide<br>";
        }
        if ($message == '') {
            $GateUser = new GateWayUtilisateur($con);
            $futurID = 12345;
            $recherche = "SELECT * FROM utilisateur WHERE IdUser =" . $futurID;
            $resultat = $con->query($recherche);
            if ($resultat->rowCount() != 0) {
                $futurID = rand(10000, 99999);
                $recherche = "SELECT * FROM utilisateur WHERE IdUser =" . $futurID;
                $resultat = $con->query($recherche);
            }
            $GateUser->insert(new User($futurID, $email, $nom, $prenom, $mdp));
        }
        return $message;
    }

    public function ValidationConnect($email,$mdp)
    {
        global $con;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Mot de Passe ou Email incorrect";
            return $message;
        }
        $recherche = "SELECT * FROM utilisateur WHERE Email='".$email."'AND Mot_De_Passe='".$mdp."'";
        $resultat = $con->query($recherche);
        if ($resultat->rowCount()==0){
            $message = "Mot de Passe ou Email incorrect";
            return $message;
        }else{
            while ($ligne = $resultat->fetch()){
               return $ligne['IdUser'];
            }
        }
    }
}