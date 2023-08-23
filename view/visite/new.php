<?php

session_start();
$user = $_SESSION["user"];

require_once("../../base.php");
require_once("../../autoload.php");

$bd = bd();
$visiManager = new VisiteManager($bd);

$agent = new PersonnelManager($bd);
$listPers = $agent->liste();
$service = new ServiceManager($bd);
$listservice = $service->liste();
$visit = new VisiteurManager($bd);
$listVisit = $visit->liste();

if (
  isset($_POST['MllePersonnel']) and $_POST['numCnib'] and $_POST['DateVisite']
  and $_POST['DebutVisites'] and $_POST['FinVisites'] and $_POST['TypeVisites'] and $_POST['Idservice'] and $_POST['ObsVisites']
) {
  $visiManager = new VisiteManager($bd);
  $visit = new Visite($_POST);
  $visiManager->add($visit);
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
      <i class="fa fa-user mr-3 user"> <span class="ml-2"> <?= $user["statut"]; ?> </span> </i>
      <button class="btn btn-info"> <a class="text-light" href="../../index.php"> Deconnexion </a> </button>
    </div>

    <div class="bienvenu">INSERTION D'UNE VISITE</div>
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
            <label for="">Visiteur</label>
            <select class="champ" name="numCnib">
              <?php
              foreach ($listVisit as $key) {
              ?>
                <option value="<?php echo $key->numCnib ?>"> <?php echo $key->NomVisiteurs ?> <?php echo $key->PrenomVisiteurs ?> </option>;
              <?php
              }
              ?>
            </select>
            <label for="">Service</label>
            <select class="champ" name="Idservice">
              <?php
              foreach ($listservice as $key) {
              ?>
                <option value="<?php echo $key->IdService ?>"> <?php echo $key->NomService ?></option>;
              <?php
              }
              ?>
            </select>

            <label for="">Agent</label>
            <select class="champ" name="MllePersonnel">
              <?php
              foreach ($listPers as $key) {
              ?>
                <option value="<?php echo $key->MllePersonnel ?>"> <?php echo $key->NomPersonnel ?> <?php echo $key->PrenomPersonnel ?></option>;
              <?php
              }
              ?>
            </select>
            <label for="">Date du visite</label>
            <input type="date" value="date('Y/m/d')" class="champ" name="DateVisite" readonly>
            <label for="">Heure d'entrée</label>
            <input type="time" id="heure" class="champ" name="DebutVisites">
            <label for="">Heure de sortie</label>
            <input type="time" class="champ" name="FinVisites" value="00:00:00" readonly>
            <label for="">Type de visite</label>
            <input type="text" class="champ" name="TypeVisites" required>
            <label for="">Observation</label>
            <input type="text" class="champ" name="ObsVisites">

            <div class="panel-footer mt-3">
              <button type="submit" class="btn btn-info pull-left mr-3">Enregistrer <i class="fa fa-save"></i></button>
              <button type="button" class="btn btn-info pull-left"> <a class="text-light" href="list.php"> Fermer <i class="fa fa-close"></i></a></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
    include('../../include/footer.php');
    ?>

  </div>

  <script type="text/javascript">
    //recuperation de nos champs dans le DOM
    var champDate = document.getElementById('date');
    var champHeure = document.getElementById('heure');

    //instanciation d'un objet date de javascript.
    var date = new Date();

    //fonction qui permet d'ajouter un ZERO si le nombre retourné est inferieur à 10 dans le but de correspondre au format de date et heure de HTML5       
    function f(variable) {
      if (variable < 10) {
        return '0' + variable;
      } else {

        return variable;
      }
    }

    //fonction qui permet de retourner une chaine de caractere comportant l'heure dans un format adhéquat
    function heureDeMaintenant() {

      var heure = date.getHours();
      var min = date.getMinutes();
      var sec = date.getSeconds();

      return f(heure) + ':' + f(min);
    }

    //fonction qui permet de retourner une chaine de caractere comportant la date dans un format adhéquat
    function dateDeMaintenant() {

      var annee = date.getFullYear();
      var mois = date.getMonth();
      var jours = date.getDate();

      return annee + '-' + '0' + mois + '-' + jours;
    }

    if (date.getFullYear() < 2022 || date.getFullYear() > 2022) {

      //si la date n'est pas l'annee en cours demander a l'utilisateur de regler l'heure et la date de son ordinateur.

      alert('ATTENTION!!!\n il se peut que l\'heure ou la date de votre ordinateur soit incorrecte\nVeuillez les regler ou contacter le super administrateur du systeme pour une mise à jours du systeme');

    } else {

      //Sinon on insere les données courantes de la date et l'heure.
      champHeure.value = heureDeMaintenant();
      champDate.value = dateDeMaintenant();
    }
  </script>

</body>

</html>