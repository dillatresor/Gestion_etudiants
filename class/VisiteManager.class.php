<?php

class VisiteManager
{

  private $_db;

   public function __construct($db)
   {
       $this->_db=$db;
   }

   public function add(Visite $visite)
   {
     $sql=$this->_db->prepare("INSERT INTO visite(Idservice,MllePersonnel,numCnib,DateVisite,DebutVisites,FinVisites,TypeVisites,ObsVisites) 
     VALUES(:Idservice,:MllePersonnel,:numCnib,:DateVisite,:DebutVisites,:FinVisites,:TypeVisites,:ObsVisites)");
     $sql->execute(array(
      "Idservice"=>$visite->Idservice,
      "MllePersonnel"=>$visite->MllePersonnel,
      "numCnib"=>$visite->numCnib,
      "DateVisite"=>$visite->DateVisite,
      "DebutVisites"=>$visite->DebutVisites,
      "FinVisites"=>$visite->FinVisites,
      "TypeVisites"=>$visite->TypeVisites, 
      "ObsVisites"=>$visite->ObsVisites,
    ));
   }

   public function get($idVisites)
   {
     $sql=$this->_db->prepare("SELECT * FROM visite WHERE idVisites=?");
     $sql->execute(array($idVisites));
     $row=$sql->fetch();
     $sql->closeCursor();
     $visite=new Visite($row);
     return $visite;
   }

   public function delete($idVisites)
   {
       $sql=$this->_db->prepare("DELETE FROM visite WHERE idVisites=?");
       $sql->execute(array($idVisites));
   }
   
   public function liste()
   {
     $visite=[];
     $sql=$this->_db->query("SELECT * FROM visite");
     $rows=$sql->fetchAll();
     $sql->closeCursor();
     
     foreach ($rows as $row) {
     $visite[]=new Visite($row);
     }
     return $visite;
   }

  public function VisiteJour()
   {
     $visite=[];
     $sql=$this->_db->query("SELECT * FROM visite WHERE DateVisite = current_date");
     $rows=$sql->fetchAll();
     $sql->closeCursor();
     
     foreach ($rows as $row) {
     $visite[]=new Visite($row);
     }
     return $visite;
   }

   public function VisitCours()
   {
     $visite=[];
     $sql=$this->_db->query("SELECT * FROM visite WHERE FinVisites='00:00:00'");
     $rows=$sql->fetchAll();
     $sql->closeCursor();
     
     foreach ($rows as $row) {
     $visite[]=new Visite($row);
     }
     return $visite;
   }

public function getVisiteByservice($Idservice,$format){
  if($format=='month'){
    $visit=$this->_db->prepare('SELECT  COUNT(idVisites) AS nombre,MONTH(DateVisite) AS mois FROM visite  WHERE Idservice=? GROUP BY MONTH(DateVisite)');
  }
  if($format=='year'){
    $visit=$this->_db->prepare('SELECT  COUNT(idVisites) AS nombre,YEAR(DateVisite) AS annee FROM visite  WHERE Idservice=? GROUP BY YEAR(DateVisite)');
  }
  $visit->execute([$Idservice]);
  $result=$visit->fetchAll();
  return $result;
}
 public function edit(Visite $visite)
   {
     try{ 
            $sql=$this->_db->prepare("UPDATE visite SET idVisites=:idVisites, MllePersonnel=:MllePersonnel, numCnib=:numCnib, DateVisite=:DateVisite,
            DebutVisites=:DebutVisites, FinVisites=:FinVisites, TypeVisites=:TypeVisites, ObsVisites=:ObsVisites WHERE idVisites=:idVisites");
            $d=$sql->execute(array(
              "MllePersonnel"=>$visite->MllePersonnel,
              "numCnib"=>$visite->numCnib,
              "DateVisite"=>$visite->DateVisite,
              "DebutVisites"=>$visite->DebutVisites,
              "FinVisites"=>$visite->FinVisites,
              "TypeVisites"=>$visite->TypeVisites,
              "ObsVisites"=>$visite->ObsVisites,
              "idVisites"=>$visite->idVisites
          ));  

     } catch (Exception $ex) {
         echo $ex->getMessage();
     }
   }
}
