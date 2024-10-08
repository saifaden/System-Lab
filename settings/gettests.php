<?php
    include_once "connect.php";
    $db=connectionDB("lab");
    if (!empty($_POST['stuts'])) {
        switch ($_POST['stuts']) {
            case 'gettests':
                $tests=$db->query("SELECT testName,amount FROM tests WHERE unit='".$_POST['unit']."'")->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($tests);
                break;
            case "settests":
                // echo "UPDATE tests SET ".$_POST['Amount']." WHERE testName='".$_POST['test']."'";
                try {
                    $db->query("UPDATE tests SET amount=".$_POST['Amount']." WHERE testName='".$_POST['test']."'");
                } catch (PDOException $th) {
                    echo $th->getMessage();
                }
                break;
            case "get":
                /*
                  SELECT patient_ID,patients_tests.testName,`value`,unit,tests.testName FROM patients_tests JOIN tests ON tests.testName=patients_tests.testName and unit='hormones'
                */
                $p_test=$db->query("SELECT name,patients.id,patient_ID,patients_tests.testName,`value`,unit,tests.testName FROM patients_tests JOIN tests JOIN patients ON tests.testName=patients_tests.testName and unit='".$_POST['unit']."' and patients.id=patient_ID and status='new'")->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($p_test);
                break;
            case "savetest":
                try {
                    $data= json_decode($_POST['data']);
                    foreach ($data as $key => $value) {
                        echo $key." ".$value."\n";
                        $db->query("UPDATE patients_tests SET status='complete',value=".$value." WHERE patient_ID='".$_POST['id']."' AND testName='".$key."'");
                    }
                    // echo "UPDATE patients_tests SET status='new' value=".$_POST['testvalue']." WHERE patient_ID='".$_POST['id']."' AND testName='".$_POST['testName']."'";
                   
                } catch (PDOException $th) {
                    echo $th->getMessage();
                }
                break;
            case "deletesave":
                try {
                    // echo "DELETE FROM patients_tests  WHERE patient_ID='".$_POST['id']."' AND testName='".$_POST['testName']."'";
                    $db->query("DELETE FROM patients_tests  WHERE patient_ID='".$_POST['id']."' AND testName='".$_POST['testName']."'");
                } catch (PDOException $th) {
                    echo $th->getMessage();
                }
                break;
            default:
                header("location:../");
                exit;
                break;
        }
    
    }else{
        header("location:../");
        exit;
    }
?>