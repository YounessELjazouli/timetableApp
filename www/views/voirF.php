<?php 
    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;
?>

<?php include 'dashMenu.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 dashEmploiParTemps">
            <img src="../images/news2.jpg" class="news_image">
            <h4 class="text-center">Emploi selon la date : </h4>
            <form  id="emploiParTemps">
                <select class="form-select form-control my-3" aria-label="Default select example" name="semaineEDT"  size=8 id="weeks">
                    <option disabled Selected>choisir les semaines durant lesquelles ce cours aura lieu :</option>

                    <?php
                        $select2 = new SQLiteSelect($cnx);
                        $weeks = $select2->getSemaines();
                        foreach($weeks as $week){
                            echo "<option value='".$week['idSemaine']."'> De ".$week['dateDebutSemaine']." à ".$week['dateFinSemaine']."</option>";
                        }
                    ?>
                </select>
                <select class="form-select form-control my-3" aria-label="Default select example" name="joursEDT">
                    <option disabled Selected>Choisir le jours de cours :</option>
                    <option value="lundi">Lundi</option>
                    <option value="mardi">Mardi</option>
                    <option value="mercredi">Mercredi</option>
                    <option value="jeudi">Jeudi</option>
                    <option value="vendredi">Vendredi</option>
                    <option value="samedi">Samedi</option>
                </select>
                <div class="input-group my-3">
                        <button type="button" class="btn btn-success" id="submit" name="afficherEmploiTemps"  onclick="voirEDT();return false;">Afficher l'emploi de temps</button>
                    </div>
            </form>
        </div>
        <div class="col-sm-8 mainVoirEDT">
            <div id="message"></div>
        </div>
    </div>
</div>
<script>
        function voirEDT(){
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
                    document.getElementById('emploiParTemps').reset();
                    document.getElementById('message').innerHTML = ajax_request.responseText
                    setTimeout(function(){
                        document.getElementById('message').innerHTML = "";
                    },300000000)
                    
                }
            }

        }
        
        
    </script>
</body>
</html>