<?php 

require('server_db.php');

class Lieux {

    private $Descri ;
    private $Prix_visite;


    function __constructLieu($Prix_visite, $Descri){
        $this->Prix_visite = $Prix_visite;
        $this->Descri = $Descri;
      
    }

    public function getPrixVisite(){
        return $this->Prix_visite;
    }
    public function getDescri(){
        return $this->Descri;
    }


}




?>