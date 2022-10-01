<?php

    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;

?>

<?php include 'dashMenu.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-sm-12">
            <form id="salleDispoForm" method="POST">
                <select class="form-select form-control-1" aria-label="Default select example" name="filiereM" id="weeks">
                    <option disabled Selected>choisir les semaines durant lesquelles ce cours aura lieu :</option>

                    <?php
                        $select2 = new SQLiteSelect($cnx);
                        $filieres = $select2->getFilieres();
                        foreach($filieres as $filiere){
                            echo "<option value='".$filiere['codeFiliere']."'> De ".$filiere['codeFiliere']." : ".$filiere['nomFiliere']."</option>";
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

</body>
</html>