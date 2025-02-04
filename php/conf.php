<?php

$servername="localhost";
$username="root";
$password="";
$dbname="car_service_db";

//create connection

$con=mysqli_connect($servername,$username,$password,$dbname);

if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}

?>