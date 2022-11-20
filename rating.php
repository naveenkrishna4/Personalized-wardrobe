<?php 
session_start();
include('connection.php');
require_once "pdo.php";
//checking for post method
if(isset($_POST["email"])){
    $email=trim($_POST["email"]);
    $email=stripcslashes($email);
    $email=mysqli_real_escape_string($con,$email);
    $sql="select * from users where email='$email'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count=mysqli_num_rows($result);
    if($count==1){
        if(isset($_POST["rate"] )){
            $rate=$_POST["rate"];
            $sql="update users set rating=:rate where email=:email";
            #$sql="insert into users(rating) values(:rate)";
            $stmnt=$pdo->prepare($sql);
            $stmnt->execute(array(
                ':rate'=>htmlentities($rate),
                ':email'=>htmlentities($email),

            )
            );
            header("Location: index.php");
            return;
        }
        else{
            $_SESSION["error"]="rate us out of 10";
        }
    }
    else{
        $_SESSION["error"]="sign up first";
    }
}
else{
    $_SESSION["error"]="enter a valid email";
}
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
    
        <div class="justify">

            <div class="row pt-5">

                <div class="col-xs-12 col-md-4 mt-5 mymargintop"> </div>
                <div class="col-xs-12 col-md-4 mt-5 mymargintop" id="signinform"> 
                    <div class="mt-5">
                        
                        
                        <form method="post" class=" myBorder p-5 shadow mb-5">
                        <div>
                            <h1 class="text-center">RATE US</h1>
                        </div>
                            <div class="py-3">
                                <label for="rate">RATE US OUT OF 10:</label>
                                <input type="text" placeholder="ENTER A NUMBER" VALUE="" id="rate" name="rate" required autocapitalize="words" autofocus ><br>
                            </div>
                            <div class="py-3">
                                <label for="email">MAIL ID:</label>
                                <input type="text" placeholder="ENTER MAIL ID" VALUE="" id="email" name="email" inputmode="email">
                            </div>

                            <input type="submit" class="btn btn-primary" value="Rate">
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





