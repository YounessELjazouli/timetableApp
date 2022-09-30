<?php
require '../cnx.php'; 
if(isset($_POST['idFormateur'])){
    $formateur =  $_POST['idFormateur'];

    $sql = "SELECT * from formateur WHERE idFormateur = ?";
    $req = $cnx->prepare($sql);
    $req->execute([$formateur]);
    $rows = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $data){
        echo "<option value='".$data['codeSalle']."'>".$data['codeSalle']."</option>";
    }
}

if(isset($_POST['semaineC']) && isset($_POST['joursC']) && isset($_POST['heureC'])){
    $semaineC =  $_POST['semaineC'];
    $joursC =  $_POST['joursC'];
    $heureC =  $_POST['heureC'];

    echo `<div class="row">
    <div class="col">
        <center>`;
            $select = new SQLiteSelect($cnx);
            $salles = $select->getSalleDisponible();
            if(count($salles == 0)){
                echo "Tous les Salles sont Occupés";
            }else{
            echo "<center><table class='table table-secondary table-striped w-50'>
            <thead><tr><td>Code de Salle</td><td>Type de Salle</td></tr><tbody>";
            foreach($salles as $salle){
                echo "<tr><td>".$salle['codeSalle']."</td><td>".$salle['typeSalle']."</td></tr>";
            }
            echo "</tbody></table>";
        }
        echo "</center>
    </div>
</div>
</div>";
}
?>