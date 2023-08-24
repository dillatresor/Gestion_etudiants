<?php 
session_start();
$user=$_SESSION["user"];

require_once ("../../base.php");
require_once ("../../autoload.php");

$bd= bd();
$etudCont =new etudiantControle($bd);

$contri=new ContribuableManager($bd);
$listContri=$contri->liste();

if(isset($_POST['idetudiant']) and $_POST['id_filiere'] and $_POST['id_niveau'] and $_POST['nom'] and $_POST['prenom'] and $_POST['date_naissance'] and $_POST['nationalite'] and $_POST['adresse'] and $_POST['email'] and $_POST['telephone'])
{

    $etudCont =new etudiantControle($bd);
    $etu=new etudiant($_POST);
    $etudCont->edit($etud);
    header("location: list.php");
}

if(isset($_GET['etudiant']))
{
    $idetudiant=$_GET['etudiant'];
    $value=$etudCont->get($idetudiant);
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

        <div class="bienvenu">MODIFIER UN ETUDIANT</div>
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
                <label for="">idetudiant</label>
                <input type="text" class="champ" name="idetudiant" value="<?= $value->idetudiant?>">
                <label for="">Nom_filiere</label>
                <!-- <input type="text" class="champ" name="id_filiere" value="<?= $value->id_filiere?>">  -->
                <label for="">Nom_niveau</label>
                <!-- <input type="text" class="champ" name="id_niveau" value="<?= $value->id_niveau?>">  -->
                <select class="champ" name="id_niveau">
                <?php
                    foreach($listContri as $key){
                  ?> 
                    <option value="<?php echo $key->id_filiere ?>"><?php echo $key->nom_filiere?></option>;
                  <?php
                  }
                  ?>
                </select>
                <label for="">Nom</label>      
                <input type="text" class="champ" name="Nom" value="<?= $value->Nom?>">
                <label for="">Prénom</label>   
                <input type="text" class="champ" name="Prenom" value="<?= $value->Prenom?>">
                <label for="">date_naissance</label>   
                <input type="text" class="champ" name="date_naissance" value="<?= $value->date_naissnace?>"> 
                <label for="">nationalite</label>   
                <input type="text" class="champ" name="nationalite" value="<?= $value->nationalite?>">  
                <label for="">adresse</label>   
                <input type="text" class="champ" name="adresse" value="<?= $value->adresse?>">
                <label for="">email</label>   
                <input type="text" class="champ" name="email" value="<?= $value->email?>"> 
                <label for="">telephone</label>   
                <input type="text" class="champ" name="nationalite" value="<?= $value->telephone?>">       
     

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
