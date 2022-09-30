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
?>



