<?php
   include_once "connect.php";
   $db=connectionDB("lab");
      if (!empty($_POST['stuts'])) {
         $stat=$db->query("SELECT * FROM users WHERE password='".$_POST['old']."' AND username='".$_POST['userName']."'");
         if ($stat->rowCount()==1) {
            try {
            $db->query("UPDATE `users` SET password='".$_POST['new']."' WHERE password='".$_POST['old']."' AND username='".$_POST['userName']."'");
            echo "edited sussecful";
            } catch (Exception $err) {
            echo $err->getMessage();
            }
         }else {
            echo "password not correct";
         }
      }else {
         header("location:../");
         exit;
      }
   
      
?>