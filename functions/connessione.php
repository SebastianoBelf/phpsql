<?php
$server = "localhost";
$username = "root";
$password = "root";
$name = "db1";
$conn = new mysqli($server,$username,$password,$name);
if($conn->connect_error){
    die("Connection failed : ". $conn->connect_error);
}
//echo "Connected Successfully <BR>";
?>