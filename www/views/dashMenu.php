<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootsfonts/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../bootsfonts/fontawesome-free-6.0.0-web/css/all.css">
    <link rel="stylesheet" href="../bootsfonts/style.css">
    <script src="../bootsfonts/jquery.js"></script>
    <script src="../bootsfonts/script.js" defer></script>
    <title>Accueil</title>
    <style>
/* NAVIGATION*/
.navbar-menu {
    background-color: #fafafa;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 30px;
    
}

.navbar-menu.active { transform: translateX(0);transition: 0.5s; }

.navbar-menu .menu-listing { padding: 0;margin: 0;text-align: left; }

.menu-listing li { display: inline-block; }

.menu-listing div button {
    background-color: #fff;
    color: #262626;
    display: block;
    font-size: 1rem;
    height: 30px;
    line-height: 30px;
    padding: 0 20px;
    letter-spacing: 1px;
    text-decoration: none;
    transition: 0.5s;
}

.menu-listing div button:hover { 
    background-color: #262626;color: #fff;transition: 0.5s; 
}




  /* The dropdown1 container */
.dropdown1 {
  float: left;
  overflow: hidden;
}





/* Dropdown content (hidden by default) */
.dropdown1-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown1 */
.dropdown1-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown1 links on hover */
.dropdown1-content a:hover {
  background-color: #ddd;
}

/* Show the dropdown1 menu on hover */
.dropdown1:hover .dropdown1-content {
  display: block;
}
</style>
</head>
<body >
<nav class="navbar-menu">
<ul class="menu-listing">
    <div class="dropdown1">
        <button class="dropbtn">
            <a href="../index.php"><i class="fa-solid fa-home"></i></a>
        </button>
    </div>
    <div class="dropdown1">
        <button class="dropbtn">Formateurs/Formatrices
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <div class="dropdown1-content">
            <a href="ajouterF.php">Nouveau Formateurs</a>
        </div>
    </div>
    <div class="dropdown1">
        <button class="dropbtn">Filiére et groupes
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <div class="dropdown1-content">
            <a href="ajouterFiliere.php">Ajouter/Voir les Filieres</a>
            <a href="ajouterGroupe.php">Ajouter/Voir les groupes</a>
        </div>
    </div>
    <div class="dropdown1">
        <button class="dropbtn">Modules
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <div class="dropdown1-content">
            <a href="ajouterModule.php">Ajouter les Modules</a>
        </div>
    </div>
    <div class="dropdown1">
        <button class="dropbtn">Salles
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <div class="dropdown1-content">
            <a href="ajouterSalle.php">Nouveau Salle</a>
            <a href="voirSalleDispo.php">Voirs les salles disponibles</a>
        </div>
    </div>
    <div class="dropdown1">
        <button class="dropbtn">Emplois de temps
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <div class="dropdown1-content">
            <a href="ajouterCours.php">Planner un nouveau cours</a>
            <a href="voirF.php">Voirs les emplois de temps par date</a>

        </div>
    </div>
   

</ul>
</nav>

