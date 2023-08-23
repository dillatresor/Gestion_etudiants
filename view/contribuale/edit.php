<?php 

session_start();
$user=$_SESSION["user"];

require_once ("../../base.php");
require_once ("../../autoload.php");

$bd= bd();
$contribM =new ContribuableManager($bd);
if(isset($_POST['numIfu']) and $_POST['NomEntreprise'] and $_POST['DirectionE'] and $_POST['RegimeFiscal'])
{
    $contribM =new ContribuableManager($bd);
    $contrib=new Contribuable($_POST);
    $contribM->edit($contrib);
    header("location: list.php");
}

if(isset($_GET['numIfu']))
{
    $numIfu=$_GET['numIfu'];
    $value=$contribM->get($numIfu);
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

        <div class="bienvenu">MODIFIER LE CONTRIBUABLE</div>
      <div class="global-content">
        <div class="contenu">
        <?php
             include('../../include/aside.php');
        ?>
        </div>
            <div class="cache">
                <div class="c-table">
                    <p style="color: red;">Veillez remplir les champs * </p>
            <form class=" form p-4 d-flex flex-column w-100" action="edit.php" method="post" enctype="multipart/form-data">
                <label for="">N° Ifu</label>
                <input type="text" class="champ" name="numIfu" value="<?= $value->numIfu?>"> <br>
                <label for="">Nom contribuable</label>  
                <input type="text" class="champ" name="NomEntreprise" value="<?= $value->NomEntreprise?>"> <br>
                <label for="">Direction</label>      
                <input type="text" class="champ" name="DirectionE" value="<?= $value->DirectionE?>"> <br>
                <label for="">Regime Fiscal</label>   
                <input type="text" class="champ" name="RegimeFiscal" value="<?= $value->RegimeFiscal?>"> <br>      

                <div class="panel-footer mt-3">
                <button type="submit" class="btn btn-info pull-left mr-3">Modifier <i class="fa fa-check-square-o ml-2"></i> </button>
                    <button type="button" class="btn btn-info pull-left"> <a class="text-light" href="list.php"> Fermer <i class="fa fa-close"></i> </a></button>
                </div>
            </form>

                </div>
            </div>
      </div>
        <?php
             include('../../include/footer.php');
        ?>
    </div>
    
</body>
</html>