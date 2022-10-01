<?php

    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;

?>

<?php include 'dashMenu.php'; ?>

<div class="col-sm-11">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 salleDispoDash">
            <form id="salleDispoForm" method="POST">
                <select class="form-select form-control-1 my-3" aria-label="Default select example" name="semaineC" id="weeks" size="8">
                    <option disabled Selected>choisir les semaines durant lesquelles ce cours aura lieu :</option>

                    <?php
                        $select2 = new SQLiteSelect($cnx);
                        $weeks = $select2->getSemaines();
                        foreach($weeks as $week){
                            echo "<option value='".$week['idSemaine']."'> De ".$week['dateDebutSemaine']." à ".$week['dateFinSemaine']."</option>";
                        }
                    ?>
                </select>
                <select class="form-select form-control-1 my-3" aria-label="Default select example" name="SalleDispojoursC" size="6">
                    <option disabled Selected>Choisir le jours de cours :</option>
                    <option value="lundi">Lundi</option>
                    <option value="mardi">Mardi</option>
                    <option value="mercredi">Mercredi</option>
                    <option value="jeudi">Jeudi</option>
                    <option value="vendredi">Vendredi</option>
                    <option value="samedi">Samedi</option>
                </select>

                <div class="input-group my-3">
                    <button type="button" id="submit1" style="postion:relative;top:30%" class="btn btn-success mx-3 h-25" id="submit1" name="voirSalleDispo" onclick="voir_dispoSalle();return false;">Voir Les salles disponibles</button>
                </div>
            </form>
        </div>
        <div class="col-sm-12 mainSalleDispo">
            <div id="message1"></div>
            
        </div>
    </div>
</div>
</div>
            <script>
            function voir_dispoSalle(){
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
                        document.getElementById('salleDispoForm').reset();
                        document.getElementById('message1').innerHTML = ajax_request.responseText
                        
                        
                    }
                }
            }   
            var a = document.querySelectorAll('.table1 tbody tr')
            var b = document.querySelectorAll('.table2 tbody tr')
            console.log(a+"<b>"+b)
            for(tr of a){
                for(tr1 of b){
                    if(tr == tr1){
                        tr1.style.display = 'none';
                    }
                }
            }

            </script>
            
</body>
</html>