<?php
require('ListeTache.php');

class GateWayListeTache
{
    private $con;

    public function __construct(Connection  $con)
    {
        $User = 0;
        $this->con = $con;
    }

    public function insert(ListeTache $l){
        $query ='INSERT INTO listetache VALUES(:IdListe,:NomListe,:IdUser)';
        $this->con->executeQuery($query,array(
            ':IdListe' => array($l->getIdListe(),PDO::PARAM_INT),
            ':NomListe' => array($l->getNomListe(),PDO::PARAM_STR),
            ':IdUser'   => array($l->getIdUser(),PDO::PARAM_INT)
        ));
    }

    public function delete($id){
        $recherche = "DELETE FROM listetache WHERE IdListe =".$id;
        $this->con->query($recherche);
    }
}