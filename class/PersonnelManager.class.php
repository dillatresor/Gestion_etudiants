<?php

class PersonnelManager
{

  private $_db;

   public function __construct($db)
   {
       $this->_db=$db;
   }

   public function add(Personnel $person)
   {
     $sql=$this->_db->prepare("INSERT INTO personnel(MllePersonnel,IdService,NomPersonnel,PrenomPersonnel,Emploie,Categorie) 
     VALUES(:MllePersonnel,:IdService,:NomPersonnel,:PrenomPersonnel,:Emploie,:Categorie)");
     $sql->execute(array(
      "MllePersonnel"=>$person->MllePersonnel,
      "IdService"=>$person->IdService,
      "NomPersonnel"=>$person->NomPersonnel,
      "PrenomPersonnel"=>$person->PrenomPersonnel,
      "Emploie"=>$person->Emploie,
      "Categorie"=>$person->Categorie
    ));
   }

   public function get($MllePersonnel)
   {
     $sql=$this->_db->prepare("SELECT * FROM personnel WHERE MllePersonnel=?");
     $sql->execute(array($MllePersonnel));
     $row=$sql->fetch();
     $sql->closeCursor();
     $pers=new Personnel($row);
     return $pers;
   }

   public function delete($MllePersonnel)
   {
       $sql=$this->_db->prepare("DELETE FROM personnel WHERE MllePersonnel=?");
       $sql->execute(array($MllePersonnel));
   }
   
   public function liste()
   {
     $pers=[];
     $sql=$this->_db->query("SELECT * FROM personnel");
     $rows=$sql->fetchAll();
     $sql->closeCursor();
     
     foreach ($rows as $row) {
     $pers[]=new Personnel($row);
     }
     return $pers;
   }

 public function edit(Personnel $person)
   {
     try{ 
            $sql=$this->_db->prepare("UPDATE personnel SET MllePersonnel=:MllePersonnel, IdService=:IdService, NomPersonnel=:NomPersonnel,
            PrenomPersonnel=:PrenomPersonnel, Emploie=:Emploie, Categorie=:Categorie WHERE MllePersonnel=:MllePersonnel");
            $d=$sql->execute(array(
            "MllePersonnel"=>$person->MllePersonnel,
            "IdService"=>$person->IdService,
            "NomPersonnel"=>$person->NomPersonnel,
            "PrenomPersonnel"=>$person->PrenomPersonnel,
            "Emploie"=>$person->Emploie,
            "Categorie"=>$person->Categorie,
          ));  

     } catch (Exception $ex) {
         echo $ex->getMessage();
     }
   }
}
