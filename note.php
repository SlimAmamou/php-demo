<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigner note</title>
    <link rel="stylesheet" href="style1.css" rel="stylesheet">
</head>
<body>
    <div class="page">
        <table>
            <tr>
                <th class="left"><label for="n_etudiant">ID de l'étudiant:</label></th>
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

    <div class="page">
        <form action="note.php" method="post"><input type="submit"class="newnote" name="btnaff" value="Affiche evaluations"></form>
        <form action="note.php" method="post">        
            <table>
                <tr>
                    <th class="left"><label for="n_evaluation">Numéro de  l'évaluation  -->></label></th>
                    <th class="right"><input type="text" class="chiffre" pattern="[0-9]+" name="select_eval"  required></th>                
                </tr>
                <tr>
                    <th class="left"><label for="n_note">Entrez la note -->> </label></th>
                    <th class="right"><input type="text" class="chiffre"   name="assign" pattern="[0-9]+" required></th>                
                </tr>
            </table>
            <input type="submit" class="newnote" name="btnassign" value="Valider_note">
        </form>
        <br><br>
    </div>
    <div class="page">
        <form action="index.php" method="post"><input type="submit"class="newnote" name="btnretour" value="RETOUR ACCEUIL"></form>
    </div>

    <?php
        require_once 'fonctions.php';
       
        $conn = openConn(); 
        
        $moygeneral =  moyennegeneral($conn);

        echo "<script> document.getElementById(\"MoyGen\").innerText = $moygeneral; </script>";

        if (isset($_POST['btnaff'])) afficheval($conn);          

        if (isset($_POST['btnassign']))
        {
            $notation = mysql_entities_fix_string($conn, $_POST['assign']);
            $examen = mysql_entities_fix_string($conn, $_POST['select_eval']); 
             
            $query  = "SELECT * FROM resultas";
            $query = $conn->query($query);
            if (!$query) die ("Échec d'accès à la base de données resultas");
            $query->data_seek((int)($examen)-1);
            $row = $query->fetch_array(MYSQLI_NUM);
            if($row[1] != null)
            {
                echo '<script>alert("vous ne pouvez pas assigner une évaluation notée!");</script>';                 
            }
            else
            {
                $assign = $conn->query("UPDATE resultas SET note = '$notation' WHERE id='$examen'");
                echo '<script>alert("note assignée avec succés!");</script>';
                afficheval($conn) ;
            }
            
        }         
        $conn->close();
    ?>
    
</body>
</html>