<?php
    $host="localhost";
    $user="root";
    $password="";
    $db_name="wardrobe";


    $con=mysqli_connect($host,$user,$password,$db_name);
    if(mysqli_connect_errno()){
        die("Failed to connect with database:".mysqli_connect_errno());
    }