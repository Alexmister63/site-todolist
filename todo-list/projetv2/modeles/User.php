<?php


class User
{
    private $IdUser;
    private $Nom;
    private $Email;
    private $Prenom;
    private $MDP;

    public function __construct($IdUser,$Email,$Nom,$Prenom,$pass)
    {
        $this->IdUser = $IdUser;
        $this->Email=$Email;
        $this->Nom=$Nom;
        $this->Prenom=$Prenom;
        $this->MDP = $pass;
    }


    public function getEmail()
    {
        return $this->Email;
    }

    public function getIdUser()
    {
        return $this->IdUser;
    }

    public function getNom()
    {
        return $this->Nom;
    }

    public function getPrenom()
    {
        return $this->Prenom;
    }

    public function getMDP()
    {
        return $this->MDP;
    }
}