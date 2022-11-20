<?php 
session_start();
include('connection.php');
//checking for post method
if(isset($_POST["email"] )){

   
    $email=trim($_POST["email"]);
    $password=$_POST["password"];




    if(strlen($email)>=1){
        if(strpos($email,'@')==false){
            $_SESSION["error"]="Enter a valid email";
        }
        else{
            if(isset($password) && strlen($password)>=1){
                if(strlen($password)<=4){
                    $_SESSION["error"]="Password must be of minimum 5 characters";
                }
                else{
                    //DATABASE CONNECTIVITY
                    #$_SESSION["success"]="Success";
                    $email=stripcslashes($email);
                    $password=stripcslashes($password);
                    $email=mysqli_real_escape_string($con,$email);
                    $password=mysqli_real_escape_string($con,$password);
                    $sql="select * from users where email='$email' and password='$password'";
                    $result=mysqli_query($con,$sql);
                    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $count=mysqli_num_rows($result);
                    if($count==1){
                        header("Location: landing.php");
                        return;
                    }
                    else{
                        $_SESSION["error"]="Invalid email or password";
                    }
                }

            }
            else{
                $_SESSION["error"]="Password required";
            }
        }
    }
    else{
        $_SESSION["error"]="Email is required";
    }

    




    #if(isset($_SESSION["error"])){
       #$_SESSION["success"] = "";
    #}


}
else{
    $_SESSION["error"]=" ";
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
        
        <div class="header mb-5 myBorder">
            <h1 class="logo">Personalised WARDROBE</h1>
            <a class="nav-link" href="#">Login</a>
            <a class="nav-link" href=signup.php>Signup</a>
        </div>
        <div class="justify">

            <div class="row pt-5">

                <div class="col-xs-12 col-md-4 mt-5 mymargintop"> </div>
                <div class="col-xs-12 col-md-4 mt-5 mymargintop" id="signinform"> 
                    <div class="mt-5">
                        
                        
                        <form method="post" class=" myBorder p-5 shadow mb-5">
                        <div>
                            <h1 class="text-center">Login</h1>
                        </div>
                            
                            <div class="py-3">
                                <label for="email">MAIL ID:</label>
                                <input type="text" placeholder="ENTER MAIL ID" VALUE="" id="email" name="email" inputmode="email">
                            </div>
                            <div class="py-3">
                                <label for="password">PASSWORD:</label>
                                <input type="password" placeholder="ENTER PASSWORD" id="password" name="password">
                            </p>
                            
                            <input type="submit" class="btn btn-primary" value="Login">
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