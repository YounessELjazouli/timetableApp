<?php 
     require '../vendor/autoload.php';

     require '../cnx.php';
 
     use App\SQLiteSelect as SQLiteSelect;
 

?>

<?php include 'dashMenu.php'; ?>

<div  class="container-fluid" id="content-add-salle">
    <div class="row">
        <div class="col-sm-2 dashSalle">
            <img src="../images/salle.jpg" class="salle_image">
            <h4 class="text-center">Ajouter une Salle : </h4>
            <div class="addTeacherFormWrapper">
                <span id="message"></span>
                <form method="POST" id="salleForm">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="codeS" name="codeS">
                        <label for="nomF">Code de la salle</label>
                    </div>
                    <select class="form-select form-control my-3" aria-label="Default select example" name="typeS">
                        <option selected>Choisir Quelle type de salle s'agit elle :</option>
                        <option value="normale">Salle Normale</option>
                        <option value="info">Salle Informatique</option>
                        <option value="atelier">Atelier</option>
                    </select>
                    <div class="input-group mb-3">
                        <button type="button" class=" my-3 btn btn-success" id="submit" name="ajouterSalle"  onclick="save_class();return false;">Ajouter La salle</button>
                    </div>
                </form>
            </div>
        </div>
    <div class='col-sm-8 mainSalle'>
        <div id="salleList">
            <?php
                $select = new SQLiteSelect($cnx);
                $salles = $select->getSalles();
                echo "<center><table class='table table-warning table-striped w-75'>
                <thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr><tbody>";
                foreach($salles as $salle){
                    echo "<tr><td>".$salle['codeSalle']."</td><td>".$salle['typeSalle']."</td></tr>";
                }
                echo "</tbody></table>";
            ?>
        </div>
    </div>
    </div>
    <script>
        function save_class(){
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
                    document.getElementById('salleForm').reset();
                    document.getElementById('message').innerHTML = ajax_request.responseText
                    setTimeout(function(){
                        document.getElementById('message').innerHTML = "";
                    },2000000000000000000000000)
                    
                }
            }

        }

    
    </script>
</body>
</html>