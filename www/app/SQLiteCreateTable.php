<?php

namespace App;

/**
 * SQLite Create Table Demo
 */
class SQLiteCreateTable {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * connect to the SQLite database
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * create tables 
     */
    public function createTables() {
        $commands = ['CREATE TABLE "salle" (
            "codeSalle"	TEXT,
            "typeSalle"	TEXT,
            PRIMARY KEY("codeSalle")
        )','CREATE TABLE "formateur" (
            "idFormateur"	INTEGER,
            "nom"	TEXT,
            "prenom"	TEXT,
            "massHoraire"	INTEGER,
            "codeSalle"	TEXT,
            PRIMARY KEY("idFormateur" AUTOINCREMENT),
            FOREIGN KEY("codeSalle") REFERENCES "salle"("codeSalle")
        )','CREATE TABLE "module" (
            "codeModule"	TEXT,
            "titreModule"	BLOB,
            "masseHoraire"	TEXT,
            PRIMARY KEY("codeModule")
        )','CREATE TABLE "filiere" (
            "codeFiliere"	TEXT,
            "nomFiliere"	TEXT,
            PRIMARY KEY("codeFiliere")
        )','CREATE TABLE "groupe" (
            "codeGroupe"	TEXT,
            "codeFiliere"	TEXT,
            "annee"	TEXT,
            PRIMARY KEY("codeGroupe"),
            FOREIGN KEY("codeFiliere") REFERENCES "filiere"("codeFiliere") ON DELETE CASCADE ON UPDATE CASCADE
        )','CREATE TABLE "groupe_module" (
            "codeGroupe"	TEXT,
            "codeModule"	TEXT,
            PRIMARY KEY("codeGroupe","codeModule"),
            FOREIGN KEY("codeGroupe") REFERENCES "groupe"("codeGroupe") ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY("codeModule") REFERENCES "module"("codeModule") ON DELETE CASCADE ON UPDATE CASCADE
        )','CREATE TABLE "semaines" (
            "idSemaine"	INTEGER,
            "dateDebutSemaine"	TEXT,
            "dateFinSemaine"	TEXT,
            PRIMARY KEY("idSemaine")
        )','CREATE TABLE IF NOT EXISTS "cours" (
            "idCours"	INTEGER,
            "codeGroupe"	TEXT,
            "codeSalle"	TEXT,
            "codeModule"	TEXT,
            "idFormateur"	INTEGER,
            "idSemaine"	INTEGER,
            "periods"	INTEGER,
            "jours"	TEXT,
            PRIMARY KEY("idCours","idFormateur","codeSalle","codeGroupe","codeModule","idSemaine"),
            FOREIGN KEY("codeGroupe") REFERENCES "groupe"("codeGroupe") ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY("codeModule") REFERENCES "module"("codeModule") ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY("idSemaine") REFERENCES "semaines"("idSemaine"),
            FOREIGN KEY("idFormateur") REFERENCES "formateur"("idFormateur") ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY("codeSalle") REFERENCES "salle"("codeSalle") ON DELETE CASCADE ON UPDATE CASCADE
        )'];
        // execute the sql commands to create new tables
        foreach ($commands as $command) {
            $this->pdo->exec($command);
        }
    }

    /**
     * get the table list in the database
     */
    public function getTableList() {

        $stmt = $this->pdo->query("SELECT name
                                   FROM sqlite_master
                                   WHERE type = 'table'
                                   ORDER BY name");
        $tables = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tables[] = $row['name'];
        }

        return $tables;
    }

}