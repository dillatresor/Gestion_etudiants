<?php
require_once ("base.php");
  include("class/Compte.class.php");
  $bd= bd();
  $compte =new Compte($bd);
if (isset($_POST["username"]) AND isset($_POST["password"])) {
    
    $user=$compte->authenticate($_POST["username"],$_POST["password"]);
    if ($user!=false) {
        session_start();
        $_SESSION["user"]=$user[0];
        header("location:acceuil.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>connexion</title>
	<link rel="icon" href="picture/simplonco ulule.png" type="image">
	<link rel="stylesheet" media="screen" href="font/css/login.css">
	<link rel="stylesheet" href="font/css/font-awesome.min.css">
	<link rel="stylesheet" href="font/css/bootstrap.min.css">
	<link rel="stylesheet" href="font/css/style.css">
</head>

<body class="bg-danger"> 
         
             <div class="bg-premary ">
		<div class=" right bg-primary align-items-cente">
			<img src="font/picture/Logo-Universite-Thomas-Sankara.png" alt="image lest" class="ent-img">
		</div>
		<h3 class="auth m-3 text-white">S'AUTHENTIFIER</h3>
		<form class=" form p-4 d-flex flex-column w-100" action="" method="POST" enctype="multipart/form-data">
			<label for="" class="text-white text-center">Nom d'utilisateur</label>
			<input type="text" class="champ container d-flex justify-content-center align-items-center w-50 text-center" name="username"
			 required>
			<label for="" class="text-white text-center">Mot de passe</label>
			<input type="password" class="champ container d-flex justify-content-center align-items-center w-50 text-center" name="password">
			<div class="panel-footer mt-6 mx-auto justify-content-center">
				<button type="submit" class="btn btn-dark text-center"> Se Connecter </button>
			</div>
           
		</form>
	</div>
</body>

</html>