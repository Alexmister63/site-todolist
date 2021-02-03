<?php

require ('../modeles/GateWayListeTache.php');

require('AffTache.php');

$messageListe = '';

$affListe = new AffListe();
@$NomListe = $_POST["NomListe"];
@$validerListe = $_POST["validerListe"];
@$supprimerListe = $_POST["SupprimerListe"];
$affichage = $affListe->recupérerListe();

if (isset($supprimerListe)){
    $messageListe = '<div>'.$_SESSION["test"].'</div>';
    $messageListe = $affListe->ValSupListe($_POST["SupprimerListe"]);
    $affichage = $affListe->recupérerListe();
}

if (isset($validerListe)){
    $messageListe = '<div>'.$_SESSION["test"].'</div>';
    $messageListe = $affListe->ValiderListe($NomListe,$_SESSION["test"]);
    $messageListe ="<div> $messageListe </div>";
    $affichage = $affListe->recupérerListe();
}

class AffListe
{

    public function __construct()
    {
        // faire switch pour chaque action de l'utilisateur
        try{
            $nomListe=$_REQUEST['action'];

        }
        catch(PDOException $e){
            require('../vues/Erreur.html');
        }
    }

    public function recupérerListe(){
        global $con;
        $LesListes = 'SELECT * from listetache WHERE IdUser = 0 OR IdUser ='.$_SESSION['test'];
        $resultatListe =  $con->query($LesListes);
        $refaire ='<label class="text-light">Ajouter une Tache</hlabel><div class="champ"><input type="text" class="form-control m-auto" name="action"/></div>';
        while ($ligneListe = $resultatListe->fetch()){
            //Completer le code avec les parties des listes
            $refaire = $refaire.'<ul class="list-group todos mx-auto text-light"><li class="list-group-item d-flex justify-content-between align-items-center"><span>'.$ligneListe['NomListe'].'</span><button value="'.$ligneListe["IdListe"].'" name="SupprimerListe">Supprimer</button></li></ul>';
            $refaire = $refaire.$this->recupererTache($ligneListe['IdListe']);
        }
        return $refaire;
    }

    public function recupererTache($id){
        global $con;
        $LesTaches = 'SELECT * from tache WHERE IdListe ='.$id;
        $resultatTache = $con->query($LesTaches);
        $reconst ='<ul>';
        while ($ligneTache = $resultatTache->fetch()){
            if($ligneTache['Realise'] == 0 ){
                $reconst = $reconst.'<ul class="list-group todos mx-auto text-light"><li class="list-group-item d-flex justify-content-between align-items-center"><div type="checkbox"><button value="'.$ligneTache["IdTache"].'" name="tacheFaite">A Faire</button></div><span>'.$ligneTache['NomTache'].'</span><div class="submit"><button name="deleteTache" value="'.$ligneTache["IdTache"].'">Delete</button></div></li></ul>';
            }else{
                $reconst = $reconst.'<ul class="list-group todos mx-auto text-light"><li class="list-group-item d-flex justify-content-between align-items-center"><div type="checkbox"><button value="'.$ligneTache["IdTache"].'" name="tacheFaite">" Fait "</button></div><span>'.$ligneTache['NomTache'].'</span><div class="submit"><button name="deleteTache" value="'.$ligneTache["IdTache"].'">Delete</button></div></li></ul>';
            }
        }
        $reconst = $reconst.'</ul><div class="champ"><button type="submit" name="AjouterTache" value="'.$id.'">Ajouter</button></div>';
        return $reconst;
    }

    public function ValSupListe($id){
        global $con;
        $message ='Sup OK !';
        $recherche = "SELECT * FROM listetache WHERE IdListe =".$id;
        $resultat = $con->query($recherche);
        if ($resultat->rowCount() == 0){
            $message = "Tache introuvable !";
            return $message;
        }else{
            $recherche =  "DELETE FROM tache WHERE IdListe =".$id;
            $resultat = $con->query($recherche);
            $GateListe = new GateWayListeTache($con);
            $GateListe->delete($id);
        }
        return $message;
    }


    public function ValiderListe($nom,$IdUser){
        global $con;
        $message ='Tout est bon';
        if (empty($nom)){
            $message = 'Nom De Liste vide';
        }else{
            $futurID = 12345;
            $recherche = "SELECT * FROM listetache WHERE IdListe =".$futurID;
            $resultat = $con->query($recherche);
            if ($resultat->rowCount() != 0){
                $futurID = rand(10000,99999);
                $recherche = "SELECT * FROM listetache WHERE IdListe =".$futurID;
                $resultat = $con->query($recherche);
            }
            $GateListe = new GateWayListeTache($con);
            $GateListe->insert(new ListeTache($futurID,$nom,$IdUser));
        }
        return $message;
    }




}