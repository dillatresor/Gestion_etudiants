<?php

class etudiantControleur
{

  private $_db;

   public function __construct($db)
   {
       $this->_db=$db;
   }

   public function add(etudiant $etudiant)
   {
     $sql=$this->_db->prepare("INSERT INTO etudiant(idetudiant,id_filière,id_niveau,Nom,Prenom,date_naissance,matricule,adresse,email,contact,nationalite) 
     VALUES(:idetudiant,:id_filière,:id_niveau,:Nom,:Prenom,:date_naissance,:matricule,:adresse,:email,:contact,nationalite)");
     $sql->execute(array(
      "idetudiant"=>$etudiant->idetudiant,
      "id_filière"=>$etudiant->id_filière,
      "id_niveau"=>$etudiant->id_niveau,
      "Nom"=>$etudiant->Nom,
      "Prenom"=>$etudiant->Prenom,
      "date_naissance"=>$etudiant->date_naissance,
      "matricule"=>$etudiant->matricule,
      "adresse"=>$etudiant->adresse,
      "email"=>$etudiant->email,
      "telephone"=>$etudiant->telephone,
      "nationalite"=>$etudiant->nationalite,
    ));
   }

   public function get($idetudiant)
   {
     $sql=$this->_db->prepare("SELECT * FROM etudiant WHERE idetudiant=?");
     $sql->execute(array($idetudiant));
     $row=$sql->fetch();
     $sql->closeCursor();
     $etud=new etudiant($row);
     return $etud;
   }

   public function delete($idetudiant)
   {
       $sql=$this->_db->prepare("DELETE FROM etudiant WHERE idetudiant=?");
       $sql->execute(array($idetudiant));
   }

   public function liste()
   {
     $etud=[];
     $sql=$this->_db->query("SELECT * FROM etudiant");
     $rows=$sql->fetchAll();
     $sql->closeCursor();

     foreach ($rows as $row){
     $etud[]=new etudiant($row);
     }
     return $etud;
   }

 public function edit(etudiant $etud)
   {
     try{ 
         $sql=$this->_db->prepare("UPDATE etudiant SET idetudiant=:idetudiant, id_filiere=:id_filiere,id_niveau=:id_niveau,nom=:nom,prenom=:prenom, date_n=:date_naissnace,
         nationalite=:nationalite, adresse=:adresse, email=:email WHERE idetudiant=:idetudiant");
         $d=$sql->execute(array(
         "idetudiant"=>$etudiant->idetudiant,
         "id_filière"=>$etudiant->id_filière,
         "id_niveau"=>$etudiant->id_niveau,
         "Nom"=>$etudiant->Nom,
         "Prenom"=>$etudiant->Prenom,
         "date_naissance"=>$etudiant->date_naissance,
         "matricule"=>$etudiant->matricule,
         "adresse"=>$etudiant->adresse,
         "email"=>$etudiant->email,
         "telephone"=>$etudiant->telephone,
         "nationalite"=>$etudiant->nationalite,
          ));

     } catch (Exception $ex) {
         echo $ex->getMessage();
     }
   }
}
