<?php 
    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;

include 'dashMenu.php'; 
?>
<div  class="container-fluid" id="content-add-teacher">
    <div class="row">
        <div class="col-sm-2 dashFormateur">
            <img src="../images/formateur.jpg" class="formateur_image tmg-thumbnail">
            <h4 class="text-center">Ajouter un formateur/formtrice : </h4>
            <div class="addTeacherFormWrapper">
                <span id="message"></span>
                <form method="POST" id="formateurForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nomF" name="nomF">
                        <label for="nomF">Nom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="prenomF" name="prenomF">
                        <label for="prenomF">Prenom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="masseHoraireF" name="masseHoraireF">
                        <label for="masseHoraireF">Masse Horaire</label>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="salleF">
                        <option disabled>Choisir une salle pour le formateur/la formatrice :</option>

                        <?php
                            $select = new SQLiteSelect($cnx);
                            $profs = $select->getSalles();
                            
                            foreach($profs as $prof){
                                echo "<option value='".$prof['codeSalle']."'>".$prof['codeSalle']." Salle ".$prof['typeSalle']."</option>";
                            }
                        ?>
                    </select>
                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-success my-3" name="addTeacher" id="submit" onclick="save_teacher();return false;"> Ajouter Formateur/Formatrice</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8 mainFormateur">
        <?php
            $select1 = new SQLiteSelect($cnx);
            $formateurs = $select1->getFormateurs();
            echo "<div class='container'><div class='row table-responsive'>";
            echo "<table class='table table-hover table-dark table-striped'>";
            echo "<thead><tr>
                <th>Nom :</th>
                <th>Prenom : </th>
                <th>Masse Horaire</th>
                <th>Salle </th>
                <th>Supprimer</th>
                <th>Modifier</th>

            </tr></thead><tbody>";
            foreach($formateurs as $data){
                echo "<tr'>
                <td>".$data['nom']."</td><td> ".$data['prenom']."</td>
                <td>".$data['massHoraire']."</td>
                <td>".$data['codeSalle']."</td>
                <td><a onclick=\" javascript:return confirm('Vous étes sur vous voulez supprimer ce formateur') \" href='deleteTeacher.php?idFormateur={$data['idFormateur']}'><i class='fa-solid fa-trash-can text-danger btn btn-danger text-light'></i></a></td>
                <td><a onclick=\" javascript:return confirm('Vous étes sur vous voulez modifier ce formateur') \" href='updateTeacher.php?idFormateur={$data['idFormateur']}'><i class='fa-solid fa-arrows-rotate btn btn-success text-light'></i></a></td>
                </tr>";

            }
            echo "</tbody></table></div></div>";
        ?>   
        </div>
    </div>
</div>

    <script>
        function save_teacher(){
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
                    document.getElementById('formateurForm').reset();
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