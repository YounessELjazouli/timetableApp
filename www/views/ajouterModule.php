<?php 
    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;

    include 'dashMenu.php'; 
 ?>

<div  class="container-fluid" id="content-add-module">
   <div class="row">
        <div class="col-sm-2 dashModule">
            <img src="../images/web.jpg" class="module_image">
            <h4 class="text-center">Ajouter Un Module : </h4>
            <div class="addTeacherFormWrapper">
                <span id="message"></span>
                <form method="POST" id="moduleForm">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="codeM" name="codeM">
                        <label for="nomF">Code de Module</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="titreM" name="titreM">
                        <label for="prenomF">Intitulé de Module</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" class="form-control" id="masseHoraireM" name="masseHoraireM">
                        <label for="masseHoraireF">Masse Horaire de Module</label>
                    </div>
                    <select class="form-select form-control my-3" aria-label="Default select example" name="filiereM" multiple size="6">
                        <option disabled>Choisir le/les filiére de ce Module :</option>

                        <?php
                        $select1 = new SQLiteSelect($cnx);
                        $filieres = $select1->getFilieres();
                        foreach($filieres as $filiere){
                            echo "<option value='".$filiere['codeFiliere']."'>".$filiere['codeFiliere']."</option>";
                        }
                        ?>
                    </select>
                    <div class="input-group my-3">
                        <button type="button" class="btn btn-success" name="addTeacher" id="submit" onclick="save_module();return false;"> Ajouter ce Module</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8 mainModule">
            <form  method="POST">
                <select class="form-select form-control-1" aria-label="Default select example" name="filiereM" id="weeks" size="4">
                    <option disabled Selected>choisir les semaines durant lesquelles ce cours aura lieu :</option>

                    <?php
                        $select2 = new SQLiteSelect($cnx);
                        $filieres = $select2->getFilieres();
                        foreach($filieres as $filiere){
                            echo "<option value='".$filiere['codeFiliere']."'>  ".$filiere['codeFiliere']." : ".$filiere['nomFiliere']."</option>";
                        }
                    ?>
                
                </select>
                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-success" id="submit" name="voirModule">Voir les Modules de ce filiére :</button>
                </div>
            </form>
            <?php 
                if(isset($_POST["voirModule"])){
                    $filiereM = isset($_POST['filiereM'])?$_POST['filiereM']:null;
                    $select = new SQLiteSelect($cnx);
                    $modules = $select->getModulesPerFiliere($filiereM);
                    echo "<table class=' table1 table table-secondary table-striped '><thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr></thead><tbody>";
                    foreach($modules as $module){
                        echo "<tr><td>".$module['codeModule']."</td><td>".$module['titreModule']."<td>".$module['masseHoraire']."</td></td></tr>";
                    }
                    echo "</tbody></table></div>";


                    
                
                        
                }
                
            ?>
        </div>
    </div>     
</div>

    <script>
        function save_module(){
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
                    document.getElementById('moduleForm').reset();
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