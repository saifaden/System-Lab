<?php
    include_once "connect.php";
    $db=connectionDB("lab");

    if (!empty($_POST['state'])) {
        switch($_POST['state']){
            case 'id':
                try {
                    @$id=$db->query("SELECT id FROM `patients` ORDER BY id DESC LIMIT 1")->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
                    $count=substr($id,8);
                    if (substr($id,0,8) == date("Ymd")) {
                        echo date("Ymd").++$count;
                    }else{
                        echo date("Ymd")."1";
                    }
                } catch (PDOException $err) {
                    echo "1".date("dmY");
                }
                break;
            case 'add1':
                try {
                     $db->query("INSERT IGNORE INTO patients (".$_POST['keys'].") VALUES (".$_POST['values'].")");
                     $tests=$db->query("SELECT testName FROM tests ORDER BY id");
                     echo "<div>";
                    foreach ($tests->fetchAll(PDO::FETCH_ASSOC) as $key) {
                    echo "<option value='".$key['testName']."'>";
                    
                    }
                    echo "<button onclick='Switch(false)'><-</button>
                    </div>";
                } catch (Exception $err) {
                    echo $err->getMessage();
                }
                break;
            case 'add2':
                try {
                    
                    $amount= $db->query("SELECT amount FROM tests WHERE testName='".$_POST['test']."'")->fetchAll(PDO::FETCH_ASSOC)[0]['amount'];
                    if (+$amount > 0) {
                        $db->query("INSERT INTO patients_tests (patient_ID,testName) VALUES ('".$_POST['id']."','".$_POST['test']."')");
                        $db->query("UPDATE `tests` SET amount='".--$amount."' WHERE testName='".$_POST['test']."'");
                        $tests=$db->query("SELECT testName FROM patients_tests WHERE status='new' AND patient_ID=".$_POST['id']);
                    echo "<div>";
                   foreach ($tests->fetchAll(PDO::FETCH_ASSOC) as $key) {
                   echo "<div class='test_p'>".$key['testName']."</div>";
                   }
                    }elseif(+$amount==0){
                        echo "<div>amount</div>";
                    }
                   
                    
               } catch (Exception $err) {
                   echo $err->getMessage();
               }
                break;
            case "getTest":
                try {
                    $dates=$db->query("SELECT `date` FROM patients_tests WHERE status='new' AND patient_ID=".$_POST['id']." GROUP BY `date`");  
                    foreach ($dates->fetchAll(PDO::FETCH_ASSOC) as $date) {
                        $tests=$db->query("SELECT testName FROM patients_tests WHERE status='new' AND patient_ID=".$_POST['id']." AND `date`='".$date["date"]."'");
                        echo "<hr><div class='p".$date["date"]."'><span class='date_p' style='text-align:center;display: block;'>".$date['date']."</span>";
                        foreach ($tests->fetchAll(PDO::FETCH_ASSOC) as $test) {
                            echo "<div class='test_p'>".$test['testName']."</div>";
                        }
                        echo "</div><hr>";
                    }
            
               } catch (Exception $err) {
                   echo $err->getMessage();
               }
               break;
            case "getOLdTest":
                try {
                    $dates=$db->query("SELECT `date` FROM patients_tests WHERE status='complete' AND patient_ID=".$_POST['id']." GROUP BY `date`");
                    foreach ($dates->fetchAll(PDO::FETCH_ASSOC) as $date) {
                        $tests=$db->query("SELECT testName,`value` FROM patients_tests WHERE status='complete' AND patient_ID=".$_POST['id']." AND `date`='".$date["date"]."'");
                        echo "<hr><div class='p".$date["date"]."'><span class='date' style='text-align:center;display: block;'>".$date['date']."</span>";
                        foreach ($tests->fetchAll(PDO::FETCH_ASSOC) as $test) {
                            echo "<div class='test_p'>".$test['testName']." : ".$test['value']."</div>";
                        }
                        echo "</div><button class='p".$date["date"]."' onclick='printTest(this.className)'>print</button><hr>";
                    }
            
               } catch (Exception $err) {
                   echo $err->getMessage();
               }
               break;
            case "search":
                try {
                    $patient=$db->query("SELECT * FROM patients WHERE id=".$_POST['id']);//;
                    if ($patient->rowCount()>0) {
                        echo json_encode($patient->fetchAll(PDO::FETCH_ASSOC)[0]);
                    }else{
                        echo json_encode([]);
                    }
                    
               } catch (Exception $err) {
                    
                   echo $err->getMessage();
               }
                break;
            default:
                
                break;

        }
    }else{
        header("location:../");
        exit;
    }
    
?>