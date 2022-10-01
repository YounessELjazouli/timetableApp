<?php 
    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;

    include 'dashMenu.php'; 
 ?>
<div class="col-sm-11 mt-3">
    <div  class="container-fluid" id="content-add-module">
    <div class="row">
            <div class="col-sm-11 dashModule">

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
                        <select class="form-control my-3" style="width:100px;" aria-label="Default select example" name="filiereM">
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
                            <button type="button" class="btn btn-success mx-3" name="addTeacher" id="submit" onclick="save_module();return false;"> Ajouter ce Module</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-11 mainModule mt-5">
                <form  method="POST" id="getModuleForm">
                    <select class="form-select form-control-1" aria-label="Default select example" name="getfiliereM" id="filieres" size="4">
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
                        <button type="button" class="btn btn-success" id="submit1" name="voirModule" onclick="voir_module();return false;">Voir les Modules de ce filiére :</button>
                    </div>
                </form>
                <div id="message1"><center><p class="tempMsg">Section Vide <i class="fa-solid fa-exclamation-circle"></i></p> <p>SVP choisis une filiére</p> </center></div>
                
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

        function voir_module(){
            var form_element = document.getElementsByClassName('form-control-1');
            var form_data = new FormData();
            for(var count = 0;count<form_element.length;count++){
                form_data.append(form_element[count].name,form_element[count].value);
            }
            document.getElementById('submit1').disabled = true;
            var ajax_request = new XMLHttpRequest();
            ajax_request.open("POST","create.php");
            ajax_request.send(form_data);
            ajax_request.onreadystatechange = function(){
                if(ajax_request.readyState == 4 && ajax_request.status == 200){
                    document.getElementById('submit1').disabled = false;
                    document.getElementById('getModuleForm').reset();
                    document.getElementById('message1').innerHTML = ajax_request.responseText
                    
                    
                }
            }

        }
    </script>
</body>
</html>