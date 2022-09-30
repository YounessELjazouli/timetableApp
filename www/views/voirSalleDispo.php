<?php

    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;

?>

<?php include 'dashMenu.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 salleDispoDash">
            <form id="salleDispoForm" method="POST">
                <img src="../images/dispoSalle.jpg" class="dispoSalle_image">
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
                <select class="form-select form-control my-3" aria-label="Default select example" name="joursC" size="6">
                    <option disabled Selected>Choisir le jours de cours :</option>
                    <option value="lundi">Lundi</option>
                    <option value="mardi">Mardi</option>
                    <option value="mercredi">Mercredi</option>
                    <option value="jeudi">Jeudi</option>
                    <option value="vendredi">Vendredi</option>
                    <option value="samedi">Samedi</option>
                </select>

                <div class="input-group my-3">
                    <button type="submit" class="btn btn-success" id="submit" name="voirSalleDispo">Voir Les salles disponibles</button>
                </div>
            </form>
        </div>
        <div class="col-sm-8 mainSalleDispo">
            <?php 
            if(isset($_POST["voirSalleDispo"])){
                $semaineC = isset($_POST['semaineC'])?$_POST['semaineC']:null;
                $joursC = isset($_POST['joursC'])?$_POST['joursC']:null;
                    $select = new SQLiteSelect($cnx);
                    echo "<div class='container-fluid'><div class='row'>";
                    $salles1 = $select->getSalleDisponible($semaineC,$joursC,12);
                    echo "<div class='col-sm-4'><h3 class='text-center'>08H30MIN -> 13H:15MIN</h3><table class=' table1 table table-secondary table-striped '><thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr></thead><tbody>";
                    foreach($salles1 as $salle){
                        echo "<tr><td>".$salle['codeSalle']."</td><td>".$salle['typeSalle']."</td></tr>";
                    }
                    echo "</tbody></table></div>";

                    $salles2 = $select->getSalleDisponible2($semaineC,$joursC,1,12);
                    echo "<div class='col-sm-4'><h3 class='text-center'>08H30MIN -> 10H:50MIN</h3><table class='table2 table table-secondary table-striped '><thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr></thead><tbody>";
                    foreach($salles2 as $salle){
                        echo "<tr><td>".$salle['codeSalle']."</td><td>".$salle['typeSalle']."</td></tr>";
                    }
                    echo "</tbody></table></div>";

                    $salles3 = $select->getSalleDisponible2($semaineC,$joursC,2,12);
                    echo "<div class='col-sm-4'><h3 class='text-center'>11H10MIN -> 13H:15MIN</h3><table class='table3 table table-secondary table-striped '><thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr></thead><tbody>";
                    foreach($salles3 as $salle){
                        echo "<tr><td>".$salle['codeSalle']."</td><td>".$salle['typeSalle']."</td></tr>";
                    }
                    echo "</tbody></table></div>";

                    $salles4 = $select->getSalleDisponible($semaineC,$joursC,34);
                    echo "<div class='col-sm-4'><h3 class='text-center'>13H30MIN -> 18H:30MIN</h3><table class='table table-secondary table-striped '><thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr></thead><tbody>";
                    foreach($salles4 as $salle){
                        echo "<tr><td>".$salle['codeSalle']."</td><td>".$salle['typeSalle']."</td></tr>";
                    }
                    echo "</tbody></table></div>";

                    $salles5 = $select->getSalleDisponible2($semaineC,$joursC,3,34);
                    echo "<div class='col-sm-4'><h3 class='text-center'>13H30MIN -> 15H:50MIN</h3><table class='table table-secondary table-striped '><thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr></thead><tbody>";
                    foreach($salles5 as $salle){
                        echo "<tr><td>".$salle['codeSalle']."</td><td>".$salle['typeSalle']."</td></tr>";
                    }
                    echo "</tbody></table></div>";

                    $salles6 = $select->getSalleDisponible2($semaineC,$joursC,4,34);
                    echo "<div class='col-sm-4'><h3 class='text-center'>16H10MIN -> 18H:30MIN</h3><table class='table table-secondary table-striped '><thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr></thead><tbody>";
                    foreach($salles6 as $salle){
                        echo "<tr><td>".$salle['codeSalle']."</td><td>".$salle['typeSalle']."</td></tr>";
                    }
                    echo "</tbody></table></div></div></div>";

                ?> 
        </div>
    </div>
</div>
            <script>
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
            <?php
    }
    
    ?>
</body>
</html>