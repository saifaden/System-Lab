<?php
switch ($variable) {
    case 'select':
        $table=$db->query("DESC ".$_POST["table"]);
        
        if ($_POST['edit']=='edit') {
                $data=$db->query("SELECT * FROM ".$_POST["table"])->fetchAll(PDO::FETCH_ASSOC)[0];
                foreach ($table->fetchAll(PDO::FETCH_ASSOC) as $key) {
                    echo "<div>".$key["Field"]."</div>";
                    echo " <input requrid name=".$key["Field"]."type='text value=".$data[$key["Field"]].">";  
                }
                echo "<div><button onclick=alert('prev')>prev</button><button onclick=alert('next')>next</button></div>";
            }
            else {
                foreach ($table->fetchAll(PDO::FETCH_ASSOC) as $key) {
                    echo "<div>".$key["Field"]."</div>";
                    echo " <input requrid name=".$key["Field"]."type='text>";  
                }
                echo "<br><button onclick=alert('submit')>submit</button>";
            }
        
        break;
    case 'edit':
        $table=$db->query("DESC tests");
        foreach ($table->fetchAll(PDO::FETCH_ASSOC) as $key) {
            echo "<div>".$key["Field"]."</div>";
            echo " <input requrid name=".$key["Field"]."type='text>";
        }
        break; 
    case 'add':
        try {
            //$db->query("INSERT INTO ".$_GET["table"]." (".$_POST['keys'].") VALUES ('".$_POST['values']."')");
            "INSERT INTO . (".$_POST['keys'].") VALUES ('".$_POST['values']."')";
           // echo "<span class=response>insert sucsees</span>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
        break;
    
    default:
        # code...
        break;
}
?>