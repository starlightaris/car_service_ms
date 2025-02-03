<?php


include 'php/conf.php';
$error_message = [];
if(isset($_POST['submit'])){
   

$fname=$_POST['txtfname'];
$lname=$_POST['txtlname'];
$email=$_POST['txtemail'];
$pw=$_POST['txtconpw'];
$phone=$_POST['txttel'];

$sql="SELECT userId FROM user WHERE  username='$email'";
$result=mysqli_query($con,$sql);


if (mysqli_num_rows($result) > 0) {
    // Email already registered
    $error_message[] = 'Email already registered!';

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

header('location:login.php');

}
}

?>

<!DOCTYPE html>
<html>
    <head>

  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/Validate-register.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style-register.css">
    </head>
    <body>
    <?php
      include("header.php");
      ?>
   
    
        <div class="container">
        
            <div class="form mx-auto"> 
                <div class="top text-center mb-4">
                    <header class="h3">Register</header>
                </div>
                <div id="alertBox1" class="alert alert-danger mt-2 d-none" role="alert">
                    Please enter a valid email address.
                </div>
                
                <form name="myform" onsubmit="return doValidate()" method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="txtfname" class="form-control input-field" placeholder="First Name" value="<?php echo isset($fname) ? $fname : ''; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="txtlname" class="form-control input-field" placeholder="Last Name" value="<?php echo isset($lname) ? $lname : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="email" name="txtemail" class="form-control input-field" placeholder="Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <small id="emailError" class="error-text"> Please enter a valid email address.</small>
                       
                       <?php 
                  
                  if (isset($error_message) ) {
                    foreach($error_message as $error_message){
                        echo '<div class="error-message">'.$error_message.'</div>';
                  }
                }
              ?>

                                                
                    </div>
            
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" name="txtpw" class="form-control input-field" placeholder="Password"  required>
                                </div>
                            </div>
                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" name="txtconpw" class="form-control input-field" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <small id="passwordError1" class="error-text">Password must have at least 8 characters, 1 uppercase, 1 lowercase, 1 number, and 1 special character.</small>
                            <small id="passwordError2" class="error-text">Passwords do not match.</small>
                        </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="tel" name="txttel" class="form-control input-field" placeholder="Phone Number" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <small id="telError" class="error-text">Invalid phone number. Please enter exactly 10 digits</small>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary w-100 submit" name="submit" value="Register">
                            </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>