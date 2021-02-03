<?php


class ListeTache
{
    private $IdListe;
    private $NomListe;
    private $IdUser;

    public function __construct( $id,$nom,$idUser)
    {
        $this->IdListe = $id;
        $this->NomListe=$nom;
        $this->IdUser = $idUser;
    }

    public function getIdUser()
    {
        return $this->IdUser;
    }


    public function getIdListe()
    {
        return $this->IdListe;
    }


    public function getNomListe()
    {
        return $this->NomListe;
    }
}