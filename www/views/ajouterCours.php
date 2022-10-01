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
        function getSalle(val){
            $.ajax({
                type:"POST",
                url : "getSalle.php",
                data : "idFormateur="+val,
                success:function(data){
                    $('#salleC').append(data);
                    
                }
            })
        }
        function getGroupe(val){
            $.ajax({
                type:"POST",
                url : "getGroupe.php",
                data : "codeFiliere="+val,
                success:function(data){
                    $('#groupeC').append(data);
                    $('#groupeE').append(data);
                    
                }
            })
        }


        function getModule(val){
            $.ajax({
                type:"POST",
                url : "getModule.php",
                data : "codeFiliere="+val,
                success:function(data){
                    $('#moduleC').html(data);
                }
            })
        }
            </script>

</head>
<body>
<?php include 'dashMenu.php'; ?>

<div class="col-sm-11">
<div  class="container-fluid" id="content-add-course">
    <div class="row">
        <div class="col-sm-11 dashCours">
            <div class="addTeacherFormWrapper">
                <span id="message"></span>
                <form method="POST" id="coursForm">

                    <div class="breakline">
                    <select class="form-select form-control my-3" aria-label="Default select example" name="formateurC" id="formateurC" onchange="getSalle(this.value);">
                        <option disabled Selected>Choisir le formateur/la formatrice :</option>
                        <?php
                        $select = new SQLiteSelect($cnx);
                        $profs = $select->getFormateurs();
                        foreach($profs as $prof){
                            echo "<option value='".$prof['idFormateur']."'>".$prof['nom']." ".$prof['prenom']."</option>";
                        }
                        ?>


                    </select>

                    <select class="form-select form-control my-3" aria-label="Default select example" name="salleC" id="salleC" >
                        <option disabled Selected>Choisir la salle de formateur :</option>
                    </select>
                    </div>

                    <div class="breakline">
                    <select class="form-select form-control my-3" aria-label="Default select example" name="filiereC" id="filiereC" onchange="getGroupe(this.value);getModule(this.value)">
                        <option Selected disabled>Choisir le Filiere  :</option>
                        <?php
                        $select1 = new SQLiteSelect($cnx);
                        $filieres = $select1->getFilieres();
                        foreach($filieres as $filiere){
                            echo "<option value='".$filiere['codeFiliere']."'>".$filiere['codeFiliere']."</option>";
                        }
                        ?>
                    </select>

                    <select class="form-select form-control my-3" aria-label="Default select example" name="groupeC" id="groupeC">
                        <option disabled Selected>Choisir le groupe  :</option>
                    </select>
                    </div>

                    <div class="breakline">
                    <select class="form-select form-control my-3" aria-label="Default select example" name="moduleC" id="moduleC">
                        <option disabled Selected>Choisir Le Module :</option>
                    </select>

                    <select class="form-select form-control my-3" aria-label="Default select example" name="joursC">
                        <option disabled Selected>Choisir le jours de cours :</option>
                        <option value="lundi">Lundi</option>
                        <option value="mardi">Mardi</option>
                        <option value="mercredi">Mercredi</option>
                        <option value="jeudi">Jeudi</option>
                        <option value="vendredi">Vendredi</option>
                        <option value="samedi">Samedi</option>
                    </select>
                    </div>
                    <select class="form-select form-control my-3" aria-label="Default select example" name="heureC">
                        <option disabled Selected>Choisir L'horaire de cours :</option>
                        <option value="1">08:30 <=> 10:50</option>
                        <option value="2">11:10 <=> 13:15</option>
                        <option value="12">08:30 <=> 13:15</option>
                        <option value="3">13:30 <=> 15:50</option>
                        <option value="4">16:10 <=> 18:30</option>
                        <option value="34">13:30 <=> 18:30</option>
                    </select>
                    <div id="breakline">
                        <select class="form-select form-control-1 my-3" aria-label="Default select example" name="semaineC" multiple size=8 id="weeks">
                            <option disabled Selected>choisir les semaines durant lesquelles ce cours aura lieu :</option>

                            <?php
                                $select2 = new SQLiteSelect($cnx);
                                $weeks = $select2->getSemaines();
                                foreach($weeks as $week){
                                    echo "<option value='".$week['idSemaine']."'> De ".$week['dateDebutSemaine']." à ".$week['dateFinSemaine']."</option>";
                                }
                            ?>
                        </select>

                        
                        <div class="input-group my-3">
                            <button type="button" class="btn btn-success" id="submit" name="ajouterSalle"  onclick="save_class();return false;">Ajouter le cours à l'emploi de temps</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-sm-12 mainCours">
            <form  class="col-sm-12 d-block mx-auto" id="content-view-timetable">
                <select class="form-select form-control2 w-50 d-block mx-auto my-4" aria-label="Default select example" name="filiereE" id="filiereE" onchange="getGroupe(this.value);">
                    <option Selected disabled>Choisir le Filiere  :</option>
                    <?php
                    $select1 = new SQLiteSelect($cnx);
                    $filieres = $select1->getFilieres();
                    foreach($filieres as $filiere){
                        echo "<option value='".$filiere['codeFiliere']."'>".$filiere['codeFiliere']."</option>";
                    }
                    ?>
                </select>

                <select class="form-select form-control2 w-50 d-block mx-auto my-4" aria-label="Default select example" name="groupeE" id="groupeE">
                    <option disabled Selected>Choisir le groupe  :</option>
                </select>

                <select class="form-select form-control2 w-50 d-block mx-auto my-4" aria-label="Default select example" name="semaineE" id="weeks">
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
                    <button type="button" class="btn btn-success d-block mx-auto" id="submit2" name="ajouterSalle"  onclick="viewTimetable();return false;">Voir l'emploi de temps</button>
                </div>
            </form>
            <span id="message2" class="emploi"></span>
        </div>
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

            weeks = []
            var semaines = document.querySelectorAll('#weeks option:checked')
            for(semaine of semaines){
                a = semaine.value
                weeks.push(a)
            }
            form_data.append('semaineC',weeks)


            document.getElementById('submit').disabled = true;
            var ajax_request = new XMLHttpRequest();
            ajax_request.open("POST","create.php");
            ajax_request.send(form_data);
            ajax_request.onreadystatechange = function(){
                if(ajax_request.readyState == 4 && ajax_request.status == 200){
                    document.getElementById('submit').disabled = false;
                    document.getElementById('coursForm').reset();
                    document.getElementById('message').innerHTML = ajax_request.responseText
                    setTimeout(function(){
                        document.getElementById('message').innerHTML = "";
                    },3000)
                    
                }
            }

        }
        function viewTimetable(){
            var form_element = document.getElementsByClassName('form-control2');
            var form_data = new FormData();
            for(var count = 0;count<form_element.length;count++){
                form_data.append(form_element[count].name,form_element[count].value);
            }

            document.getElementById('submit2').disabled = true;
            var ajax_request = new XMLHttpRequest();
            ajax_request.open("POST","viewtimeTable.php");
            ajax_request.send(form_data);
            ajax_request.onreadystatechange = function(){
                if(ajax_request.readyState == 4 && ajax_request.status == 200){
                    document.getElementById('submit2').disabled = false;
                    document.getElementById('content-view-timetable').reset();
                    document.getElementById('message2').innerHTML = ajax_request.responseText
                    setTimeout(function(){
                        document.getElementById('message2').innerHTML = "";
                    },60*60*1000)
                    
                }
            }

        }
    
    </script>
</body>
</html>