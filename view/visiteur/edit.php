<?php 
session_start();
$user=$_SESSION["user"];

require_once ("../../base.php");
require_once ("../../autoload.php");

$bd= bd();
$visiManag =new VisiteurManager($bd);

$contri=new ContribuableManager($bd);
$listContri=$contri->liste();

if(isset($_POST['numCnib']) and $_POST['numIfu'] and $_POST['NomVisiteurs'] and $_POST['PrenomVisiteurs'] and $_POST['TelVisiteurs'] and $_FILES['PhotoVisiteur'])
{
    move_uploaded_file($_FILES['PhotoVisiteur']['tmp_name'], '../../font/photos/'.$_POST['numCnib'].'photo.jpg');
    $_POST['PhotoVisiteur']='../../font/photos/'.$_POST['numCnib'].'photo.jpg';

    $visiManager =new VisiteurManager($bd);
    $vis=new Visiteur($_POST);
    $visiManager->edit($vis);
    header("location: list.php");
}

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

        <div class="bienvenu">MODIFIER UN VISITEUR</div>
      <div class="global-content">
        <div class="contenu">
        <?php
             include('../../include/aside.php');
        ?>
        </div>
            <div class="cache">
                <div class="c-table">
                    <p style="color: red;">Veillez remplir les champs * </p>

            <form class=" form p-4 d-flex flex-column w-100" action="new.php" method="POST" enctype="multipart/form-data">
                <label for="">Cnib Visiteur</label>
                <input type="text" class="champ" name="numCnib" value="<?= $value->numCnib?>">
                <label for="">Nom contribuable</label>
                <!-- <input type="text" class="champ" name="numIfu" value="<?= $value->numIfu?>">  -->
                <select class="champ" name="numIfu">
                <?php
                    foreach($listContri as $key){
                  ?> 
                    <option value="<?php echo $key->numIfu ?>"><?php echo $key->NomEntreprise?></option>;
                  <?php
                  }
                  ?>
                </select>
                <label for="">Nom</label>      
                <input type="text" class="champ" name="NomVisiteurs" value="<?= $value->NomVisiteurs?>">
                <label for="">Prénom</label>   
                <input type="text" class="champ" name="PrenomVisiteurs" value="<?= $value->PrenomVisiteurs?>">
                <label for="">N° Téléphone</label>   
                <input type="text" class="champ" name="TelVisiteurs" value="<?= $value->TelVisiteurs?>"> 
                <label for="">Photo du visiteur</label>   
                <input type="file" class="champ" name="PhotoVisiteur" value="<?= $value->PhotoVisiteur?>">       

                <div class="panel-footer mt-3">
                    <button type="submit" class="btn btn-info pull-left mr-3" value=''>  Enregistrer <i class="fa fa-check-square-o"></i></button>
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
