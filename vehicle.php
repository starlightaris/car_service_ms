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
        }
    }
}
    else {
      
        echo "<script type='text/javascript'>alert('No customer found.');</script>";

    }
  
}
if(isset($_POST['update'])){
    $plateNumber=$_POST['plateNumber'];
    $brand=$_POST['brand'];
    $model=$_POST['model'];
    $fuelType=$_POST['fuelType'];
    $manufacturedYear=$_POST['manufacturedYear'];

    $sql1="SELECT customerId FROM customer WHERE email='$user_email'";
    $result1=mysqli_query($con,$sql1);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $customerId = $row['customerId'];
        
        // $sql3="DELETE FROM vehicle WHERE customerId='$customerId'";
        // $result3=mysqli_query($con,$sql3);
        $sql4="UPDATE vehicle SET brand='$brand',model='$model',fuelType='$fuelType',manufacturedYear='$manufacturedYear' WHERE customerId='$customerId' AND plateNumber='$plateNumber'";
        $result4=mysqli_query($con,$sql4);

        if ($result4 == true) {
            $success_message[] = 'Vehicle details updated successfully.';
        }
    }
    else {
      
        echo "<script type='text/javascript'>alert('No customer found.');</script>";

    }
}
if(isset($_POST['delete'])){
    $plateNumber=$_POST['plateNumber'];

    $sql1="SELECT customerId FROM customer WHERE email='$user_email'";
    $result1=mysqli_query($con,$sql1);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $customerId = $row['customerId'];
        
         $sql3="UPDATE vehicle SET deleted_flag=TRUE WHERE  customerId='$customerId' AND plateNumber='$plateNumber'";
         $result3=mysqli_query($con,$sql3);
     

        if ($result3 == true) {
            $success_message[] = 'Vehicle details deleted successfully.';
        }
    }
    else {
      
        echo "<script type='text/javascript'>alert('No customer found.');</script>";

    }
}




?>




<!-- vehicle_form.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome for social media icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Custom CSS -->
  <!-- <link rel="stylesheet" type="text/css" href="css/style-offer.css"> -->
  <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
  <link rel="stylesheet" type="text/css" href="css/register-appointment.css">
  <link rel="stylesheet" type="text/css" href="css/style-vehicle.css">

  <!-- Custom Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <!-- Bootstrap -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
 crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->

         <!-- jQuery -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!--validations-->
    <script src="js/validate-vehicle.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Enter Vehicle Details</title>
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
<div id="header"></div>
    <?php
    include("header.php");
    ?>
    
    <div class="container " style="margin-top:100px ;margin-bottom:50px">
    <div class="row">
        <!-- Column for Vehicle Cards -->
        <div class="col-md-6">
    <?php
       //retreiving cutomer id of teh user
       $sql1="SELECT customerId FROM customer WHERE email='$user_email'";
       $result1=mysqli_query($con,$sql1);
   
       if ($result1 && mysqli_num_rows($result1) > 0) {
           $row = mysqli_fetch_assoc($result1);
           $customerId = $row['customerId'];
       }
//dispayng vehicle details
    $sql3="SELECT plateNumber,brand,model,fuelType,manufacturedYear FROM vehicle WHERE customerId='$customerId' AND deleted_flag=FALSE";
    $result3=mysqli_query($con,$sql3);
    if (mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_assoc($result3)) {
    echo '
    <div class="card" onclick="loadVehicleData(\'' . $row['plateNumber'] . '\', \'' . $row['brand'] . '\', \'' . $row['model'] . '\', \'' . $row['fuelType'] . '\', \'' . $row['manufacturedYear'] . '\')">
            
            <h2>'.$row['manufacturedYear'].' '.$row['brand'].' '.$row['model'].'</h2>
            <i class="fas fa-edit edit-icon"></i>
           
            <div class="info-grid">
                <div>
                    <span class="label">Plate Number</span>
                    <span class="value">'.$row['plateNumber'].'</span>
                </div>
               
                <div>
                    <span class="label">Brand</span>
                    <span class="value">'.$row['brand'].'</span>
                </div>
                <div>
                    <span class="label">Model</span>
                    <span class="value">'.$row['model'].'</span>
                </div>
                <div>
                    <span class="label">Fuel Type</span>
                    <span class="value">'.$row['fuelType'].'</span>
                </div>
                <div>
                    <span class="label">Manufactured Year</span>
                    <span class="value">'.$row['manufacturedYear'].'</span>
                </div>
            </div>
   
          
        </div>';
  

    }
}
?>
</div>
     <!-- Column for Vehicle Form -->
     <div class="col-md-6">
    <!-- <h1>Enter Vehicle Details</h1> -->
    <form id="vehicleForm" name="vehicleForm" method="POST" action="" onsubmit="return doValidate()">

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
        <input type="text" id="plateNumber" name="plateNumber" placeholder="ABC-1234" required>
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo '<div class="error-message">' . $message . '</div>';
            }
        }
        ?>

        <label for="brand">Brand</label>
        <input type="text" id="brand" name="brand" required >

        <label for="model">Model</label>
        <input type="text" id="model" name="model" required>

        <label for="fuelType">Fuel Type</label>
        <input type="text" id="fuelType" name="fuelType" required>

        <label for="manufacturedYear">Manufactured Year</label>
        <input type="text" id="manufacturedYear" name="manufacturedYear" required>

        <input type="submit" id="btnsave" class="btn"  name="submit" value="Save">
        <input type="submit" id="btnup" class="btn" name="update" value="Update">
        <input type="submit" id="btndlt" class="btn" name="delete" value="Delete" onclick="confirmDelete()">

    </form>
</div>
   </div>
  </div>
            <!-- JavaScript to Populate Form -->
<script>
    function loadVehicleData(plateNumber, brand, model, fuelType, manufacturedYear) {
        document.getElementById("plateNumber").value = plateNumber;
        document.getElementById("brand").value = brand;
        document.getElementById("model").value = model;
        document.getElementById("fuelType").value = fuelType;
        document.getElementById("manufacturedYear").value = manufacturedYear;
    }
</script>


  <!-- nav-scroll frosted glass effect -->
  <script src="js/navbar-scroll.js"></script>

  <!-- Footer -->
  <div id="footer">
    <?php include("footer.php"); ?>
</div>
</body>
</html>