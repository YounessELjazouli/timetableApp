<?php 
    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;
?>

<?php include 'dashMenu.php'; ?>
<div class="col-sm-11">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-11 dashEmploiParTemps">

            <form  id="emploiParTemps">
                <select class="form-select form-control-1 my-3" aria-label="Default select example" name="semaineEDT"  size=8 id="weeks">
                    <option disabled Selected>choisir les semaines durant lesquelles ce cours aura lieu :</option>

                    <?php
                        $select2 = new SQLiteSelect($cnx);
                        $weeks = $select2->getSemaines();
                        foreach($weeks as $week){
                            echo "<option value='".$week['idSemaine']."'> De ".$week['dateDebutSemaine']." à ".$week['dateFinSemaine']."</option>";
                        }
                    ?>
                </select>
                <select class="form-select form-control-1 my-3" aria-label="Default select example" name="joursEDT" size=7>
                    <option disabled Selected>Choisir le jours de cours :</option>
                    <option value="lundi">Lundi</option>
                    <option value="mardi">Mardi</option>
                    <option value="mercredi">Mercredi</option>
                    <option value="jeudi">Jeudi</option>
                    <option value="vendredi">Vendredi</option>
                    <option value="samedi">Samedi</option>
                </select>
                <div class="input-group my-3">
                        <button type="button" class="btn btn-success h-25 mx-3" style="position:relative;top:35%;" id="submit" name="afficherEmploiTemps"  onclick="voirEDT();return false;">Afficher l'emploi de temps</button>
                    </div>
            </form>
        </div>
        <div class="col-sm-12 mainVoirEDT">
            <div id="message"></div>
        </div>
    </div>
</div>
</div>
<script>
        function voirEDT(){
            var form_element = document.getElementsByClassName('form-control-1');
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
                    document.getElementById('emploiParTemps').reset();
                    document.getElementById('message').innerHTML = ajax_request.responseText
                    
                    
                }
            }

        }
        
        
    </script>
</body>
</html>