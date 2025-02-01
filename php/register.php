<?php
include 'conf.php';

$fname=$_POST['txtfname'];
$lname=$_POST['txtlname'];
$email=$_POST['txtemail'];
$pw=$_POST['txtconpw'];
$phone=$_POST['txttel'];

$sql="SELECT userId FROM user WHERE  username='$email'";
$result=mysqli_query($con,$sql);

if (mysqli_num_rows($result) > 0) {
    // Email already registered
    $error_message = "Email already registered!";
}
else{


$sql1="INSERT INTO user (username,password) VALUES ('$email','$pw')";
$result1=mysqli_query($con,$sql1);

$userId = mysqli_insert_id($con);

$sql2="INSERT INTO customer (firstName,lastName,email,phone,userId) VALUES ('$fname','$lname','$email','$phone','$userId')";
$result2=mysqli_query($con,$sql2);


if ($result1 === false || $result2 === false) {
    echo "Error: " . mysqli_error($con);
}



}
?>