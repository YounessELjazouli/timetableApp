<?php 
    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;

?>

<?php include 'dashMenu.php'; ?>

<div  class="container-fluid" id="content-add-group">
    <div class="row">
        <div class="col-sm-2 dashGroupe">
            <img src="../images/groupes.jpg" class="groupe_image">
            <h4 class="text-center">Ajouter un groupe : </h4>
            <div class="addTeacherFormWrapper">
                <span id="message"></span>
                <form method="POST" id="groupeForm">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="codeGr" name="codeGr">
                        <label for="codeGr">Code de Groupe</label>
                    </div>
                    <select name="filiereGr" id="filiereGr" class="form-control my-3">
                        <option disabled selected>Choisir un Filiere : </option>
                        <?php
                        $select1 = new SQLiteSelect($cnx);
                        $filieres = $select1->getFilieres();
                        foreach($filieres as $filiere){
                            echo "<option value='".$filiere['codeFiliere']."'>".$filiere['nomFiliere']."</option>";
                        }
                        ?>
                    </select>
                    <select name="anneeGr" id="anneeGr" class="form-control my-3">
                        <option disabled selected>Choisir L'année de formation  : </option>
                        <option value="1A">1ére Année</option>
                        <option value="2A">2éme Année</option>
                    </select>
                    <div class="input-group my-3">
                        <button type="button" class="btn btn-success" id="submit" name="ajouterGroupe"  onclick="save_groupe();return false;">Ajouter Groupe</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8 mainGroup">
            <div id="groupeList"  class="my-5">
                
                <?php
                    $select1 = new SQLiteSelect($cnx);
                    $groupes = $select1->getGroupes();
                    echo "<center><table class='table table-secondary table-striped table-hover'>
                    <thead><tr class='table-secondary'><td>Code de Groupe</td><td>Filiere</td><td>Année de formation</td></tr><tbody>";
                    foreach($groupes as $groupe){
                        echo "<tr><td>".$groupe['codeGroupe']."</td><td>".$groupe['nomFiliere']."</td><td>".$groupe['annee']."</td></tr>";
                    }
                    echo "</tbody></table>";
                ?>
            </div>
        </div>
    </div>
</div>
    <script>
        function save_groupe(){
            var form_element = document.getElementsByClassName('form-control');
            var form_data = new FormData();
            for(var count = 0;count<form_element.length;count++){
                form_data.append(form_element[count].name,form_element[count].value);
            }
            document.getElementById('submit').disabled = true;
            var ajax_request = new XMLHttpRequest();
            ajax_request.open("POST","create.php");
            ajax_request.send(form_data);
            ajax_request.onreadystatechange = function(){
                if(ajax_request.readyState == 4 && ajax_request.status == 200){
                    document.getElementById('submit').disabled = false;
                    document.getElementById('groupeForm').reset();
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