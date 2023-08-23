    <?php
    session_start();
    $user = $_SESSION["user"];
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="font/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="font/font-awesome/css/font-awesome.min.css">
        <script type="text/javascript" src="font/js/jquery/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="font/css/style.css">
        <title>Acceuil</title>
    </head>

    <body>

        <div class="container" id="container">
            <div class="container" id="banniere">
                <div class="div-1">
                    <img src="font/picture/unnamed.jpg" alt="logo de gauche" class="logo">
                </div>
                <div class="welcom">
                    <p>UNE PLATEFORME POUR LES ETUDIANTS</p>
                </div>

                
                <div class="mt-3 pull-right d-flex">
                <i class="fa fa-user mr-3 user"> <span class="ml-2"> <?= $user["statut"]; ?> </span> </i>
                <button class="btn btn-info"> <a class="text-light" href="index.php"> Deconnexion </a> </button>
            </div>  
                
            </div>

           

            <div class="bienvenu">BIENVENUE DANS GESTUDIANT</div>
            <div class="global-content">
                <div class="contenu">
                    <aside class="d-flex flex-column p-3">
                        <h3 id="navig">Menu</h3>
                        <h3 class="btn btn-info p-3 m-1"> <a class="text-light h-100 w-100" href="view/visite/list.php"> ETUDIANTS </a> </h3>
                        <h3 class="btn btn-info p-3 m-1"> <a class="text-light h-100 w-100" href="view/visiteur/list.php">FILIERES </a></h3>
                        <h3 class="btn btn-info p-3 m-1"> <a class="text-light h-100 w-100" href="view/personnel/list.php"> NIVEAU D'ETUDE </a></h3>
               
                    </aside>

                </div>
                <div class="page">
                    <img src="font/picture/thomas.png" alt="logo de droit" class="minifed">
                </div>
            </div>
            <?php
            include('include/footer.php');
            ?>
        </div>

    </body>

    </html>