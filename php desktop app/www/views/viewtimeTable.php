<?php
    require '../vendor/autoload.php';

    require '../cnx.php';    
    $groupe = $_POST['groupeE'];
    $week = $_POST['semaineE'];
 
    function getCourseHere(int $period,string $jours){
        require '../cnx.php'; 
        
        $groupe = $_POST['groupeE'];
        $week = $_POST['semaineE'];
        $query = "SELECT * FROM cours C INNER JOIN formateur F ON C.idFormateur = F.idFormateur  WHERE codeGroupe = ? AND idSemaine = ? AND periods = ? AND jours = ?";
        $statement = $cnx->prepare($query);

        $statement->execute([$groupe,$week,$period,$jours]);
        $cours = $statement->fetchAll(PDO::FETCH_ASSOC);
        $c="";
        foreach($cours as $cour){
            $c = "<div>Formateur : ".$cour['nom']." ".$cour['prenom']."</div> <div> ".$cour['codeSalle']."</div>";

        }
        echo $c;
    }

    ?>
    <div class='container p-5' id="content-viewGroupeTimeTable">
        <div class='row'>
            <div class='col-sm-3 border'>
                <div class='text1'>OFPPT</div>
                <div class='text2'>ISTA TEMARA</div>
            </div>
            <div class='col-sm-6 border'>
                <div class='titre'>EMPLOI DU TEMPS PAR GROUPE COURS DE JOUR</div>
            </div>
            <div class='col-sm-3 border'>
                <div class='text3 border'>&nbsp;</div>
                <div class='text4 border'><?php $now = new DateTime();echo $now->format('Y-m-d');  ?></div>
                <div class='text5 border'>&nbsp;</div>
            </div>
        </div>
        <div class='row' style='justify-content:space-between;'>
            <div class='col-sm-3'>
                <div class='text6'>Année de formation : 2022-2023</div>
                <div class='text7'>Groupe : <?php echo $groupe ?> </div>
                <div class='text8'>Mode de Formation : </div>
            </div>
            <div class='col-sm-6'>
                <div class='text9'>Niveau : </div>
                <div class='text10'>MasseHoriare/Semaine</div>
            </div>
        </div>
        <table border='2' cellspacing='0' align='center' class='table-bordered w-100'>
            <!--<caption>Timetable</caption>-->
            <tr>
                <td align='center' height='50'
                    width='100'><br>
                    <b>Jours/Périodes</b></br>
                </td>
                <td align='center' height='50'
                    width='100'>
                    <b>08:30-10:50</b>
                </td>
                <td align='center' height='50'
                    width='100'>
                    <b>11:10-13:15</b>
                </td>
                <td align='center' height='50'
                    width='100'>
                    <b>13:15-13:30</b>
                </td>
                <td align='center' height='50'
                    width='100'>
                    <b>13:30-15:50</b>
                </td>
                <td align='center' height='50'
                    width='100'>
                    <b>16:10-18:30</b>
                </td>
            
            </tr>
            <tr>
                <td align='center' height='50'>
                    <b>Lundi</b>
                </td>
                <td align='center' height='50'><?php getCourseHere(1,'lundi'); getCourseHere(12,'lundi');?></td>
                <td align='center' height='50'><?php getCourseHere(1,'lundi'); getCourseHere(12,'lundi');?></td>
                <td rowspan='6' align='center' height='50'>
                    <h2>P<br>A<br>U<br>S<br>E</h2>
                </td>
                <td align='center'height='50'><?php getCourseHere(3,'lundi'); getCourseHere(34,'lundi');?></td>
                <td align='center' height='50'><?php getCourseHere(4,'lundi'); getCourseHere(34,'lundi');?></td>
            </tr>
            <tr>
                <td align='center' height='50'>
                    <b>Mardi</b>
                </td>
                <td align='center' height='50'><?php getCourseHere(1,'mardi'); getCourseHere(12,'mardi');?></td>
                <td align='center' height='50'><?php getCourseHere(2,'mardi'); getCourseHere(12,'mardi');?></td>
                <td align='center'height='50'><?php getCourseHere(3,'mardi'); getCourseHere(34,'mardi');?></td>
                <td align='center' height='50'><?php getCourseHere(4,'mardi'); getCourseHere(34,'mardi');?></td>
            </tr>
            <tr>
            <td align='center' height='50'>
                    <b>Mercredi</b>
                </td>
                <td align='center' height='50'><?php getCourseHere(1,'mercredi'); getCourseHere(12,'mercredi');?></td>
                <td align='center' height='50'><?php getCourseHere(2,'mercredi'); getCourseHere(12,'mercredi');?></td>
                <td align='center'height='50'><?php getCourseHere(3,'mercredi'); getCourseHere(34,'mercredi');?></td>
                <td align='center' height='50'><?php getCourseHere(4,'mercredi'); getCourseHere(34,'mercredi');?></td>
            </tr>
            <tr>
                <td align='center' height='50'>
                    <b>Jeudi</b>
                </td>
                <td align='center' height='50'><?php getCourseHere(1,'jeudi'); getCourseHere(12,'jeudi');?></td>
                <td align='center' height='50'><?php getCourseHere(2,'jeudi'); getCourseHere(12,'jeudi');?></td>
                <td align='center'height='50'><?php getCourseHere(3,'jeudi'); getCourseHere(34,'jeudi');?></td>
                <td align='center' height='50'><?php getCourseHere(4,'jeudi'); getCourseHere(34,'jeudi');?></td>
            </tr>
            <tr>
                <td align='center' height='50'>
                    <b>Vendredi</b>
                </td>
                <td align='center' height='50'><?php getCourseHere(1,'vendredi'); getCourseHere(12,'vendredi');?></td>
                <td align='center' height='50'><?php getCourseHere(2,'vendredi'); getCourseHere(12,'vendredi');?></td>
                <td align='center'height='50'><?php getCourseHere(3,'vendredi'); getCourseHere(34,'vendredi');?></td>
                <td align='center' height='50'><?php getCourseHere(4,'vendredi'); getCourseHere(34,'vendredi');?></td>
            </tr>
            <tr>
            <td align='center' height='50'>
                    <b>Samedi</b>
                </td>
                <td align='center' height='50'><?php getCourseHere(1,'samedi'); getCourseHere(12,'samedi');?></td>
                <td align='center' height='50'><?php getCourseHere(2,'samedi'); getCourseHere(12,'samedi');?></td>
                <td align='center'height='50'><?php getCourseHere(3,'samedi'); getCourseHere(34,'samedi');?></td>
                <td align='center' height='50'><?php getCourseHere(4,'samedi'); getCourseHere(34,'samedi');?></td>
            </tr>
        </table>
    </div>
    <button onclick="Export2Word('content-viewGroupeTimeTable');" class="btn btn-primary">Telecharger l'emploi de temps word</button>

    <button onclick="save_as_pdf('content-viewGroupeTimeTable');" id="topdf" class="btn btn-primary">Telecharger l'emploi de temps pdf</button>



        