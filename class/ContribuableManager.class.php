<?php

class ContribuableManager
{

  private $_db;

   public function __construct($db)
   {
       $this->_db=$db;
   }

   public function add(Contribuable $contrib)
   {
     $sql=$this->_db->prepare("INSERT INTO Entreprises(numIfu,NomEntreprise,DirectionE,RegimeFiscal) VALUES(:numIfu,:NomEntreprise,:DirectionE,:RegimeFiscal)");
     $d=$sql->execute(array(
      "numIfu"=>$contrib->numIfu,
      "NomEntreprise"=>$contrib->NomEntreprise,
      "DirectionE"=>$contrib->DirectionE,
      "RegimeFiscal"=>$contrib->RegimeFiscal,
    ));

   }

   public function get($numIfu)
   {
     $sql=$this->_db->prepare("SELECT * FROM Entreprises WHERE numIfu=?");
     $sql->execute(array($numIfu));
     $row=$sql->fetch();
     $sql->closeCursor();
     $contrib=new Contribuable($row);
     return $contrib;
   }

   public function delete($numIfu)
   {
       $sql=$this->_db->prepare("DELETE FROM Entreprises WHERE numIfu=?");
       $sql->execute(array($numIfu));
   }
   
   public function liste()
   {
     $contrib=[];
     $sql=$this->_db->query("SELECT * FROM Entreprises ORDER BY NomEntreprise");
     $rows=$sql->fetchAll();
     $sql->closeCursor();
     
     foreach ($rows as $row) {

     $contrib[]=new Contribuable($row);
     }
     return $contrib;
   }

 public function edit(Contribuable $contrib)
   {
    //echo $visiteur->getId();
     try{ 
            $sql=$this->_db->prepare("UPDATE Entreprises SET numIfu =:numIfu, NomEntreprise =:NomEntreprise, DirectionE =:DirectionE, RegimeFiscal =:RegimeFiscal WHERE numIfu=:numIfu");
            $d=$sql->execute(array(
            'numIfu'=>$contrib->numIfu,
            'NomEntreprise'=>$contrib->NomEntreprise,
            'DirectionE'=>$contrib->DirectionE,
            'RegimeFiscal'=>$contrib->RegimeFiscal,
          ));  

     } catch (Exception $ex) {
         echo $ex->getMessage();
     }
   }
}
