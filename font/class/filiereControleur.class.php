<?php

class filiereControleur
{

  private $_db;

   public function __construct($db)
   {
       $this->_db=$db;
   }

   public function add(filiere$filiere)
   {
     $sql=$this->_db->prepare("INSERT INTO filiere(id_filiere,nom_filiere) VALUES(:id_filiere,:nom_filiere)");
     $sql->execute(array(
      "id_filiere"=>$filiere->id_filiere,
      "nom_filiere"=>$Service->nom_filiere,
    ));
   }

   public function get($id_filiere)
   {
     $sql=$this->_db->prepare("SELECT * FROM filiere WHERE id_filiere=?");
     $sql->execute(array($id_filiere));
     $row=$sql->fetch();
     $sql->closeCursor();
     $fil=new filiere($row);
     return $serv;
   }

   public function delete($id_filiere)
   {
       $sql=$this->_db->prepare("DELETE FROM filiere WHERE id_filiere=?");
       $sql->execute(array($id_filiere));
   }
   
   public function liste()
   {
     $fil=[];
     $sql=$this->_db->query("SELECT * FROM filiere");
     $rows=$sql->fetchAll();
     $sql->closeCursor();
     
     foreach ($rows as $row) {
     $fil[]=new filiere($row);
     }
     return $fil;
   }

 public function edit(filiere $filiere)
   {
     try{ 
            $sql=$this->_db->prepare("UPDATE filiere SET id_filiere=:id_filiere, nom_filiere=:nom_filiere WHERE id_filiere=:id_filiere");
            $sql->execute(array(
            "id_filiere"=>$filiere->id_filiere,
            "nom_filiere"=>$filiere->nom_filiere));  

     } catch (Exception $ex) {
         echo $ex->getMessage();
     }
   }
}