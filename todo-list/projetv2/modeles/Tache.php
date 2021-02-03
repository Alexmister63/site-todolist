<?php


class Tache
{
    private $IdTache;
    private $NomTache;
    private $Realise;
    private $IdListe;

    public function __construct( $id,$nom,$IdListe)
    {
        $this->IdTache = $id;
        $this->NomTache=$nom;
        $this->Realise=false;
        $this->IdListe = $IdListe;
    }
    public function getIdTache()
    {
        return $this->IdTache;
    }

    public function getNomTache()
    {
        return $this->NomTache;
    }

    public function getRealise()
    {
        return $this->Realise;
    }

    public function getIdListe()
    {
        return $this->IdListe;
    }


}