<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>edit table</title>
        <style>
            html,body{
                height: 99%;
            }
            .contain{
                height: 99%;
                display: flex;
                flex-direction: row;
                justify-content: flex-start;
            }
            .tables{
                display: flex;
                flex-direction: column;
                justify-content: space-around;
            }
            .tables .select{
                background-color: blue;
                color: yellow;
                text-align: center;
            }
            .tables .select, .switch span{
                cursor:pointer;
            }
            .switch{
                display: flex;
                justify-content: space-around;
            }
            .edit , .add{
                text-align: center;
            }
            .hidden{
                display: none;
            }
            .active{
                border-bottom: solid cyan;
            }
        </style>
    </head>
    <body>
        <div class=contain>
            <!-- choose the edit table -->
            <form method='get'><input type="hidden" name="table"></form>
            <!-- display table content -->
            <div class=tables>
                <?php
                    foreach ($tables->fetchAll(PDO::FETCH_ASSOC) as $key) {
                        echo "<div class='select'>".$key["Tables_in_lab"]."</div>";
                    }
                ?>
            </div>
            <div style="width: 100%;">   <!--  edit taple -->
                    <div class='switch'>
                        <span>edit</span>
                        <span>add</span>
                    </div>
                <div class='add'>
                    <?php
                        $table=$db->query("DESC tests");
                        
                        if (isset($_GET['table'])){
                            $table=$db->query("DESC ".$_GET["table"]);
                            
                        }
                        foreach ($table->fetchAll(PDO::FETCH_ASSOC) as $key) {
                            echo "<div>".$key["Field"]."</div>";
                            echo " <input requrid name=<?=$key['Field'] ?> type='text'>";
                            $params.=$key["Field"].",";
                        }    
                    ?>   
                   
                    <br><button onclick='request("add")'>save</button>
                    <span id='response'></span>
                    <?php
                        if (!empty($_POST)) {
                            print_r($_POST);
                            // foreach($_POST as $item ){
                            //     if (empty($item)) {
                            //         array_push($error,$item);
                            //     }
                            // }
                                // try {
                                //     $db->query("INSERT INTO ".$_GET["table"]." (".implode(',',array_keys($_POST)).") VALUES ('".implode("','",array_values($_POST))."')");
                                //     echo "isert sussecful<br>";
                                // } catch (Exception $th) {
                                //     echo $th."<br>";
                                // }
                            
                        }
                    ?>
                </div>
                <div class='edit'>
                    <form >
                        <?php
                            if (isset($_GET["table"])) {
                                $tests=$db->query("SELECT * FROM ".$_GET["table"]);
                            }else{
                                $tests=$db->query("SELECT * FROM tests");
                                // print_r($tests->fetchAll(PDO::FETCH_ASSOC));
                            }
                            @$test=$tests->fetchAll(PDO::FETCH_ASSOC)[0];
                            if (!empty($test)) {
                                foreach (array_keys($test) as $key) {
                                    echo "<div>".$key."</div>";
                                    echo "<input type='text' value=".$test[$key]."><br>";
                                }
                                echo "<input type='submit'>";
                            }else{
                                echo "<span>empty please add item</span>";
                            }
                        ?>
                    </form>
                    <br>
                    <div id='btn'>
                        <button>next</button>
                        <button>prev</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        let select=document.querySelectorAll(".select");
        let input=document.querySelector("input");
        let form=document.querySelector("form");
        let Edits=document.querySelectorAll(".switch span")[0];
        let Adds=document.querySelectorAll(".switch span")[1];
        let Add=document.querySelector(".add");
        let Edit=document.querySelector(".edit");
        let resonse=document.getElementById("response");
        Add.classList.add('hidden')
        Edits.classList.add("active")
        select.forEach(function (el,i) {
                el.addEventListener("click",function (event) {
                    input.value=el.innerText;
                    form.submit();
                })
            });

            Edits.addEventListener('click',function(event) {
                Edit.classList.remove('hidden')
                Add.classList.add('hidden')
                this.classList.add('active')
                Adds.classList.remove('active')
            })
            Adds.addEventListener('click',function(event) {
                Add.classList.remove('hidden')
                Edit.classList.add('hidden')
                this.classList.add('active')
                Edits.classList.remove('active')
            })
            function request(state) {
                let inputs=document.querySelectorAll(`.${state} input`);
                let values="";
                inputs.forEach(function(el,i) {
                    values+="'"+el.value+"',";
                });
                xhr=new XMLHttpRequest();
                xhr.open("post","edit.php",true);
                xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                let keys="<?= $params?>";
                xhr.onreadystatechange=function(){
                   console.log(xhr.responseText);
                }
                xhr.send(`state=${state}&keys=${keys.substring(0,keys.length-1)}&values=${values.substring(0,values.length-1)}`);
                
                
               
            }
    </script>
</html>
<?php
    session_start();
    if (empty($_SESSION["id"])) {
        header("location:../index.html?status=2");
    }
    /*
    else
    echo @"welcome ".$_GET['userName']." you are in ".$_GET["unit"]." and your id is ".$_SESSION["id"];
*/
    // session_unset();
    // session_destroy();

    /*<?= $_GET['userName'] ?>*/
    /*<?= $_GET["unit"] ?>*/
?>