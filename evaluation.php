<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'évaluations</title>
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

    <br><br>

    <div class="page">
        <form action="evaluation.php" method="post"><input type="submit" class="updbtn" name="btnaff" value="Affiche evaluations"></form> 
        <form action="evaluation.php" method="post">            
            <table>
                <tr>
                    <th class="left"><label for="n_evaluation">Numero de l'évaluation à modifier -->></label></th>
                    <th class="right"><input type="text" class="chiffre" pattern="[0-9]+" name="select_eval" required></th>                
                </tr>
                <tr>
                    <th class="left"><label for="n_note">Entrez la note corrigée -->> </label></th>
                    <th class="right"><input type="text" class="chiffre" pattern="[0-9]+" name="correct" required></th>                
                </tr>
            </table>
            <input type="submit" class="updbtn" name="btncorrect" value="Corriger note!!">
        </form>
        <br><br>
    </div>
    <div class="page">
        <form action="evaluation.php" method="post">
            <table>
                <tr>
                    <th class="left"><label for="n_evaluation">Numero de l'évaluation à modifier -->></label></th>
                    <th class="right"><input type="text" class="chiffre" pattern="[0-9]+" name="select_desc" required></th>                
                </tr>
                <tr>
                    <th class="left"><label for="n_note">Entrez la description corrigée -->> </label></th>
                    <th class="right"><input type="text" id="texte" name="description" required></th>                
                </tr>
            </table>
            <input type="submit" class="updbtn" name="correctxt" value="Corriger description!!">
        </form>
    </div>
    <div class="page">
        <form action="index.php" method="post"><input type="submit" id="btnretour" name="btnretour" value="RETOUR ACCEUIL"></form>
    </div>
    <?php
        require_once 'fonctions.php';
       
        $conn = openConn(); 
        
        $moygeneral =  moyennegeneral($conn);

        echo "<script> document.getElementById(\"MoyGen\").innerText = $moygeneral; </script>";        

        if (isset($_POST['btnaff'])) afficheval($conn);        
        
        if (isset($_POST['btncorrect']))
        {  
            $notation = mysql_entities_fix_string($conn, $_POST['correct']);
            $examen = mysql_entities_fix_string($conn, $_POST['select_eval']);          
            $query  = "SELECT * FROM resultas";
            $query = $conn->query($query);
            if (!$query) die ("Échec d'accès à la base de données resultas");

            $query->data_seek((int)($examen)-1);
            $row = $query->fetch_array(MYSQLI_NUM);

            if($row[1] != null)
            {
                $conn->query("UPDATE resultas SET note = '$notation' WHERE id='$examen'"); 
                echo '<script>alert("note corrigée avec succés!");</script>';
                afficheval($conn) ;                                
            }
            else
            {
                echo '<script>alert("vous ne pouvez pas corriger une évaluation non notée!");</script>'; 
            }        
                     
        }

        if (isset($_POST['correctxt']))
        {
            $examen = mysql_entities_fix_string($conn, $_POST['select_desc']);
            $description = mysql_entities_fix_string($conn, $_POST['description']);

            $query  = "SELECT * FROM evaluations WHERE id='$examen'";
            $query = $conn->query($query);
            if (!$query) die ("Échec d'accès à la base de données evaluations");

            $query->data_seek(0);
            $row = $query->fetch_array(MYSQLI_NUM);

            $code = $row[1];
            $conn->query("UPDATE cours SET description_matiere = '$description' WHERE id='$code'"); 
            echo '<script>alert("Description corrigée avec succés!");</script>';
            afficheval($conn) ;
        }

        $conn->close();
    ?>
    
</body>
</html>