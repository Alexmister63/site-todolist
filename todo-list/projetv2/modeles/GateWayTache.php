<?php

require_once ('Tache.php');



class GateWayTache
{
    private $con;

    public function __construct(Connection  $con)
    {
        $User = 0;
        $this->con = $con;
    }

    public function insert(Tache $t){
        $query ='INSERT INTO tache VALUES(:IdTache,:NomTache,:Realise,:IdListe)';
        $this->con->executeQuery($query,array(
            ':IdTache' => array($t->getIdTache(),PDO::PARAM_INT),
            ':NomTache' => array($t->getNomTache(),PDO::PARAM_STR),
            ':Realise' => array($t->getRealise(),PDO::PARAM_BOOL),
            ':IdListe'   => array($t->getIdListe(),PDO::PARAM_INT)
        ));
    }
    public function delete($id){
        $recherche = "DELETE FROM tache WHERE IdTache =".$id;
        $this->con->query($recherche);
    }

    public function faireTache($id,$rea){
        if ($rea == 0){
            $recherche = "UPDATE tache SET Realise= 1 WHERE IdTache =".$id;
        }else{
            $recherche = "UPDATE tache SET Realise= 0 WHERE IdTache =".$id;
        }
        $this->con->query($recherche);
    }



}