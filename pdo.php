<?php 
try{
$servername="localhost";
$username="root";
$password="";
$dbname="wardrobe";
$pdo=new PDO("mysql:host=".$servername.";dbname=".$dbname,$username,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
echo "Connection Displayed:".$e->getMessage();
}


?>