<?php

include 'php/conf.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


 $user_email = $_SESSION['userId'];
//$user_email="binithi.vihanga@gmail.com";
if(isset($_POST['submit'])){
    $plateNumber=$_POST['plateNumber'];
    $brand=$_POST['brand'];
    $model=$_POST['model'];
    $fuelType=$_POST['fuelType'];
    $manufacturedYear=$_POST['manufacturedYear'];

    //retreiving cutomer id of teh user
    $sql1="SELECT customerId FROM customer WHERE email='$user_email'";
    $result1=mysqli_query($con,$sql1);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $customerId = $row['customerId'];
        
        // $sql3="DELETE FROM vehicle WHERE customerId='$customerId'";
        // $result3=mysqli_query($con,$sql3);
        $sql5="SELECT COUNT(*) AS count FROM vehicle WHERE plateNumber='$plateNumber'";
        $result5=mysqli_query($con,$sql5);
        $row5 = mysqli_fetch_assoc($result5);

        if ($row5['count'] > 0) {
            $message[] = 'Vehicle already exists';
        }
        else{
        $sql2="INSERT INTO vehicle(customerId,plateNumber,brand,model,fuelType,manufacturedYear) VALUES ('$customerId','$plateNumber','$brand','$model','$fuelType','$manufacturedYear')";
        $result2=mysqli_query($con,$sql2);

        if ($result2 == true) {
            $success_message[] = 'Vehicle details saved successfully.';
            //header('location:index.php');
        }
    }
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
     <!-- jQuery -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!--validations-->
    <script src="js/validate-vehicle.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style-register-appointment.css">
    <link rel="stylesheet" type="text/css" href="css/style-vehicle.css">
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

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
             <!-- <h1>Enter Vehicle Details</h1> -->
    <form id="vehicleForm" name="vehicleForm" method="POST" action="" onsubmit="return doValidate()" class="mx-auto mb-4" style="margin-top:150px">

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


    <label for="plateNumber">Plate Number</label>
    <input type="text" id="plateNumber" name="plateNumber" placeholder="  ex :- ABC-1234" required>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="error-message">' . $message . '</div>';
        }
    }
    ?>

    <label for="brand">Brand</label>
    <input type="text" id="brand" name="brand" placeholder="  ex :- Toyota"  required >

    <label for="model">Model</label>
    <input type="text" id="model" name="model" placeholder=" ex :- Allion"  required>

    <label for="fuelType">Fuel Type</label>
    <input type="text" id="fuelType" name="fuelType" placeholder=" ex :- Petrol , Diesel , Electric , Hybrid" required>

    <label for="manufacturedYear">Manufactured Year</label>
    <input type="text" id="manufacturedYear" name="manufacturedYear" required>

    <input type="submit" id="btnsave" class="btn  w-40 d-block mx-auto"  name="submit" value="Save">


</form>


      <!-- nav-scroll frosted glass effect -->
      <script src="js/navbar-scroll.js"></script>

<!-- Footer -->
<div id="footer">
    <?php include("footer.php"); ?>
</div>

</body>

</html>