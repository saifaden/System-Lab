<?php
    include_once "connect.php";
    $db=connectionDB("lab");
    $tables=$db->query("SHOW TABLES");
    if (!empty($_POST['state'])) {
        switch ($_POST['state']) {
            case 'tests':
                $tests=$db->query("SELECT testName FROM tests ORDER BY id");
                foreach ($tests->fetchAll(PDO::FETCH_ASSOC) as $key) {
                    echo "<div class=test><div class='select'>".$key['testName']."</div><button name=".$key['testName']." onclick='deleteTest(this.name)'>delet</button></div>";
                }
                echo "<br><button onclick='switchState()'>add</button>";
                break;
            case 'change':
                $test=$db->query("SELECT * FROM tests WHERE id='".$_POST['id']."'")->fetchAll(PDO::FETCH_ASSOC)[0];
                print "
                <input name='id'  type='hidden' value='".$test['id']."'>
                <div>testName</div>
                <input requrid name='testName' type='text' value='".$test['testName']."'>
                <div>Host ID</div>
                <input requrid name='HostID' type='text' value='".$test['HostID']."'>
                <div>unit</div> 
                 <input requrid name='unit' type='text' value='".$test['unit']."'>
                 <div>tube</div> 
                <input requrid name='tube' type='text' value='".$test['tube']."'>
                <div>price</div> 
                <input requrid name='price' type='text' value='".$test['price']."'>
                <div>amount</div> 
                <input requrid name='amount' type='text' value='".$test['amount']."'>
                <div>Ref Range</div> 
                <input requrid name='RefRange' type='text' value='".$test['RefRange']."'>
                <div>unit test</div> 
                <input requrid name='unitTest' type='text' value='".$test['unitTest']."'>
                <br>
                <button onclick='editTest()'>submit</button>
                <br>
                <span id='editResponse'></span>";
                break;
            case 'addTest':
                try {
                    $db->query("INSERT INTO tests (".$_POST['keys'].") VALUES (".$_POST['values'].")");
                    echo "Isert sussecful";
                } catch (Exception $err) {
                    echo $err->getMessage();
                }
                break;
            case 'editTest':
                try {
                    $db->query("UPDATE `tests` SET ".$_POST['query']);
                    echo "edited sussecful<br>";
                } catch (Exception $err) {
                    echo $err->getMessage();
                }
                break;
            case 'deleteTest':
                try {
                    $db->query("DELETE FROM `tests` WHERE testName='".$_POST['test']."'");
                    echo"ok";
                } catch (Exception $err) {
                    echo $err->getMessage();
                }
                break;
            case 'getref':
                $data=[];
                $TestName=$db->query("SELECT testName FROM tests ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($TestName as $key=>$value) {
                    
                    $TestRef=$db->query("SELECT RefRange,unitTest FROM tests WHERE testName='".$value['testName']."' ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
                    $data[$value['testName']]=[$TestRef[0]["RefRange"],$TestRef[0]["unitTest"]];
                }
                
               echo json_encode($data);
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
