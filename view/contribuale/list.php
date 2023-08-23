<?php

session_start();
$user = $_SESSION["user"];

require_once("../../base.php");
require_once("../../autoload.php");

$bd = bd();
$contribM = new ContribuableManager($bd);
$list = $contribM->liste();

if (isset($_GET['numIfu'])) {
  $contribM->delete($_GET['numIfu']);
  header("location: list.php");
}
?>

<?php
include('../../include/head.php');
?>

<!DOCTYPE html>
<html lang="fr">

<body>

  <div class="container" id="container">
    <?php
    include('../../include/header.php');
    ?>

    <div class="mt-3 pull-right d-flex">
      <i class="fa fa-user mr-3 user"> <span class="ml-2"> <?= $user["statut"]; ?> </span> </i>
      <button class="btn btn-info"> <a class="text-light" href="../../index.php"> Deconnexion </a> </button>
    </div>

    <div class="bienvenu">LISTE DES CONTRIBUABLES</div>
    <div class="global-content">
      <div class="contenu">
        <?php
        include('../../include/aside.php');
        ?>
      </div>
      <div class="cache">
        <div class="tbl-header">
          <table cellpadding="0" cellspacing="0" border="0">
            <thead>
              <tr id="ligne">
                <th scope="col">N°</th>
                <th scope="col">N° Ifu</th>
                <th scope="col">Nom contribuable</th>
                <th scope="col">Direction</th>
                <th scope="col">Regime Fiscale</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="tbl-content">
          <table cellpadding="0" cellspacing="0" border="0">
            <tbody>
              <tr>
                <?php
                foreach ($list as $key => $value) {
                ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $value->numIfu ?></td>
                <td><?= $value->NomEntreprise ?></td>
                <td><?= $value->DirectionE ?></td>
                <td><?= $value->RegimeFiscal ?></td>
                <td><a <?= Compte::cons($user["statut"]) ?> href="edit.php?numIfu=<?= $value->numIfu ?>" type="button"> <i class="fa fa-edit log"></i> </a></td>
                <td><a <?= Compte::cons($user["statut"]) ?> <?= Compte::adm($user["statut"]) ?> href="list.php?numIfu=<?= $value->numIfu ?>" type="button" id="del"> <i class="fa fa-trash-o log2"></i> </a></td>
              </tr>
            <?php
                }
            ?>
            </tr>
            </tbody>
          </table>
        </div>
        <button <?= Compte::cons($user["statut"]) ?> type="button" class="btn btn-info pull-left mt-3"> <a class="text-light" href="new.php"> Nouveau <i class="fa fa-plus"></i> </a> </button>
      </div>
    </div>
    <?php
    include('../../include/footer.php');
    ?>
  </div>

</body>

</html>