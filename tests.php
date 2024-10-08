<!DOCTYPE html>
<?php
    include_once "settings/connect.php";
    $db=connectionDB("lab");
    $tests=$db->query("SELECT * FROM tests ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tests</title>
        <style>
            .title{
                text-align: center;
                background-color: yellow;
            }
            .data{
                display: flex;
                justify-content: space-between;
            }
            .test{
                background-color: yellow;
                color: red;
                font-weight: bold;
                font-size: large;
                width: 20%;
                text-align: center;
            }
            .tube{
                background-color: green;
                color: gray;
                font-weight: bold;
                font-size: large;
                width: 20%;
                text-align: center;
            }
            .price{
                background-color: blue;
                color: bisque;
                font-weight: bold;
                font-size: large;
                width: 20%;
                text-align: center;
            }
        </style>
    </head>
    <body>
    
       <div class="table">
            <div class="title">hormons</div><br>
            <div class="data">
                <span class='test'>Test name</span>
                <span class='tube'>TUBE</span>
                <span class='price' >price</span>
            </div>
            <br>
            <?php
                foreach ($tests as $test) {
            ?>
               <div class="data">
                    <span class="test"><?=$test['testName']?></span>
                    <span class="tube"><?=$test['tube']?></span>
                    <span class="price"><?=$test['price']?></span>
                </div>
                <br> 
            <?php } ?>
            
    </body>
</html>