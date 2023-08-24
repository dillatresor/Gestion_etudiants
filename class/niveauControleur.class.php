<?php

class niveau_etudeControleur
{

  private $_db;

   public function __construct($db)
   {
       $this->_db=$db;
   }

   public function add(niveau_etude $niveau_etude)
   {
     $sql=$this->_db->prepare("INSERT INTO niveau(id_niveau,valeur) VALUES(:id_niveau,:valeur)");
     $sql->execute(array(
      "id_niveau"=>$niveau_etude->id_niveau,
      "valeur"=>$niveau_etude->valeur,
    ));
   }

   public function get($niveau_etude)
   {
     $sql=$this->_db->prepare("SELECT * FROM niveau_etude WHERE id_niveau=?");
     $sql->execute(array($id_niveau));
     $row=$sql->fetch();
     $sql->closeCursor();
     $niv=new niveau_etude($row);
     return $niv;
   }

   public function delete($id_niveau)
   {
       $sql=$this->_db->prepare("DELETE FROM niveau_etude WHERE id_niveau=?");
       $sql->execute(array($id_niveau));
   }
   
   public function liste()
   {
     $serv=[];
     $sql=$this->_db->query("SELECT * FROM niveau_etude");
     $rows=$sql->fetchAll();
     $sql->closeCursor();
     
     foreach ($rows as $row) {
     $niv[]=new niveau_etude($row);
     }
     return $niv;
   }

 public function edit(niveau_etude $niveau_etude)
   {
     try{ 
            $sql=$this->_db->prepare("UPDATE niveau_etude SET id_niveau=:id_niveau, valeur=:valeur WHERE id_niveau=:id_niveau");
            $sql->execute(array(
            "id_niveau"=>$niveau_etude->id_niveau,
            "valeur"=>$niveau_etude->valeur));  

     } catch (Exception $ex) {
         echo $ex->getMessage();
     }
   }
}