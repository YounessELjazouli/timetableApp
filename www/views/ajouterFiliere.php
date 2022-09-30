<?php 
    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootsfonts/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootsfonts/fontawesome-free-6.0.0-web/css/all.css">
    <link rel="stylesheet" href="style.css">
    <script src="jquery.js"></script>
    <script src="script.js" defer></script>
    <title>Ajouter Formateur/Formatrice :</title>
</head>
<body>
<?php include 'dashMenu.php'; ?>

<div  class="container-fluid" id="content-add-filiere">
    <div class="row">
        <div class="col-sm-2 dashFiliere">
            <img src="../images/filieres.png" class="filiere_image">
            <h6 class="text-center">Ajouter un filiére : </h6>
            <div class="addTFiliereFormWrapper">
                <span id="message"></span>
                <form method="POST" id="filiereForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="codeFil" name="codeFil">
                        <label for="codeFil">Code de Filiere</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nomFil" name="nomFil">
                        <label for="nomFil">Nom de Filiere</label>
                    </div>
                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-success" id="submitFiliere" name="ajouterSalle"  onclick="save_filiere();return false;">Ajouter Filiére</button>
                    </div>
                </form>
            </div>
        </div>
        <div class='col-sm-8 mainFiliere'>
            <div id="filiereList"  class="mt-4">
                
                <?php
                    $select1 = new SQLiteSelect($cnx);
                    $filieres = $select1->getFilieres();
                    echo "<center><table class=' table table-dark table-striped table-hover w-100'>
                    <thead><tr class='table-secondary'><td>Code de Filiere</td><td>Nom de Filiere</td></tr><tbody>";
                    foreach($filieres as $filiere){
                        echo "<tr><td>".$filiere['codeFiliere']."</td><td>".$filiere['nomFiliere']."</td></tr>";
                    }
                    echo "</tbody></table>";
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function save_filiere(){
        var form_element = document.getElementsByClassName('form-control');
        var form_data = new FormData();
        for(var count = 0;count<form_element.length;count++){
            form_data.append(form_element[count].name,form_element[count].value);
        }
        document.getElementById('submitFiliere').disabled = true;
        var ajax_request = new XMLHttpRequest();
        ajax_request.open("POST","create.php");
        ajax_request.send(form_data);
        ajax_request.onreadystatechange = function(){
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                document.getElementById('submitFiliere').disabled = false;
                document.getElementById('filiereForm').reset();
                document.getElementById('message').innerHTML = ajax_request.responseText
                setTimeout(function(){
                    document.getElementById('message').innerHTML = "";
                },2000)
                
            }
        }

    }

</script>
</body>
</html>