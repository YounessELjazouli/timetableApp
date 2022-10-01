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
    <title>Planning Cours :</title>
    <script>
        function getGroupe(val){
            $.ajax({
                type:"POST",
                url : "getGroupe.php",
                data : "codeFiliere="+val,
                success:function(data){
                    $('#groupeE').append(data);
                
                }
            })
        }

    </script>
</head>
<body>
<?php include 'dashMenu.php'; ?>

<form  class="col-sm-10 d-block mx-auto" id="content-view-timetable">
        <select class="form-select form-control w-50 d-block mx-auto my-4" aria-label="Default select example" name="filiereE" id="filiereE" onchange="getGroupe(this.value);">
            <option Selected disabled>Choisir le Filiere  :</option>
            <?php
            $select1 = new SQLiteSelect($cnx);
            $filieres = $select1->getFilieres();
            foreach($filieres as $filiere){
                echo "<option value='".$filiere['codeFiliere']."'>".$filiere['codeFiliere']."</option>";
            }
            ?>
        </select>

        <select class="form-select form-control w-50 d-block mx-auto my-4" aria-label="Default select example" name="groupeE" id="groupeE">
            <option disabled Selected>Choisir le groupe  :</option>
        </select>

        <select class="form-select form-control w-50 d-block mx-auto my-4" aria-label="Default select example" name="semaineE" id="weeks">
                    <option disabled Selected>choisir les semaines durant lesquelles ce cours aura lieu :</option>

                    <?php
                        $select2 = new SQLiteSelect($cnx);
                        $weeks = $select2->getSemaines();
                        foreach($weeks as $week){
                            echo "<option value='".$week['idSemaine']."'> De ".$week['dateDebutSemaine']." à ".$week['dateFinSemaine']."</option>";
                        }
                    ?>
                </select>
<div class="input-group ">
    <button type="button" class="btn btn-success d-block mx-auto" id="submit" name="ajouterSalle"  onclick="viewTimetable();return false;">Voir l'emploi de temps</button>
</div>
</form>
<span id="message" class="emploi"></span>

    <script src="../bootsfonts/script.js"></script>
    
    <script>
       function viewTimetable(){
            var form_element = document.getElementsByClassName('form-control w-50 d-block mx-auto my-4');
            var form_data = new FormData();
            for(var count = 0;count<form_element.length;count++){
                form_data.append(form_element[count].name,form_element[count].value);
            }

            document.getElementById('submit').disabled = true;
            var ajax_request = new XMLHttpRequest();
            ajax_request.open("POST","viewtimeTable.php");
            ajax_request.send(form_data);
            ajax_request.onreadystatechange = function(){
                if(ajax_request.readyState == 4 && ajax_request.status == 200){
                    document.getElementById('submit').disabled = false;
                    document.getElementById('content-view-timetable').reset();
                    document.getElementById('message').innerHTML = ajax_request.responseText
                    setTimeout(function(){
                        document.getElementById('message').innerHTML = "";
                    },60*60*1000)
                    
                }
            }

        }

        
        
    
    </script>
</body>
</html>