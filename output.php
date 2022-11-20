<?php 
session_start();
require_once "connection.php";
//checking for post method





?>



<!doctype html>
<html>
    <head>
        <title>Personalised Wardrobe</title>

        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

        <link rel="stylesheet" href="assets/css/signup.css">
        <link rel="stylesheet" href="assets/css/common.css">


    </head>
    <body>

    <!--
<div class="image">
            <img class="banner-image" src="assets/images/wardrobe1.jpg">
        </div>

-->
        
        <div class="header mb-5 myBorder">
            <h1 class="logo">Personalised WARDROBE</h1>
        </div>
        <div class="justify">

            <div class="row pt-5">

                <div class="col-xs-12 col-md-4 mt-5 mymargintop"> </div>
                <div class="col-xs-12 col-md-4 mt-5 mymargintop" id="signinform"> 
                    <div class="mt-5">
                        
                        
                        <div class=" myBorder p-5 shadow mb-5">
                        <div>
                            <h1 class="text-center">Your Matchup</h1>

                            <div>
                                <ul>
                                <?php
                                $color_id =$_GET["color_id"];

                                    
                                     foreach ($con->query("select name from color where (id in (select matching_color_id from combination where (color_id = $color_id)))") as $results)
                                     {
         
                                        //echo "<div  style='background-color:".$results["name"]."'></div>";
                                         echo "<li style='color:white;background-color:"    .   $results["name"] ."'>".  $results["name"]. "</li>";
                                        
                                       
                                        
                                     }
                                
                                ?>
                                </ul>
                            </div>
                        </div>
        
                        </div> 
                    </div>

                </div>
            </div>


        
        
        </div>
    </body>
</html>