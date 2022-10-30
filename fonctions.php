<?php
              
    // Overture connection
    function openConn(){
        $servername = "localhost";
        $database = "gestion_evaluations";
        $username = "root"; 
        $password = "";   
        try {
            $conn = new mysqli($servername, $username, $password, $database);
            return $conn;
        }
        catch(mysqliException $e){
            return null; //je retourne null si la connexion n’a pas fonctionné
            }        
    }

    
    // Netoyage pour prévision Injection de code
    function mysql_entities_fix_string($conn, $string)
    {
      return htmlentities(mysql_fix_string($conn, $string));
    }    
  
    function mysql_fix_string($conn, $string)
    {
      if (get_magic_quotes_gpc()) 
      $string = stripslashes($string);
      return $conn->real_escape_string($string);
    }


    // Calcul moyenne Generale
    function moyennegeneral($conn){
      $query  = "SELECT * FROM cours";
      $cour = $conn->query($query);
      if (!$cour) die ("Échec d'accès à la base de données cours");  

      $query  = "SELECT * FROM evaluations";
      $cote = $conn->query($query);
      if (!$cote) die ("Échec d'accès à la base de données evaluations"); 

      $query  = "SELECT * FROM resultas";
      $note = $conn->query($query);
      if (!$note) die ("Échec d'accès à la base de données resultats");  

      $rows = $cour->num_rows;
      $rowseval = $cote->num_rows;
      $rowsresult = $note->num_rows;

      $total = 0;
      $coeficient = 0;

      for($j=0 ; $j < $rows ; ++$j) 
      {
          $cour->data_seek($j);
          $row = $cour->fetch_array(MYSQLI_NUM);                

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
      }        
      if($coeficient!=0) $moyenne = (int)($total / $coeficient) ;
      else $moyenne="--";
      return $moyenne;
    }


    //Affichage liste des evaluations
    function afficheval($conn)
    {      
      $query  = "SELECT * FROM evaluations";
      $cote = $conn->query($query);
      if (!$cote) die ("Échec d'accès à la base de données evaluations"); 

      $query  = "SELECT * FROM resultas";
      $note = $conn->query($query);
      if (!$note) die ("Échec d'accès à la base de données resultas");

      echo "<table class=\"tblphp\"><tr> <th>Id</th> <th>Code cours</th><th>Description</th><th>Evaluation</th><th>Note</th></tr>";

      $rows = $cote->num_rows;

      for($j=0 ; $j < $rows ; ++$j)
      {
          $cote->data_seek($j);
          $rowct = $cote->fetch_array(MYSQLI_NUM);
          $note->data_seek($j);
          $rowrst = $note->fetch_array(MYSQLI_NUM);


          $id = $rowct[0];
          $code = $rowct[1];
          $ponderation = $rowct[2];
          $evaluation = $rowct[3];
          $notation = $rowrst[1];

          $query  = "SELECT * FROM cours WHERE id='$code'";
          $result = $conn->query($query);
          if (!$result) die ("Échec de l'accès à la base de données");

          $row = $result->fetch_array(MYSQLI_NUM);
          $description = $row[1];
        
          echo "<tr><td>" . htmlspecialchars($id) . "</td><td>" . htmlspecialchars($code) ."</td><td>" . htmlspecialchars($description) ."</td>
                <td>" . htmlspecialchars($evaluation) . "</td><td>" . htmlspecialchars($notation) ."</td></tr>";
      }
      echo "</table>";
    }

    //Nombre d'heures normalement effectués depuis debut de formation
    function tempsdu(){
      // nombre de semaines depuis debut de formation
      $ecoule = (time()-mktime(0,0,0,5,24,2021))/3600/24/7;
      // nombre d'heures normalement effectuees (correction approximative de 4 semaines )
      $heursDu = (int)(($ecoule - 4) * 16);
      return $heursDu;
    }

    //Temps réellement effectué depuis dédut de formation
    function tempsreel($conn)
    {
      $query  = "SELECT * FROM resultas";
      $note = $conn->query($query);
      if (!$note) die ("Échec d'accès à la base de données resultats");
        
      $rows = $note->num_rows;

      $reelHr = 0;

      for($j=0 ; $j < $rows ; ++$j)
      {
        $note->data_seek($j);
        $row = $note->fetch_array(MYSQLI_NUM);

        if($j<51 && $row[1]!=null) $reelHr += 20 ;
        if(($j==51 || $j==52) && $row[1]!=null) $reelHr += 60 ;
        if($j==53 && $row[1]!=null) $reelHr += 270 ;            
      }

      return $reelHr;
    }

?>    