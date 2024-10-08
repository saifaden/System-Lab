<?php
 function connectionDB($db)
    {
        try {
            $db=new pdo("mysql:host=localhost;dbname=$db;","root","");
            return $db;
       } catch (PDOException $e) {
          echo $e->getMessage();
          throw new Exception("Error Processing Request", 1);
          
       }
    }
   
?>