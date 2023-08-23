<?php

session_start();
$user = $_SESSION["user"];

require_once("../../base.php");
require_once("../../autoload.php");

function refractor($id)
{
  $db = bd();
  $direct = new ServiceManager($db);
  $get = $direct->get($id);
  return $get->NomService;
}

$bd = bd();
$persManag = new PersonnelManager($bd);
$list = $persManag->liste();

if (isset($_GET['MllePersonnel'])) {
  $persManag->delete($_GET['MllePersonnel']);
  header("location: list.php");
}
?>

<?php
include('../../include/head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">

<body>

  <div class="container" id="container">
    <?php
    include('../../include/header.php');
    ?>

    <div class="mt-3 pull-right d-flex">
      <i class="fa fa-user mr-3 user"> <span class="ml-2"> <?= $user["statut"]; ?> </span> </i>
      <button class="btn btn-info"> <a class="text-light" href="../../index.php"> Deconnexion </a> </button>
    </div>

    <div class="bienvenu">LISTE DES PERSONNELS</div>
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
              <tr>
              <th scope="col">N°</th>
                <th scope="col">Matricule</th>
                <th scope="col">Service lié</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Emploie</th>
                <th scope="col">Catégorie</th>
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
                <td><?= $value->MllePersonnel ?></td>
                <td><?= refractor($value->IdService) ?></td>
                <td><?= $value->NomPersonnel ?></td>
                <td><?= $value->PrenomPersonnel ?></td>
                <td><?= $value->Emploie ?></td>
                <td><?= $value->Categorie ?></td>
                <td><a <?= Compte::cons($user["statut"]) ?> href="edit.php?MllePersonnel=<?= $value->MllePersonnel ?>" type="button"> <i class="fa fa-edit log"></i> </a></td>
                <td><a <?= Compte::cons($user["statut"]) ?> <?= Compte::adm($user["statut"]) ?> href="list.php?MllePersonnel=<?= $value->MllePersonnel ?>" type="button"> <i class="fa fa-trash-o log2"></i> </a></td>
              </tr>
            <?php
                }
            ?>
            </tr>
            </tbody>
          </table>
        </div>
        <button <?= Compte::cons($user["statut"]) ?> type="button" class="btn btn-info pull-left m-3"> <a class="text-light" href="new.php"> Nouveau <i class="fa fa-plus"></i> </a> </button>
      </div>
    </div>
    <?php
    include('../../include/footer.php');
    ?>
  </div>

</body>

</html>