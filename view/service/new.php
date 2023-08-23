<?php

session_start();
$user=$_SESSION["user"];

require_once ("../../base.php");
require_once ("../../autoload.php");

$bd=bd();
$servManag=new ServiceManager($bd);

if(isset($_POST['IdService']) and $_POST['NomService'])
{
    $servManag =new ServiceManager($bd);
    $serv=new Service($_POST);
    $servManag->add($serv);
    header("location: list.php");
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

        <div class="bienvenu">INSERTION D'UN SERVICE</div>
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
                <label for="">Code Service</label>
                <input type="text" class="champ" name="IdService" required>
                <label for="">Nom Service</label>
                <input type="text" class="champ" name="NomService" required>      

                <div class="panel-footer mt-3">
                    <button type="submit" class="btn btn-info pull-left mr-3">Enregistrer <i class="fa fa-check-square-o ml-2"></i> </button>
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