<?php
require_once ("../../base.php");
require_once ("../../autoload.php");
if(isset($_POST)){
    $bd=bd();
    $visite=new VisiteManager($bd);
    echo json_encode($visite->getVisiteByservice($_POST['service'],$_POST['format']),JSON_FORCE_OBJECT);
}