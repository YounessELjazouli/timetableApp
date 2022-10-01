

<!DOCTYPE html>
<?php 

    // require '../vendor/autoload.php';

    // require '../cnx.php';

?>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootsfonts/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootsfonts/fontawesome-free-6.0.0-web/css/all.css">
    <link rel="stylesheet" href="bootsfonts/style.css">
    <script src="bootsfonts/jquery.js"></script>
    <script src="bootsfonts/script.js" defer></script>
    <title>Accueil</title>
    <?php require_once('menuStyle.php'); ?>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-1 sideBarMenu">
            <div class="menuItem"><a href="#"><i class="fa-solid fa-home"></i></a></div>
            <div class="menuItem"><a href="views/ajouterF.php"><i class="fa-solid  fa-chalkboard-teacher"></i></a></div>
            <div class="menuItem"><a href="views/ajouterFiliere.php"><i class="fa-solid fa-school"></i></a></div>
            <div class="menuItem"><a href="views/ajouterGroupe.php"><i class="fa-solid fa-clock"></i></a></div>
            <div class="menuItem"><a href="ajouterModule.php"><i class="fa-solid fa-book"></i></a></div>
            <div class="menuItem"><a href="ajouterSalle.php"><i class="fa-solid fa-door-closed"></i></a></div>
            <div class="menuItem"><a href="voirSalleDispo.php"><i class="fa-solid fa-door-open"></i></a></div>
            <div class="menuItem"><a href="ajouterCours.php"><i class="fa-solid fa-calendar-check"></i></a></div>
            <div class="menuItem"><a href="voirF.php"><i class="fa-solid fa-calendar"></i></a></div>

        </nav>
        <div class="col-sm-11">
            <div class="container-fluid homeWrapper">
                <div class="row" style='justify-content:space-around;'>
                    <div class="col-sm-2">
                        <img src="images/logo.png" alt="logo" class="logoOfppt">
                    </div>
                    <div class="col-sm-7 mainInterface">
                        <p class="text-center">مركب التكوين المهني تمارة</p>
                        <p class="text-center">COMPLXE DE FORMATION PROFESSIONELLE TEMARA</p>
                        <p class="text-center separer">المعهد المتخصص للتكنولوجيا التطبيقية تمارة</p>
                        <p class="text-center">INSTITUT SPECIALISE DE TECHNOLOGIE APPLIQUEE TEMARA</p>
                    </div>
                    <div class="col-sm-3">
                        <img src="images/logo.png" alt="logo" class="logoOfppt">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header">
                                Formateurs
                            </div>
                            <div class="card-body">
                                <img src="images/formateur.jpg" class="img-thumbnail">
                            </div>
                            <div class="card-footer">
                                <?php 
                                    // $sql1 = "SELECT COUNT(*) FROM formateur";
                                    // $req = $cnx->prepare($sql1);
                                    // $req->execute();
                                    // echo $req->fetch(PDO::FETCH_NUM)

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header">
                                Filiéres
                            </div>
                            <div class="card-body">
                                <img src="images/filieres.png" class="img-thumbnail">
                            </div>
                            <div class="card-footer">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header">
                                Salles
                            </div>
                            <div class="card-body">
                                <img src="images/salle.jpg" class="img-thumbnail">      
                            </div>
                            <div class="card-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <script>



    </script>
    
</body>
</html>