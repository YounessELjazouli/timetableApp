<?php
require '../cnx.php'; 
if(isset($_POST['codeFiliere'])){
    $filiere =  $_POST['codeFiliere'];

    $sql = "SELECT * from groupe WHERE codeFiliere = ?";
    $req = $cnx->prepare($sql);
    $req->execute([$filiere]);
    $rows = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $data){
        echo "<option value='".$data['codeGroupe']."'>".$data['codeGroupe']."</option>";
    }
}

?>