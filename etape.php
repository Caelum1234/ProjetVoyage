<?php 

require('server_db.php');

class etape {

    private $Ordre ;
    private $Nom_lieu;
    private $Ville_Et;
    private $Pays_Et ;
    private $Date_Et ;
    private $Duree_Et;


    function __constructEt($Ordre, $Nom_lieu, $Ville_Et, $Pays_Et, $Date_Et, $Duree_Et){
        $this->Ordre = $Ordre;
        $this->Nom_lieu = $Nom_lieu;
        $this->Ville_Et = $Ville_Et;
        $this->Pays_Et = $Pays_Et;
        $this->Date_Et = $Date_Et;
        $this->Duree_Et = $Duree_Et;
    }

    public function getOrdre(){
        return $this->Ordre;
    }
    public function getNom_Lieu(){
        return $this->Nom_lieu;
    }
    public function getVille_Et(){
        return $this->Ville_Et;
    }
    public function getPays_Et(){
        return $this->Pays_Et;
    }
    public function getDate_Et(){
        return $this->Date_Et;
    }
    
    public function getDure_Et(){
        return $this->Duree_Et;
    }


}




?>