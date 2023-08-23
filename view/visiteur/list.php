<?php
session_start();
$user = $_SESSION["user"];

require_once("../../base.php");
require_once("../../autoload.php");

$bd = bd();
$visiManag = new VisiteurManager($bd);
$list = $visiManag->liste();

if (isset($_GET['numCnib'])) {
  $visiManag->delete($_GET['numCnib']);
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

    <div class="bienvenu">LISTE DES VISITEURS</div>
    <div class="global-content">
      <div class="contenu">
        <?php
        include('../../include/aside.php');
        ?>

      </div>
      <div class="cache">
        <div class="c-table">
          <table class="table table-bordered">
            <thead>
              <tr id="ligne">
                <th scope="col">N°</th>
                <th scope="col">N° Cnib</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Detail</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <tr>
                <?php
                foreach ($list as $key => $value) {
                ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $value->numCnib ?></td>
                <td><?= $value->NomVisiteurs ?></td>
                <td><?= $value->PrenomVisiteurs ?></td>
                <td><?= $value->TelVisiteurs ?></td>
                <td><a href="detail.php?numCnib=<?= $value->numCnib ?>" type="button"> <i class="fa fa-user log3"></i> </a></td>
                <td><a <?= Compte::cons($user["statut"]) ?> href="edit.php?numCnib=<?= $value->numCnib ?>" type="button"> <i class="fa fa-edit log"></i> </a></td>
                <td><a <?= Compte::cons($user["statut"]) ?> <?= Compte::adm($user["statut"]) ?> href="list.php?numCnib=<?= $value->numCnib ?>" type="button"> <i class="fa fa-trash-o log2"></i> </a></td>
              </tr>
            <?php
                }
            ?>
            </tr>
            </tbody>
          </table>
          <button <?= Compte::cons($user["statut"]) ?> type="button" class="btn btn-info pull-left mb-3"> <a class="text-light" href="new.php"> Nouveau <i class="fa fa-plus"></i> </a> </button>
        </div>
      </div>
    </div>
    <?php
    include('../../include/footer.php');
    ?>
  </div>
</body>

</html>