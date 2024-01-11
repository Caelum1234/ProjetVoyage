<?php

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
    // Démarrer la session
    session_start();
}

class Utilisateur {
    private $Id_Utilisateur;
    private $mail; 
    private $mdp;
    private $role;

    function __construct($Id_Utilisateur, $mail, $mdp, $role){
        $this->Id_Utilisateur = $Id_Utilisateur;
        $this->mail = $mail;
        $this->mdp = $mdp;
        $this->role = $role;
    }

    //Création du getter pour mes attributs, comme ils sont en private j'y accède depuis cette fonction.
    public function getId_Utilisateur(){
        return $this->Id_Utilisateur;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getMdp(){
        return $this->mdp;
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

        $queryUser = $connexion->prepare('SELECT * FROM utilisateur WHERE mail = ? AND mdp = ?');
        $queryUser->execute([$this->getMail(),$this->getMdp()]);
        $toto = $queryUser->fetch();
        if(!empty($toto['Id_Utilisateur'])){
            $this->setId_Utilisateur($toto['Id_Utilisateur']);
            $this->setRole($toto['Id_Role']);
            $_SESSION['role'] = $this->role;
        }
    }

}

?>