<?php 

session_start();
$user=$_SESSION["user"];

require_once ("../../base.php");
require_once ("../../autoload.php");

$bd=bd();
$persManager=new PersonnelManager($bd);
$service=new ServiceManager($bd);
$list=$service->liste();
if(isset($_POST['MllePersonnel']) and $_POST['IdService'] and $_POST['NomPersonnel'] and $_POST['PrenomPersonnel'] and $_POST['Emploie']
and $_POST['Categorie'])

{
    $persManager =new PersonnelManager($bd);
    $pers=new Personnel($_POST);
    $persManager->add($pers);
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

        <div class="bienvenu">INSERTION D'UN AGENT</div>
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
                <label for="">Matricule Agent</label>
                <input type="text" class="champ" name="MllePersonnel">
                <label for="">Service lié</label>
                <select class="champ" name="IdService">
                  <?php
                    foreach($list as $key){
                  ?> 
                    <option value="<?php echo $key->IdService ?>"><?php echo $key->NomService?></option>;
                  <?php
                  }
                  ?>
                </select>
                <label for="">Nom</label>      
                <input type="text" class="champ" name="NomPersonnel" required>
                <label for="">Prénom</label>   
                <input type="text" class="champ" name="PrenomPersonnel" required>
                <label for="">Emploie</label>   
                <input type="text" class="champ" name="Emploie" required> 
                <label for="">Catégorie</label>   
                <input type="text" class="champ" name="Categorie">       

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