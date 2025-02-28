<?php
include 'php/conf.php';
if(isset($_POST['submit'])){
    $password=$_POST['txtpw'];

    $sql="UPDATE user SET password='$password' WHERE username='binithi.vihanga@gmail.com'";
    $result = mysqli_query($con, $sql);

    if (mysqli_query($con, $sql)) {
        $success_message[] = 'Password updated successfully!.';
        header('Location: login.php');
        exit();
        

    }
    else{
        echo "<script type='text/javascript'>alert('Invalid Token!');</script>";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KAE - Sign Up</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Social Media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom js Validation -->
    <script src="js/Validate-register.js"></script>
       
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style-register-appointment.css">
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    
    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!--timer success meassage-->
    <script>
  $(document).ready(function() {
   setTimeout(() => {
       $("#alertBox").fadeOut("slow", function() {
           $(this).remove();
       });
   }, 2000);
});
</script>
</head>

<body>
    <!--Header-->
    <div id="header"></div>
    <?php
    include("header.php");
    ?>

    <div class="container">
        <div class="form mx-auto">
            <div class="top text-center mb-4">
                <header class="h3 text-dark">Reset Password</header>
            </div>
          

            <form name="myform" onsubmit="return doValidate()" method="POST" action="">
            <?php
                    if (isset($success_message)) {
                        foreach ($success_message as $success_message) {
                            echo '<div id="alertBox" class="alert alert-success d-flex align-items-center p-2 small" role="alert" style="font-size: 14px; max-width: 400px; margin: auto; margin-bottom:20px ">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                     <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM12.97 5.97a.75.75 0 0 0-1.06 0L7.75 10.06 5.53 7.84a.75.75 0 1 0-1.06 1.06l2.75 2.75a.75.75 0 0 0 1.06 0l3.75-3.75a.75.75 0 0 0 0-1.06z"/>
                     </svg>
                       <div>
                        ' . $success_message . '
                     </div>
                      </div>';

                        }
                    }
    ?>
  


                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                   <!-- Hidden field to pass the token -->
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                        </div>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                        <!-- <input type="password" name="txtpassword" placeholder="Enter new password" required> -->
                        <input type="password" name="txtpw" id="txtpw" class="form-control input-field" placeholder="Enter new password"
                            required>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <small id="passwordError1" class="error-text">Password must have at least 8 characters, 1 uppercase,
                        1 lowercase, 1 number, and 1 special character.</small>
                    <!-- <small id="passwordError2" class="error-text">Passwords do not match.</small> -->
                </div>
             
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                        <input type="submit" class="btn btn-light w-50 d-block mx-auto submit" name="submit" value="Reset Password">
                        <!-- <button type="submit" name='submit'>Reset Password</button> -->

                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
    <!-- nav-scroll frosted glass effect -->
    <script src="js/navbar-scroll.js"></script>

    <!-- Footer -->
    <div id="footer">
        <?php include("footer.php"); ?>
    </div>

</body>

</html>
