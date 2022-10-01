<?php

namespace App;

class SQLiteInsert {

    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

  
    public function AjouterCours($idCours,$idGroupe,$codeSalle,$codeModule,$idFormateur,$idSemaine,$periods,$jours) {
        $sql = 'INSERT INTO cours VALUES(:id,:groupe,:salle,:module,:formateur,:semaine,:periods,:jours)';

        $stmt = $this->cnx->prepare($sql);
        $stmt->execute([
            'id' => $idCours,
            'groupe' => $idGroupe,
            'salle' => $codeSalle,
            'module' => $codeModule,
            'formateur' => $idFormateur,
            'semaine' => $idSemaine,
            'periods' => $periods,
            'jours' => $jours,
        ]);

        return $this->cnx->lastInsertId();
    }

    public function AjouterFiliere($code,$nom){
        $sql = 'INSERT INTO filiere VALUES(:code1,:nom1)';
        $stmt = $this->cnx->prepare($sql);
        
        $stmt->execute([
            'code1' => $code,
            'nom1' => $nom
        ]);

        return $this->cnx->lastInsertId();
    }


    public function AjouterFormateur($nom,$prenom,$masseHoraire,$codeSalle){
        $sql = 'INSERT INTO formateur VALUES(null,:nom,:prenom,:mh,:cs)';

        $stmt = $this->cnx->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'mh' => $masseHoraire,
            'cs' => $codeSalle,
        ]);

        return $this->cnx->lastInsertId();
    }

    public function AjouterGroupe($code,$codeFiliere,$annee){
        $sql = 'INSERT INTO groupe VALUES(:code,:cf,:annee)';

        $stmt = $this->cnx->prepare($sql);
        $stmt->execute([
            'code' => $code,
            'cf' => $codeFiliere,
            'annee' => $annee,
        ]);

        return $this->cnx->lastInsertId();
    }


    public function AjouterModule($code,$titre,$mh){
        $sql = 'INSERT INTO module VALUES(:code,:titre,:mh)';

        $stmt = $this->cnx->prepare($sql);
        $stmt->execute([
            'code' => $code,
            'titre' => $titre,
            'mh' => $mh,
        ]);

        return $this->cnx->lastInsertId();
    }


    public function AjouterFiliére_Module($codeF,$codeM){
        $sql = 'INSERT INTO filiere_module VALUES(:codeF,:codeM)';


        $stmt = $this->cnx->prepare($sql);
        $stmt->execute([
            'codeF' => $codeF,
            'codeM' => $codeM,
        ]);

        return $this->cnx->lastInsertId();
    }

    public function AjouterSalle($codeS,$typeS){
        $sql = 'INSERT INTO salle VALUES(:codeS,:typeS)';

        $stmt = $this->cnx->prepare($sql);
        $stmt->execute([
            'codeS' => $codeS,
            'typeS' => $typeS,
        ]);

        return $this->cnx->lastInsertId();
    }


    public function AjouterSemaine($code,$debut,$fin){
        $sql = 'INSERT INTO semaines VALUES(:code,:debut,:fin)';
        $stmt = $this->cnx->prepare($sql);
        $stmt->execute([
            'code' => $code,
            'debut' => $debut,
            'fin' => $fin,
        ]);

        return $this->cnx->lastInsertId();
    }


    
}