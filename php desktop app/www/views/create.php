<?php 
    require '../vendor/autoload.php';

    require '../cnx.php';

    use App\SQLiteSelect as SQLiteSelect;
    use App\SQLiteInsert as SQLiteInsert;



    if(isset($_POST['nomF'])){
        $nom = $_POST['nomF'];
        $prenom = $_POST['prenomF'];
        $mh = $_POST['masseHoraireF'];
        $codeS = $_POST['salleF'];
       
        $insertFormateur = new SQLiteInsert($cnx);
        $insertFormateur->AjouterFormateur($nom,$prenom,$mh,$codeS);
        echo "<div class='alert alert-success'>Les données sont enregistrer avec success</div>";
    }
    if(isset($_POST['codeS'])){
        $salle = $_POST['codeS'];
        $type = $_POST['typeS'];
   
       
        $insertSalle = new SQLiteInsert($cnx);
        $insertSalle->AjouterSalle($salle,$type);
        echo "<div class='alert alert-success'>Les données sont enregistrer avec success</div>";
    }

    if(isset($_POST['salleC']) && isset($_POST['formateurC']) && isset($_POST['groupeC']) && isset($_POST['moduleC']) && isset($_POST['joursC']) && isset($_POST['heureC']) && isset($_POST['semaineC'])){
        $salle = $_POST['salleC'];
        $formateur = $_POST['formateurC'];
        $groupe = $_POST['groupeC'];
        $module = $_POST['moduleC'];
        $jours = $_POST['joursC'];
        $heure = $_POST['heureC'];
        $weeks = $_POST['semaineC'];

        $sql = "SELECT * FROM cours";
        $req = $cnx->prepare($sql);
        $req->execute();
        $cours = $req->fetchAll(PDO::FETCH_ASSOC);
        $id;
        if(count($cours) == 0){
            $id = 1;
        }else{
            foreach($cours as $un_cours){
                $id = $un_cours['idCours'];
            }
            $id = (int)$id;
            $id = $id + 1;
        }
        $heure = (int)$heure;
        $weeks = explode(",",$weeks);
        foreach($weeks as $week){
            $insertCours = new SQLiteInsert($cnx);
            $insertCours->AjouterCours($id,$groupe,$salle,$module,$formateur,$week,$heure,$jours);

        }


        echo "<div class='alert alert-success'>Les données sont enregistrer avec success</div>";
    }


    if(isset($_POST['codeFil'])){
        $code = $_POST['codeFil'];
        $nom = $_POST['nomFil'];
        $insertFiliere = new SQLiteInsert($cnx);
        $insertFiliere->AjouterFiliere($code,$nom);
        echo "<div class='alert alert-success'>Les données sont enregistrer avec success</div>";
    }


    if(isset($_POST['codeGr'])){
        $code = $_POST['codeGr'];
        $filiere = $_POST['filiereGr'];
        $annee = $_POST['anneeGr'];
        $insertGroupe = new SQLiteInsert($cnx);
        try{
            $insertGroupe->AjouterGroupe($code,$filiere,$annee);
            echo "<div class='alert alert-success'>Les données sont enregistrer avec success</div>";
        }catch(PDOException $err){
            echo "Une erreure a occuré : ".$err;
        }
    }

    if(isset($_POST['codeM'])){
        $code = $_POST['codeM'];
        $titre = $_POST['titreM'];
        $mhM = $_POST['masseHoraireM'];
        $filieres = $_POST['filiereM'];
        $filieres = explode(",",$filieres);
        $insertGroupe = new SQLiteInsert($cnx);
        try{
            $insertGroupe->AjouterModule($code,$titre,$mhM);
            foreach($filieres as $filiere){
                $insertGroupe->AjouterFiliére_Module($filiere,$code);
            }
            echo "<div class='alert alert-success'>Les données sont enregistrer avec success</div>";
        }catch(PDOException $err){
            echo "Une erreure a occuré : ".$err;
        }
        
    }

    if(isset($_POST['semaineEDT'])){
        $semaineEDT = $_POST['semaineEDT'];
        $joursEDT = $_POST['joursEDT'];
        
        $getCours = new SQLiteSelect($cnx);
        $cours = $getCours->getCoursParDate($semaineEDT,$joursEDT);
        try{
            echo "<table class='table table-dark table-hover table-responsive table-striped'><thead>
            <tr><th>Duurée de cours</th><th>Salle</th><th>Groupe</th><th>Formateur/Formatrice</th><th>Module</th></tr>
            </thead></tbody>";
            foreach($cours as $cour){
                if($cour['periods']==12) {
                    $cour['periods'] = '08H30Min - 13H15Min';
                }else if($cour['periods']==1) {
                    $cour['periods'] = '08H30Min - 10H50Min';
                }else if($cour['periods']==2){
                    $cour['periods'] = '11H10Min - 13H15Min';
                }else if($cour['periods']==34) {
                    $cour['periods'] = '13H30Min - 18H30Min';
                }else if($cour['periods']==3){
                    $cour['periods'] = '13H30Min - 15H:50Min';
                }else if($cour['periods']==4) {
                    $cour['periods'] = '16H:10Min - 18H30Min';
                }
                echo "<tr>
                <td>".$cour['periods']."</td>
                <td>".$cour['codeSalle']."</td>
                <td>".$cour['codeGroupe']."</td>
                <td>".$cour['nom']." ".$cour['prenom']."</td>
                <td>".$cour['titreModule']."</td>
                </tr>";
            }
            echo "</tbody></table>";
        }catch(PDOException $err){
            echo "Une erreure a occuré : ".$err;
        }
        
    }
    if(isset($_POST['getfiliereM'])){
        $filiere = $_POST['getfiliereM'];
        $select = new SQLiteSelect($cnx);
        $modules = $select->getModulesPerFiliere($filiere);
        if(count($modules)>0){
            echo "<table class=' table1 table table-secondary table-striped mt-5 '><thead><tr><td>Code de Salle</td><td>Type de Salle</td><td>Masse Horaire</td></tr></thead><tbody>";
            foreach($modules as $module){
                echo "<tr><td>".$module['codeModule']."</td><td>".$module['titreModule']."<td>".$module['masseHoraire']."</td></td></tr>";
            }
            echo "</tbody></table></div>";
        }else{
            echo "<center><p class='tempMsg'>Section Vide <i class='fa-solid fa-exclamation-circle'></i></p> <p>Aucun Module enrégistrer pour ce filiére</p> </center>";
        }
        
    }
    if(isset($_POST['SalleDispojoursC'])){
        $joursC = $_POST['SalleDispojoursC'];
        $semaineC = $_POST['semaineC'];
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
    }
?>



