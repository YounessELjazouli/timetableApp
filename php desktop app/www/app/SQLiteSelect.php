<?php

namespace App;

class SQLiteSelect {

    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }


    public function getFormateurs(){
        $stmt = $this->cnx->query('SELECT * from formateur');
        $formateurs = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $formateurs[] = [
            'idFormateur' => $row['idFormateur'],
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'massHoraire' => $row['massHoraire'],
            'codeSalle' => $row['codeSalle']
            ];
        }
            return $formateurs;
    }

    public function getFilieres(){
        $stmt = $this->cnx->query('SELECT * from filiere ORDER BY nomFiliere');
        $filieres = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $filieres[] = [
            'codeFiliere' => $row['codeFiliere'],
            'nomFiliere' => $row['nomFiliere']
            ];
        }
            return $filieres;
    }

    
    public function getGroupes(){
        $stmt = $this->cnx->query('SELECT * from groupe G INNER JOIN filiere F ON G.codeFiliere = F.codeFiliere ORDER BY codeFiliere');
        $groupes = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $groupes[] = [
            'codeGroupe' => $row['codeGroupe'],
            'nomFiliere' => $row['nomFiliere'],
            'annee' => $row['annee'],
            ];
        }
            return $groupes;
    }

    public function getSalles(){
        $stmt = $this->cnx->query('SELECT * from salle ORDER BY codeSalle');
        $salles = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $salles[] = [
            'codeSalle' => $row['codeSalle'],
            'typeSalle' => $row['typeSalle']
            ];
        }
            return $salles;
    }

    public function getSemaines(){
        $stmt = $this->cnx->query('SELECT * FROM semaines');
        $semaines = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $semaines[] = [
            'idSemaine' => $row['idSemaine'],
            'dateDebutSemaine' => $row['dateDebutSemaine'],
            'dateFinSemaine' => $row['dateFinSemaine']
            ];
        }
            return $semaines;
    }

    public function getModulesPerFiliere($codeFiliere){
        $stmt = $this->cnx->prepare('SELECT * from filiere_module FM INNER JOIN module M ON FM.codeModule = M.codeModule WHERE codeFiliere = ?');
        $stmt->execute([$codeFiliere]);
        $modules = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $modules[] = [
            'codeModule' => $row['codeModule'],
            'titreModule' => $row['titreModule'],
            'masseHoraire' => $row['masseHoraire']
            ];
        }
            return $modules;
    }

    public function getSalleDisponible($idSemaine,$jours,$periods){
        $stmt = $this->cnx->prepare('SELECT * from salle WHERE codeSalle NOT IN(SELECT codeSalle FROM cours WHERE idSemaine = ? AND jours = ? AND periods = ?) ORDER BY typeSalle');
        $stmt->execute([$idSemaine,$jours,$periods]);
        $salles = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $salles[] = [
            'codeSalle' => $row['codeSalle'],
            'typeSalle' => $row['typeSalle'],
            ];
        }
            return $salles;
    }

    public function getSalleDisponible2($idSemaine,$jours,$periods,$periods2){
        $stmt = $this->cnx->prepare('SELECT * from salle WHERE codeSalle NOT IN(SELECT codeSalle FROM cours WHERE idSemaine = ? AND jours = ? AND periods IN(?,?))ORDER BY typeSalle;');
        $stmt->execute([$idSemaine,$jours,$periods,$periods2]);
        $salles = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $salles[] = [
            'codeSalle' => $row['codeSalle'],
            'typeSalle' => $row['typeSalle'],
            ];
        }
            return $salles;
    }

    public function getCoursParDate($semaineEDT,$joursEDT){
        $stmt = $this->cnx->prepare('SELECT * from cours C INNER JOIN formateur F ON C.idFormateur = F.idFormateur INNER JOIN module M ON C.codeModule = M.codeModule WHERE idSemaine = ? AND jours = ?') ;
        $stmt->execute([$semaineEDT,$joursEDT]);
        $salles = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $salles[] = [
            'periods' => $row['periods'],
            'codeSalle' => $row['codeSalle'],
            'codeGroupe' => $row['codeGroupe'],
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'titreModule' => $row['titreModule']
            ];
        }
            return $salles;
    }



}

