<?php

class ServiceManager
{

  private $_db;

   public function __construct($db)
   {
       $this->_db=$db;
   }

   public function add(Service $Service)
   {
     $sql=$this->_db->prepare("INSERT INTO service(IdService,NomService) VALUES(:IdService,:NomService)");
     $sql->execute(array(
      "IdService"=>$Service->IdService,
      "NomService"=>$Service->NomService,
    ));
   }

   public function get($IdService)
   {
     $sql=$this->_db->prepare("SELECT * FROM service WHERE IdService=?");
     $sql->execute(array($IdService));
     $row=$sql->fetch();
     $sql->closeCursor();
     $serv=new Service($row);
     return $serv;
   }

   public function delete($IdService)
   {
       $sql=$this->_db->prepare("DELETE FROM service WHERE IdService=?");
       $sql->execute(array($IdService));
   }
   
   public function liste()
   {
     $serv=[];
     $sql=$this->_db->query("SELECT * FROM service");
     $rows=$sql->fetchAll();
     $sql->closeCursor();
     
     foreach ($rows as $row) {
     $serv[]=new Service($row);
     }
     return $serv;
   }

 public function edit(Service $Service)
   {
     try{ 
            $sql=$this->_db->prepare("UPDATE service SET IdService=:IdService, NomService=:NomService WHERE IdService=:IdService");
            $sql->execute(array(
            "IdService"=>$Service->IdService,
            "NomService"=>$Service->NomService));  

     } catch (Exception $ex) {
         echo $ex->getMessage();
     }
   }
}