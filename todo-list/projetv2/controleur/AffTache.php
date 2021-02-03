<?php

require('../modeles/GateWayTache.php');

require('../config/config.php');

session_start();
@$nomTache=$_POST["action"];
@$AjouterTache =$_POST["AjouterTache"];
@$deleteTache = $_POST["deleteTache"];
@$Faite = $_POST["tacheFaite"];
$valider = new AffTache();
$messageTache = '' ;

if (isset($Faite)){
    $messageTache = $valider->ValTacheFaite( $_POST["tacheFaite"]);
    $messageTache ="<div>$messageTache</div>";
    unset($Faite);
}

if (isset($deleteTache)){
    $messageTache = $valider->ValSupTache($_POST["deleteTache"]);
    $messageTache = "<div> $messageTache </div>";
    unset($deleteTache);
}

if(isset($AjouterTache)) {
    $message = '<div>'.$_SESSION["test"].'</div>';
    $message =$message. $valider->ValidationTache($nomTache,$_POST["AjouterTache"]);
    $nomTache ='';
    $message =$message. "<div> $message </div>";
    $_POST["NomTache"]='';
}

class AffTache
{

    public function __construct()
    {
        try{
        $nomTache=$_REQUEST['action'];

        }
        catch(PDOException $e){
            require('../vues/Erreur.html');
        }
    }



    public function ValidationTache($nom,$idListe){
        global $con;
        $message ='Tout est bon';
        if (empty($nom)){
            $message = 'Nom De Tache vide';
        }else{
            $futurID = 12345;
            $recherche = "SELECT * FROM tache WHERE IdTache =".$futurID;
            $resultat = $con->query($recherche);
            if ($resultat->rowCount() != 0){
                $futurID = rand(10000,99999);
                $recherche = "SELECT * FROM tache WHERE IdTache =".$futurID;
                $resultat = $con->query($recherche);
            }
            $GateTache = new GateWayTache($con);
            $GateTache->insert(new Tache($futurID,$nom,$idListe));
        }
        return $message;
    }

    public function ValTacheFaite($id){
        global $con;
        $message ='Val OK !';
        $recherche = "SELECT * FROM tache WHERE IdTache=".$id;
        $resultat = $con->query($recherche);
        if ($resultat->rowCount() == 0){
            $message = "Tache introuvable !";
            return $message;
        }else{
            $GateTache = new GateWayTache($con);
            while ($ligne = $resultat->fetch()){
                $rea = $ligne['Realise'];
            }
            $GateTache->faireTache($id,$rea);
        }
        return $message;
    }




    public function ValSupTache($id){
        global $con;
        $message ='Sup OK !';
        $recherche = "SELECT * FROM tache WHERE IdTache =".$id;
        $resultat = $con->query($recherche);
        if ($resultat->rowCount() == 0){
            $message = "Tache introuvable !";
            return $message;
        }else{
            $GateTache = new GateWayTache($con);
            $GateTache->delete($id);
        }
        return $message;
    }
}