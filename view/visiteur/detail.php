<?php 

session_start();
$user=$_SESSION["user"];

require_once ("../../base.php");
require_once ("../../autoload.php");

$bd= bd();
$visiManag =new VisiteurManager($bd);
$vis=new Visiteur($_POST);
$visiManag->liste($vis);

if(isset($_GET['numCnib']))
{
    $numCnib=$_GET['numCnib'];
    $value=$visiManag->get($numCnib);
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
        
        <div class="bienvenu">DETAIL DU VISITEUR N°: <?= $value->numCnib?></div>
      <div class="global-content">
        <div class="contenu">
        <?php
             include('../../include/aside.php');
        ?>

        </div>
            <div class="cache">
                <div class="c-table">

            <div class=" form p-4 d-flex flex-column w-100">
                <p class="detail"><span class="t-gauche mr-5"> Nom:</span> <span class="t-droit"><?= $value->NomVisiteurs?> </span> </p>
                <p class="detail"><span class="t-gauche mr-5"> Prénom:</span> <span class="t-droit"><?= $value->PrenomVisiteurs?></span></p>
                <p class="detail"><span class="t-gauche mr-5"> Téléphone:</span> <span class="t-droit"><?= $value->TelVisiteurs?></span></p>               
                <p class="detail"><span class="t-gauche mr-5"> photo:</span></p>
                <p class="ml-4"><img class="mr-5 v-image" src=" <?= $value->PhotoVisiteur?>"> </p>
            </div>
            <button type="button" class="btn btn-info pull-left mb-3 ml-4"> <a class="text-light" href="list.php"> Fermer <i class="fa fa-close"></i> </a></button>
                </div>
            </div>
      </div>
        <?php
             include('../../include/footer.php');
        ?>
    </div>
    
</body>
</html>
