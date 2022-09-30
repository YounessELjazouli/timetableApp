<?php
require '../cnx.php'; 
if(isset($_POST['codeFiliere'])){
    $groupe =  $_POST['codeFiliere'];

    $sql = "SELECT * from filiere_module FM INNER JOIN module M ON FM.codeModule = M.codeModule WHERE codeFiliere = ?";
    $req = $cnx->prepare($sql);
    $req->execute([$groupe]);
    $rows = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $data){
        echo "<option value='".$data['codeModule']."'>".$data['titreModule']." ".$data['masseHoraire']." H</option>";
    }
}

?>

