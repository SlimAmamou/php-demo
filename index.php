<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluations</title>
    <link rel="stylesheet" href="style1.css" rel="stylesheet">
</head>
<body>
    <div class="page">
        <table>
            <tr>
                <th class="left"><label for="n_etudiant">ID de l'etudiant:</label></th>
                <th class="right"><label for="numero">633-224112</label></th>
            </tr>
            <tr>
                <th class="left"><label for="nom_etudiant">Non de l'étudiant:</label></th>
                <th class="right"><label for="numero">Slim Amamou</label></th>
            </tr>
            <tr>
                <th class="left"><label for="n_prog">Nom du programme:</label></th>
                <th class="right"><label for="programme">PROGRAMMEUR-ANALYSTE ORIENTÉ INTERNET – LEA.9C</label></th>
            </tr>
            <tr>
                <th class="left"><label for="Moyenne">Moyenne actuelle:</label></th>
                <th class="right"><div id="MoyGen" ></div></th>
            </tr>
        </table>
    </div>

    <br>

    <div class="page">
        <form action="index.php" method="post">
            <table>
                <tr>
                    <th class="left"><label for="liste_cours">Affichage liste de cours -->></label></th>
                    <th class="right"><input type="submit" class="bouton" name="affich_btn" value="Liste de cours"></th>
                </tr>
                <tr>
                    <th class="left"><label for="releve">Affichage moyenne par matière -->></label></th>
                    <th class="right"><input type="submit" class="bouton" name="affich_btn" value="Releve de notes"></th>
                </tr>
                <tr>
                    <th class="left"><label for="releve">Affichage de toutes les évaluations -->></label></th>
                    <th class="right"><input type="submit" class="bouton" name="affich_btn" value="Evaluations"></th>
                </tr>
            </table>
        </form>
        
        <br>
        <form action="note.php" method="post">
            <table>
                <tr>
                    <th class="left" id="note"><label for="notes">Assignement nouvelle note -->></label></th>
                    <th class="right"><input type="submit" class="bouton" name="assignement" value="Valider note"></th>
                </tr>
            </table>
        </form>

        <br>
        <form action="evaluation.php" method="post">
            <table>
                <tr>
                    <th class="left" id="evaluation"><label for="notes">Modifier évaluation -->></label></th>
                    <th class="right"><input type="submit" class="bouton" name="assignement" value="Modifier évaluation"></th>
                </tr>
            </table>
        </form>
    </div>
    <br><br>
    <?php
        require_once 'fonctions.php';
       
        $conn = openConn(); 
        
        $moygeneral =  moyennegeneral($conn);

        echo "<script> document.getElementById(\"MoyGen\").innerText = $moygeneral; </script>";

        if(isset($_POST['affich_btn'])){   // Affichage liste de cours

            if ($_POST['affich_btn'] == "Evaluations") afficheval($conn);
                      
            if ($_POST['affich_btn'] == "Liste de cours")
            {                             
                $query  = "SELECT * FROM cours";
                $result = $conn->query($query);
                if (!$result) die ("Échec d'accès à la base de données");                

                echo "<table class=\"tblphp\"><tr> <th>Id</th> <th>Description</th><th>Durée</th></tr>";

                $rows = $result->num_rows;
                
                for($j=0 ; $j < $rows ; ++$j) 
                {
                    $result->data_seek($j);
                    $row = $result->fetch_array(MYSQLI_NUM);

                    echo "<tr>";
                    for ($k = 0 ; $k < 3 ; ++$k)
                        echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
                    echo "</tr>";
                } 
                echo "</table>";              
            }


            if ($_POST['affich_btn'] == "Releve de notes")  // affichage Etat actuel des notes
            {
                

                $query  = "SELECT * FROM cours";
                $cour = $conn->query($query);
                if (!$cour) die ("Échec d'accès à la base de données cours");  

                $query  = "SELECT * FROM evaluations";
                $cote = $conn->query($query);
                if (!$cote) die ("Échec d'accès à la base de données evaluations"); 

                $query  = "SELECT * FROM resultas";
                $note = $conn->query($query);
                if (!$note) die ("Échec d'accès à la base de données resultats"); 
                
                echo "<table class=\"tblphp\"><tr> <th>Id</th> <th>Description</th><th>Moyenne</th></tr>";

                $rows = $cour->num_rows;
                $rowseval = $cote->num_rows;
                $rowsresult = $note->num_rows;

                for($j=0 ; $j < $rows ; ++$j) 
                {
                    $cour->data_seek($j);
                    $row = $cour->fetch_array(MYSQLI_NUM);

                    $total = 0;
                    $coeficient = 0;
                    $fini = false;

                    $id = $row[0] ;          // code matière
                    $description = $row[1] ; // description matière 

                    for($i=0 ; $i < $rowseval ; $i++)
                    {
                        $cote->data_seek($i);
                        $rowct = $cote->fetch_array(MYSQLI_NUM);
                        $note->data_seek($i);
                        $rowrst = $note->fetch_array(MYSQLI_NUM);
                        
                        if($id == $rowct[1] && $rowrst[1]!=null)
                        {
                            $total += ($rowrst[1]*$rowct[2]);
                            $coeficient += $rowct[2];
                            $fini = true;
                        }
                    }

                    if($coeficient!=0) $moyenne = (int)($total / $coeficient) ;
                    else $moyenne="--";
                                        
                    if($fini) echo "<tr><td>" . htmlspecialchars($id) . "</td><td>" . htmlspecialchars($description) ."</td><td>".$moyenne."</td></tr>";
                }
                echo "</table>";                
            }
            $conn->close();
        }         
             
    ?>
    <footer id="BasDePage"><label for="debut">Date de début de la formation: 24 Mai 2021</label> <br>
        <table>
            <tr>
                <th><label for="hour">Nombre d'heures éffectuées:</label></th>
                <th><div id="reeltime"><?php echo tempsreel($conn);?></div></th>
            </tr>
        </table>               
        <div id="temps"><?php 
        $i = tempsreel($conn) - tempsdu();
        if ($i < 0) echo "vous êtes en retard de ". -$i . " heures";
        if ($i >= 0) echo "vous êtes en avance de ". $i . " heures";
        ?></div>
    </footer>

</body>
</html>