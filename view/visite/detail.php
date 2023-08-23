<?php 

session_start();
$user=$_SESSION["user"];

require_once ("../../base.php");
require_once ("../../autoload.php");

function refractorvisiteur($id){
    $db=bd();
    $direct=new VisiteurManager($db);
    $get=$direct->get($id);
    return $get->NomVisiteurs." ".$get->PrenomVisiteurs;
  }
  
  function refractoragent($id){
    $db=bd();
    $direct=new PersonnelManager($db);
    $get=$direct->get($id);
    return $get->NomPersonnel." ".$get->PrenomPersonnel;
  }

$bd= bd();
$visiManag =new VisiteManager($bd);
$vis=new Visite($_POST);
$visiManag->liste($vis);

if(isset($_GET['idVisites']))
{
    $idVisites=$_GET['idVisites'];
    $value=$visiManag->get($idVisites);
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php
  include('../../include/head.php');
?>
<body>

    <div class="container" id="container">
        <?php
             include('../../include/header.php');
        ?>

    <div class="mt-3 pull-right d-flex">  
        <i class="fa fa-user mr-3 user"> <span class="ml-2"> <?= $user["statut"];?> </span> </i>
        <button class="btn btn-info"> <a class="text-light" href="../../index.php"> Deconnexion </a> </button>
    </div>
        
        <div class="bienvenu">DETAIL DU VISITEUR N°: <?= $value->idVisites?></div>
      <div class="global-content">
        <div class="contenu">
        <?php
             include('../../include/aside.php');
        ?>

        </div>
            <div class="cache">
                <div class="c-table">

            <div class=" form p-4 d-flex flex-column w-100">
                <p class="detail"><span class="t-gauche mr-5"> Visiteur:</span> <span class="t-droit"> <?=refractorvisiteur($value->numCnib)?> </span> </p>
                <p class="detail"><span class="t-gauche mr-5"> Agent Visité:</span> <span class="t-droit"><?=refractoragent($value->MllePersonnel)?></span></p>
                <p class="detail"><span class="t-gauche mr-5"> Date du visite:</span> <span class="t-droit"><?= $value->DateVisite?></span></p>
                <p class="detail"><span class="t-gauche mr-5"> Heure d'entrée:</span> <span class="t-droit"> <?= $value->DebutVisites?></span></p>
                <p class="detail"><span class="t-gauche mr-5"> Heure du sortie:</span> <span class="t-droit"> <?= $value->FinVisites?></span></p>
                <p class="detail"><span class="t-gauche mr-5"> Type de visite:</span> <span class="t-droit"> <?= $value->TypeVisites?></span></p>
                <p class="detail"><span class="t-gauche mr-5"> Observation:</span> <span class="t-droit"> <?= $value->ObsVisites?></span></p>
            </div>
            <button type="button" class="btn btn-info pull-left mb-3"> <a class="text-light" href="list.php"> Fermer <i class="fa fa-close"></i> </a></button>
                </div>
            </div>
      </div>
        <?php
             include('../../include/footer.php');
        ?>
    </div>
    
</body>
</html>
