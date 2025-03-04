
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service History</title>
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Social Media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custome CSS -->
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!--css-->
    <link rel="stylesheet" href="css/style-serviceHistory.css">
</head>
<body>
<div id="header"></div>
    <?php
    include("header.php");
    ?>
<div class="container" >
    <h3 class="" style="margin-top:150px">Service History</h3>

    <!-- Filter/Search -->
    <!-- <input type="text" id="search" class="filter-input" placeholder="Filter change history..."> -->

    <?php
    // Connect to database
    include  'php/conf.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    
     $user_email = $_SESSION['userId'];
     //$user_email = "binithi.vihanga@gmail.com";
     $sql1="SELECT customerId FROM customer WHERE email='$user_email'";
     $result1=mysqli_query($con,$sql1);
 
     if ($result1 && mysqli_num_rows($result1) > 0) {
         $row = mysqli_fetch_assoc($result1);
         $customerId = $row['customerId'];
         $sql =  "SELECT customer_invoice.customerInvoiceId, vehicle.plateNumber, customer_invoice.date, 
                        GROUP_CONCAT(service.serviceName SEPARATOR ', ') AS services
                FROM customer_invoice 
                INNER JOIN customerinvoice_service ON customer_invoice.customerInvoiceId = customerinvoice_service.customerInvoiceId  
                INNER JOIN service ON service.serviceId = customerinvoice_service.serviceId 
                INNER JOIN vehicle ON vehicle.vehicleId = customer_invoice.vehicleId  
                WHERE customer_invoice.customerId = '$customerId'
                GROUP BY customer_invoice.customerInvoiceId, vehicle.plateNumber, customer_invoice.date";
         $result = mysqli_query($con, $sql);
         if ($result && mysqli_num_rows($result) > 0) {
            echo '
    <!-- Table -->
    <div class="table-responsive" >
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>Vehicle plate Number</th>
                    <th>Date</th>
                    <th>Service Type</th>
              
                </tr>
            </thead>
            <tbody id="historyTable">';
            // Loop through results
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . htmlspecialchars($row['plateNumber']) . '</td>
                        <td>' . htmlspecialchars($row['date']) . '</td>
                        <td>' . htmlspecialchars($row['services']) . '</td>
                        <td>
                       
                    </td>
                      </tr>';
            }
        
         echo'   </tbody>
        </table>
    </div>';
         }
         else {
            echo '  <div class="table-responsive">
          <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Vehicle plate Number</th>
                        <th>Date</th>
                        <th>Service Type</th>
                    </tr>
                </thead>
                </table>
                </div>
            <p><center>No Service History</center></p>';

        }
    }
        ?>
</div>

  <!-- nav-scroll frosted glass effect -->
  <script src="js/navbar-scroll.js"></script>

  <!-- Footer -->
  <div id="footer">
    <?php include("footer.php"); ?>


<!-- Filter/Search Script -->
<!-- <script>
    document.getElementById -->

</body>
</html>