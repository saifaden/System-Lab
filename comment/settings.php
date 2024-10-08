<?php
    try {
        $db=new pdo("mysql:host=localhost;dbname=lab;","root","");
   } catch (PDOException $e) {
      echo $e->getMessage();
   }
   $tables=$db->query("SHOW TABLES");
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>settings</title>
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
                justify-content: space-between;
            }
            .tables .select{
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <div class=contain>
            <form ><input type="hidden" name="table"></form>
            
            <div class=tables>
                <?php
                    foreach ($tables->fetchAll(PDO::FETCH_ASSOC) as $key) {
                        echo "<div class='select'>".$key["Tables_in_lab"]."</div>";
                    }
                    
                ?>
            </div>
            <div>
                <?php
                    $table=$db->query("DESC tests");
                    
                    if (isset($_GET['table'])){
                        $table=$db->query("DESC ".$_GET["table"]);
                        
                    }
                    foreach ($table->fetchAll(PDO::FETCH_ASSOC) as $key) {
                        echo "<div>".$key["Field"]."</div>";
                    }

                ?>
            </div>
        </div>
    </body>
    <script>
        let select=document.querySelectorAll(".select");
        let input=document.querySelector("input");
        let form=document.querySelector("form");
        select.forEach(function (el,i) {
                el.addEventListener("click",function (event) {
                    input.value=el.innerText;
                    form.submit();
                })
            });
    </script>
</html>