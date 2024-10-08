<?php
     include_once "settings/connect.php";
     session_start();
     $db=connectionDB("lab");
    if (!empty($_POST['username'] && !empty($_POST['password']))) {
         $query=$db->prepare("SELECT * FROM users WHERE userName=:name AND password=:password");
         $query->execute([':name'=>$_POST['username'],":password"=>$_POST['password']]);
         $user=$query->fetchAll(PDO::FETCH_ASSOC);
         $_SESSION["id"]=$user[0]["id"];

         if ($query->rowCount()==1) {
            switch ($user[0]['unit']) {
                  case 'admin':
                        header("location:units/admin.html");
                        exit;
                        break;
                  case 'registration':
                        header("location:units/registration.html");
                        exit;
                        break;
                  default:
                        header("location:units/unit.html?userName=".$_POST['username']."&unit=".$user[0]["unit"]);
                        exit;
                        break;
            }
               
               
        
         }elseif($query->rowCount()==0 || isset($_SESSION["id"])){
               header("location:index.html?status=1");
               exit;
         }else{echo "error ";}
         
         }else{
               header("location:index.html");
               exit;
        }
        

// $query=$db->prepare("SELECT * FROM users WHERE username=:name AND password=:password");
// $query->execute([':name'=>$_POST['username'],":password"=>$_POST['password']]);
// print_r($query->fetchAll(PDO::FETCH_ASSOC)[0]['unit']); 

?>
