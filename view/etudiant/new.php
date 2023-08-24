<?php

session_start();
$user = $_SESSION["user"];

require_once("../../base.php");
require_once("../../autoload.php");

$bd = bd();
$etudCont = new etudiantControleur($bd);


if (isset($_POST['idetudiant']) and $_POST['id_filiere'] and $_POST['id_niveau'] and $_POST['Nom'] and $_POST['Prenom'] and $_POST['date_naissance'] and $_POST['matricule'] and $_POST['adresse'] and $_POST['email']and $_POST['contact']) and $_POST['nationalite'] {
 
  $etudCont = new etudiantControleur($bd);
  $etud = new etudiant($_POST);
  $etudCont->add($etud);
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

    <div class="bienvenu">INSERTION D'UN ETUDIANT</div>
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
            <input type="text" class="champ" name="id_etudiant">
            <label for="">FILIERE</label>
            <select name="genre" class="form-control m-2">
              <option value="">Choisir</option>
              <option>Informatique</option>
              <option>Comptabilité</option>
              </select>
            <label for="">niveau</label>
            <select name="genre" class="form-control m-2">
              <option value="">choisir</option>
              <option>1ère année</option>
              <option>2ème année</option>
              <option>licence</option>
              <option>master</option>
              </select>
            
            </select>
            <label for="">Nom</label>
            <input type="text" class="champ" name="Nom" required>
            <label for="">Prénom</label>
            <input type="text" class="champ" name="Prenom" required>
            <label for="">date_naissance</label>
            <input type="date" class="champ" name="date_naissance" required>
            <label for="">matricule</label>
            <input type="text" class="champ" name="matricule" required>
            <label for="">adresse</label>
            <input type="text" class="champ" name="adresse" required>
            <label for="">email</label>
            <input type="text" class="champ" name="email" required>
            <label for="">contact</label>
            <input type="text" class="champ" name="contact" required>
            <label for="">nationalite</label>
            <input type="text" class="champ" name="nationalite" required>
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