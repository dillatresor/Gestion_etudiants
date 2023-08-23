<?php

session_start();
$user = $_SESSION["user"];

require_once("../../base.php");
require_once("../../autoload.php");

$bd = bd();

function refractor($id)
{
  $db = bd();
  $direct = new VisiteurManager($db);
  $get = $direct->get($id);
  return $get->NomVisiteurs . " " . $get->PrenomVisiteurs;
}

function refractoragent($id)
{
  $db = bd();
  $direct = new PersonnelManager($db);
  $get = $direct->get($id);
  return $get->NomPersonnel . " " . $get->PrenomPersonnel;
}

$visitManag = new VisiteManager($bd);
$list = $visitManag->liste();

if (isset($_GET['idVisites'])) {
  $visitManag->delete($_GET['idVisites']);
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

    <div class="mt-3 pull-right d-flex ignore">
      <i class="fa fa-user mr-3 user ignore"> <span class="ml-2"> <?= $user["statut"]; ?> </span> </i>
      <button class="btn btn-info ignore"> <a class="text-light" href="../../index.php"> Deconnexion </a> </button>
    </div>

    <div class="bienvenu">LISTE DES VISITES</div>
    <div class="global-content">
      <div class="contenu ignore">
        <?php
        include('../../include/aside.php');
        ?>
      </div>
      <div class="cache">
        <div class="c-table">
          <button type="button" class="btn btn-info m-3 ignore"> <a class="text-light" href="visitJour.php"> Visite du jour </a> </button>
          <button type="button" class="btn btn-info m-3 ignore"> <a class="text-light" href="visitCours.php"> Visite en cours </a> </button>
          <table class="table table-bordered">
            <thead>
              <tr id="ligne">
                <th scope="col">N°</th>
                <th scope="col">Nom Visiteur</th>
                <th scope="col">Agent Visité</th>
                <th scope="col">Date du visite</th>
                <th scope="col">Début</th>
                <th scope="col">Fin</th>
                <th class="ignore" scope="col">Detail</th>
                <th class="ignore" scope="col">Modifier</th>
                <th class="ignore" scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <tr>
                <?php
                foreach ($list as $key => $value) {
                ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= refractor($value->numCnib) ?></td>
                <td><?= refractoragent($value->MllePersonnel) ?></td>
                <td><?= $value->DateVisite ?></td>
                <td><?= $value->DebutVisites ?></td>
                <td><?= $value->FinVisites ?></td>
                <td class="ignore"><a href="detail.php?idVisites=<?= $value->idVisites ?>" type="button"> <i class="fa fa-user log3"></i> </a></td>
                <td class="ignore"><a <?= Compte::cons($user["statut"]) ?> href="edit.php?idVisites=<?= $value->idVisites ?>" type="button"> <i class="fa fa-edit log"></i> </a></td>
                <td class="ignore"><a <?= Compte::cons($user["statut"]) ?> <?= Compte::adm($user["statut"]) ?> href="list.php?idVisites=<?= $value->idVisites ?>" type="button"> <i class="fa fa-trash-o log2"></i> </a></td>
              </tr>
            <?php
                }
            ?>
            </tr>
            </tbody>
          </table>
          <button <?= Compte::cons($user["statut"]) ?> type="button" class="btn btn-info pull-left mb-3"> <a class="text-light" href="new.php"> Nouveau <i class="fa fa-plus"></i> </a> </button>
          <button id="print" <?= Compte::cons($user["statut"]) ?> type="button" class="ml-2 btn btn-info pull-left mb-3 ignore"> Imprimer <i class="fa fa-print"></i> </button>
        </div>
      </div>
    </div>
    <?php
    include('../../include/footer.php');
    ?>
  </div>
  <script src="../../font/js/script.js"></script>
</body>

</html>