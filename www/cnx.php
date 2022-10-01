<?php
require 'vendor/autoload.php';


use App\SQLiteConnection;

$cnx = (new SQLiteConnection())->connect();
if ($cnx != null){

}else
    echo 'La connexion à la base de données a echouée';