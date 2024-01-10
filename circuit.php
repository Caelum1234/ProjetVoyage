<?php 

require('server_db.php');

class circuit {

    private $Id_Circ ;
    private $Descrip;
    private $Ville_Dep;
    private $Pays_Dep ;
    private $Pays_Arr;
    private $Ville_Arr;
    private $Date_Dep ;
    private $Nb_Place_Dispo;
    private $Duree_Circ;
    private $Prix_Insc;


    function __construct($Id_Circ, $Descrip, $Ville_Dep, $Pays_Dep, $Pays_Arr, $Ville_Arr, $Date_Dep, $Nb_Place_Dispo, $Duree_Circ, $Prix_Insc){
        $this->Id_Circ = $Id_Circ;
        $this->Descrip = $Descrip;
        $this->Ville_Dep = $Ville_Dep;
        $this->Pays_Dep = $Pays_Dep;
        $this->Pays_Arr = $Pays_Arr;
        $this->Ville_Arr = $Ville_Arr;
        $this->Date_Dep = $Date_Dep;
        $this->Nb_Place_Dispo = $Nb_Place_Dispo;
        $this->Duree_Circ = $Duree_Circ;
        $this->Prix_Insc = $Prix_Insc;
    }

    public function getId_Circ(){
        return $this->Id_Circ;
    }
    public function getDescrip(){
        return $this->Descrip;
    }
    public function getVilleDep(){
        return $this->Ville_Dep;
    }
    public function getPaysDep(){
        return $this->Pays_Dep;
    }
    public function getPaysArr(){
        return $this->Pays_Arr;
    }
    public function getVilleArr(){
        return $this->Ville_Arr;
    }
    public function getDateDep(){
        return $this->Date_Dep;
    }
    public function getNbPlaceDispo(){
        return $this->Nb_Place_Dispo;
    }
    public function getDureeCirc(){
        return $this->Duree_Circ;
    }
    public function getPrixInsc(){
        return $this->Prix_Insc;
    }


}




?>