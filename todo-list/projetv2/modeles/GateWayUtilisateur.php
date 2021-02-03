<?php
require ("User.php");

class GateWayUtilisateur
{
    private $con;

    public function __construct(Connection  $con)
    {
        $this->con = $con;
    }

    public function insert(User $user){
        $query ='INSERT INTO utilisateur VALUES(:Nom,:Prenom,:Mot_De_Passe,:IdUser,:Email)';
        $this->con->executeQuery($query,array(
            ':Nom' => array($user->getNom(),PDO::PARAM_STR),
            ':Prenom' => array($user->getPrenom(),PDO::PARAM_STR),
            ':Mot_De_Passe' => array($user->getMDP(),PDO::PARAM_STR),
            ':IdUser' => array($user->getIdUser(),PDO::PARAM_INT),
            ':Email' => array($user->getEmail(),PDO::PARAM_STR)
        ));
    }
}