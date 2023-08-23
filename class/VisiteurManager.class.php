<?php

class VisiteurManager
{

  private $_db;

   public function __construct($db)
   {
       $this->_db=$db;
   }

   public function add(Visiteur $visiteur)
   {
     $sql=$this->_db->prepare("INSERT INTO visiteurs(numCnib,numIfu,NomVisiteurs,PrenomVisiteurs,TelVisiteurs,PhotoVisiteur) 
     VALUES(:numCnib,:numIfu,:NomVisiteurs,:PrenomVisiteurs,:TelVisiteurs,:PhotoVisiteur)");
     $sql->execute(array(
      "numCnib"=>$visiteur->numCnib,
      "numIfu"=>$visiteur->numIfu,
      "NomVisiteurs"=>$visiteur->NomVisiteurs,
      "PrenomVisiteurs"=>$visiteur->PrenomVisiteurs,
      "TelVisiteurs"=>$visiteur->TelVisiteurs,
      "PhotoVisiteur"=>$visiteur->PhotoVisiteur,
    ));
   }

   public function get($numCnib)
   {
     $sql=$this->_db->prepare("SELECT * FROM visiteurs WHERE numCnib=?");
     $sql->execute(array($numCnib));
     $row=$sql->fetch();
     $sql->closeCursor();
     $visi=new Visiteur($row);
     return $visi;
   }

   public function delete($numCnib)
   {
       $sql=$this->_db->prepare("DELETE FROM visiteurs WHERE numCnib=?");
       $sql->execute(array($numCnib));
   }

   public function liste()
   {
     $contrib=[];
     $sql=$this->_db->query("SELECT * FROM visiteurs");
     $rows=$sql->fetchAll();
     $sql->closeCursor();

     foreach ($rows as $row){
     $visi[]=new Visiteur($row);
     }
     return $visi;
   }

 public function edit(Visiteur $visi)
   {
     try{ 
         $sql=$this->_db->prepare("UPDATE visiteurs SET numCnib=:numCnib, numIfu=:numIfu, NomVisiteurs=:NomVisiteurs,
         PrenomVisiteurs=:PrenomVisiteurs, TelVisiteurs=:TelVisiteurs, PhotoVisiteur=:PhotoVisiteur WHERE numCnib=:numCnib");
         $d=$sql->execute(array(
         "numCnib"=>$visiteur->numCnib,
         "numIfu"=>$visiteur->numIfu,
         "NomVisiteurs"=>$visiteur->NomVisiteurs,
         "PrenomVisiteurs"=>$visiteur->PrenomVisiteurs,
         "TelVisiteurs"=>$visiteur->TelVisiteurs,
         "PhotoVisiteur"=>$visiteur->PhotoVisiteur,
          ));

     } catch (Exception $ex) {
         echo $ex->getMessage();
     }
   }
}
