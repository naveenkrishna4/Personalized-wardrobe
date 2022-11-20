<?php 
session_start();
require_once "pdo.php";
require_once "connection.php";
//checking for post method
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(  isset($_POST["color"] )){
   
    
        $color=$_POST["color"];
    
        
        if(isset($_POST["type"])){
            $type=$_POST["type"];
            if(!isset($_POST["cloth"])){
                $_SESSION["error"]="Cloth material required";
            }
            if(isset($_POST["cloth"])){
    
                /*
                $cloth=$_POST["cloth"];
                $sql="insert into data(type,cloth,color) values(:type,:cloth,:color)";
    
                $stmnt=$pdo->prepare($sql);
                $stmnt->execute(array(
                ':type'=>htmlentities($type),
                ':cloth'=>htmlentities($cloth),
                ':color'=>htmlentities($color)
                )
                );
    
                $next_page = "Location: output.php?color_id=1";
                header($next_page);
                return;
                */
                $next_page = "Location: output.php?color_id=".$_POST["color"];
                header($next_page);
                return;
    
            }
            else{
                $_SESSION["error"]="Cloth material required";
            }
        }
        else{
        $_SESSION["error"]="type of event required";
        }
    
    
    }
    else{
        $_SESSION["error"]="Color required";
    }
    
}

$sql="select * from color";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);


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
                        
                        
                        <form method="post" class=" myBorder p-5 shadow mb-5">
                        <div>
                            <h1 class="text-center">WELCOME LET'S START CHOOSING</h1>
                        </div>
                            <div class="py-3">
                                type:
                                <input type="radio" name="type" id="formal" value="f">
                                <label for="formal">formal</label>
                                <input type="radio" name="type" id="casual" value="c">
                                <label for="casual">casual</label>
                            </div>
                            <div class="py-3">
                                cloth:
                                <input type="radio" name="cloth" id="normal" value="n">
                                <label for="normal">normal</label>
                                <input type="radio" name="cloth" id="denim" value="d">
                                <label for="denim">denim</label>
                            </div>
                            <div class="py-3">
                                <label for="color">color:</label>
                                <select name="color" id="color">
                            <?php
                            foreach ($con->query("SELECT * FROM color") as $results)
                            {

                                echo "<option value=".$results['id'].">".$results["name"]."</option>";
                               
                              
                               
                            }
                        
                            ?>

                        </select>
                                
                            </div>
                            <input type="submit" class="btn btn-primary" value="Get my match">

                            
                            <?php

                            if(isset($_SESSION["error"])){
                                echo "<p class='error-div'>".$_SESSION["error"]."</p>";
                            }

                            #if(isset($_SESSION["success"])){
                                #echo "<p class='success-div'>".$_SESSION["success"]."</p>";
                            #}
                                
                            
                            ?>
                        </form> 
                    </div>

                </div>
            </div>


        
        
        </div>
    </body>
</html>