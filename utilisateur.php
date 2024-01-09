<?php
session_start();
class Utilisateur {
    private $Id_Utilisateur;
    private $mail; 
    private $mdp;
    private $role;

    function __construct($Id_Utilisateur, $login, $Mdp, $role){
        $this->Id_Utilisateur = $Id_Utilisateur;
        $this->login = $login;
        $this->Mdp = $Mdp;
        $this->role = $role;
    }

    //Création du getter pour mes attributs, comme ils sont en private j'y accède depuis cette fonction.
    public function getId_Utilisateur(){
        return $this->Id_Utilisateur;
    }
    public function getMail(){
        return $this->Mail;
    }
    public function getMdp(){
        return $this->Mdp;
    }

    public function setId_Utilisateur($id){
        if(empty($this->Id_Utilisateur) || isset($this->Id_Utilisateur)){
            $this->Id_Utilisateur = $id;
        }
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function checkUser(){

        require('server_db.php');

        $queryUser = $connexion->prepare('SELECT * FROM circuit WHERE mail = ? AND mdp = ?');
        $queryUser->execute([$this->getlogin(),$this->getMdp()]);
        $toto = $queryUser->fetch();
        if(!empty($toto['Id_Utilisateur'])){
            $this->setId_Utilisateur($toto['Id_Utilisateur']);
            $this->setRole($toto['Id_Role']);
            $_SESSION['role'] = $this->role;
        }
    }

}

?>