<?php

class Visite
{
  private $idVisites;
  private $MllePersonnel;
  private $numCnib;
  private $DateVisite;
  private $DebutVisites;
  private $FinVisites;
  private $TypeVisites;
  private $ObsVisites;
  private $Idservice;
  public function __construct(array $donnee){

    foreach ($donnee as $key => $value) {
        
        if(property_exists($this,$key)){
          $this->$key=$value;
        }
    }
  }
 
  public function __get($propriete)
  {
       if(property_exists($this,$propriete)){ 
       return $this->$propriete;
    }
  }
        
  public function __set($propriete, $value)
  {
        if(property_exists($this,$propriete)){ 
        $this->$propriete = $value;
     }
  }
}


