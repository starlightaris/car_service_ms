<?php

include 'php/conf.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_email = $_SESSION['userId'];
$sql1 = "SELECT customerId FROM customer WHERE email='$user_email'";
$result1 = mysqli_query($con, $sql1);

if ($result1 && mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
    $customerId = $row['customerId'];

    if (isset($_POST['submit'])) {
        $plateNumber = $_POST['plateNumber'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $fuelType = $_POST['fuelType'];
        $manufacturedYear = $_POST['manufacturedYear'];

        $sql5 = "SELECT COUNT(*) AS count FROM vehicle WHERE plateNumber='$plateNumber'";
        $result5 = mysqli_query($con, $sql5);
        $row5 = mysqli_fetch_assoc($result5);

        if ($row5['count'] > 0) {
            $message[] = 'Vehicle already exists';
        } else {
            $sql2 = "INSERT INTO vehicle(customerId,plateNumber,brand,model,fuelType,manufacturedYear) VALUES ('$customerId','$plateNumber','$brand','$model','$fuelType','$manufacturedYear')";
            $result2 = mysqli_query($con, $sql2);

            if ($result2 == true) {
                $success_message[] = 'Vehicle details saved successfully.';
            }
        }
    }

    if (isset($_POST['update'])) {
        $plateNumber = $_POST['plateNumber'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $fuelType = $_POST['fuelType'];
        $manufacturedYear = $_POST['manufacturedYear'];

        $sql4 = "UPDATE vehicle SET brand='$brand',model='$model',fuelType='$fuelType',manufacturedYear='$manufacturedYear' WHERE customerId='$customerId' AND plateNumber='$plateNumber'";
        $result4 = mysqli_query($con, $sql4);

        if ($result4 == true) {
            $success_message[] = 'Vehicle details updated successfully.';
        }

    }
    if (isset($_POST['delete'])) {
        $plateNumber = $_POST['plateNumber'];

        if ($result1 && mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $customerId = $row['customerId'];

            $sql3 = "UPDATE vehicle SET deleted_flag=TRUE WHERE  customerId='$customerId' AND plateNumber='$plateNumber'";
            $result3 = mysqli_query($con, $sql3);

            if ($result3 == true) {
                $success_message[] = 'Vehicle details deleted successfully.';
            }
        } else {
            echo "<script type='text/javascript'>alert('No customer found.');</script>";
        }
    }

    // Handle reminder form submission
    if (isset($_POST['addreminder'])) {
        $vehicleId = $_POST['vehicle'];
        $serviceId = $_POST['service'];
        $mileage = $_POST['mileage'];
        $timePeriod = $_POST['timePeriod'];

        // Validate form data
        if (empty($vehicleId) || empty($serviceId) || empty($mileage) || empty($timePeriod)) {
            die("All fields are required.");
        }

        // Fetch customer ID
        $sql1 = "SELECT customerId FROM customer WHERE email='$user_email'";
        $result1 = mysqli_query($con, $sql1);

        if (!$result1) {
            die("Query failed: " . mysqli_error($con));
        }

        if (mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $customerId = $row['customerId'];

            // Check if customerId exists in the customer table
            $sql_check_customer = "SELECT COUNT(*) AS count FROM customer WHERE customerId='$customerId'";
            $result_check_customer = mysqli_query($con, $sql_check_customer);
            $row_check_customer = mysqli_fetch_assoc($result_check_customer);

            if ($row_check_customer['count'] == 0) {
                die("Invalid customer ID.");
            }

            // Check if reminder already exists
            $sql_check = "SELECT COUNT(*) AS count FROM reminder 
                          WHERE customerId='$customerId' 
                          AND vehicleId='$vehicleId' 
                          AND serviceId='$serviceId' 
                          AND mileage='$mileage'";
            $result_check = mysqli_query($con, $sql_check);
            $row_check = mysqli_fetch_assoc($result_check);

            if ($row_check['count'] > 0) {
                $message[] = 'Reminder already exists for this vehicle and service.';
            } else {
                // Calculate the reminder date
                $reminderDate = date('Y-m-d', strtotime("+$timePeriod months"));

                // Save the reminder to the database using prepared statements
                $stmt = $con->prepare("INSERT INTO reminder (customerId, vehicleId, serviceId, mileage, reminderDate, notification_sent, notification_date) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt) {
                    die("Prepare failed: " . $con->error);
                }

                $notification_sent = 0;
                $notification_date = NULL;
                $stmt->bind_param("iiissis", $customerId, $vehicleId, $serviceId, $mileage, $reminderDate, $notification_sent, $notification_date);

                if (!$stmt->execute()) {
                    die("Execute failed: " . $stmt->error);
                }

                $success_message[] = 'Reminder set successfully!';
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            die("No customer found.");
        }
    }

    // Handle reminder removal
    if (isset($_POST['removeReminder'])) {
        error_log("Remove Reminder form submitted."); // Debugging

        $reminderId = $_POST['reminderId'];
        error_log("Reminder ID to delete: " . $reminderId); // Debugging

        if (empty($reminderId)) {
            die("Reminder ID is required.");
        }

        // Delete the reminder from the database
        $sql = "DELETE FROM reminder WHERE reminderId = '$reminderId'";
        error_log("SQL Query: " . $sql); // Debugging

        if (mysqli_query($con, $sql)) {
            error_log("Reminder deleted successfully."); // Debugging
            $success_message[] = 'Reminder deleted successfully!';
            header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page
            exit();
        } else {
            error_log("Failed to delete reminder: " . mysqli_error($con)); // Debugging
            die("Failed to delete reminder: " . mysqli_error($con));
        }
    }

    // Fetch reminders for the logged-in customer
    $sql_reminders = "SELECT r.reminderId, v.plateNumber, s.serviceName, r.mileage, r.reminderDate 
                  FROM reminder r
                  INNER JOIN vehicle v ON r.vehicleId = v.vehicleId
                  INNER JOIN service s ON r.serviceId = s.serviceId
                  WHERE r.customerId = '$customerId' 
                  ORDER BY r.reminderDate ASC";
    $result_reminders = mysqli_query($con, $sql_reminders);

    if ($result_reminders && mysqli_num_rows($result_reminders) > 0) {
        $reminders = [];
        while ($row = mysqli_fetch_assoc($result_reminders)) {
            $reminders[] = $row;
        }
    }

} else {
    die("No customer found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Vehicle Details</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="css/style-offer.css"> -->
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/style-register-appointment.css"> -->
    <link rel="stylesheet" type="text/css" href="css/style-vehicle.css">
    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!--Custom js-->
    <script src="js/validate-vehicle.js"></script>

    <!--timer success meassage-->
    <script>
        $(document).ready(function () {
            setTimeout(() => {
                $("#alertBox").fadeOut("slow", function () {
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

    <div class="container " style="margin-top:150px ;margin-bottom:50px">
        <div class="row">
            <!-- Vehicle Cards -->
            <div class="col-md-6">
                <h3 style="color: #fff;">Your Vehicles</h3>
                <?php
                //retreiving cutomer id of teh user
                $sql1 = "SELECT customerId FROM customer WHERE email='$user_email'";
                $result1 = mysqli_query($con, $sql1);

                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $customerId = $row['customerId'];
                }
                //dispayng vehicle details
                $sql3 = "SELECT plateNumber, brand, model, fuelType, manufacturedYear FROM vehicle WHERE customerId='$customerId' AND deleted_flag=FALSE";
                $result3 = mysqli_query($con, $sql3);
                if (mysqli_num_rows($result3) > 0) {
                    while ($row = mysqli_fetch_assoc($result3)) {
                        echo '<div class="card" onclick="loadVehicleData(\'' . $row['plateNumber'] . '\', \'' . $row['brand'] . '\', \'' . $row['model'] . '\', \'' . $row['fuelType'] . '\', \'' . $row['manufacturedYear'] . '\');">                                   
                                    <h2>' . $row['manufacturedYear'] . ' ' . $row['brand'] . ' ' . $row['model'] . '</h2>
                                    <i class="fas fa-edit edit-icon"></i>
                                
                                    <div class="info-grid">
                                        <div>
                                            <span class="label">Plate Number</span>
                                            <span class="value">' . $row['plateNumber'] . '</span>
                                        </div>
                                    
                                        <div>
                                            <span class="label">Brand</span>
                                            <span class="value">' . $row['brand'] . '</span>
                                        </div>
                                        <div>
                                            <span class="label">Model</span>
                                            <span class="value">' . $row['model'] . '</span>
                                        </div>
                                        <div>
                                            <span class="label">Fuel Type</span>
                                            <span class="value">' . $row['fuelType'] . '</span>
                                        </div>
                                        <div>
                                            <span class="label">Manufactured Year</span>
                                            <span class="value">' . $row['manufacturedYear'] . '</span>
                                        </div>
                                    </div>          
                                </div>';
                    }
                }
                ?>
            </div>
            <!-- Vehicle Form -->
            <div class="col-md-6">
                <h3 style="color: #fff;">Add a Vehicle</h3>
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
                    <input type="text" id="plateNumber" name="plateNumber" placeholder=" ex :- ABC-1234" required>
                    <?php
                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<div class="error-message">' . $message . '</div>';
                        }
                    }
                    ?>
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" placeholder=" ex :- Toyota" required>
                    <label for="model">Model</label>
                    <input type="text" id="model" name="model" placeholder=" ex :- Allion" required>
                    <label for="fuelType">Fuel Type</label>
                    <input type="text" id="fuelType" name="fuelType"
                        placeholder=" ex :- Petrol , Diesel , Electric , Hybrid" required>
                    <label for="manufacturedYear">Manufactured Year</label>
                    <input type="text" id="manufacturedYear" name="manufacturedYear" required>
                    <input type="submit" id="btnsave" class="btn" name="submit" value="Save">
                    <input type="submit" id="btnup" class="btn" name="update" value="Update">
                    <input type="submit" id="btndlt" class="btn" name="delete" value="Delete"
                        onclick="return confirmDelete()">
                </form>
            </div>
        </div>
    </div>

    <!-- Reminder Form -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 style="color: #fff;">Set a Reminder</h3>
                <form id="reminderForm" method="POST" action="">

                    <!-- Vehicle Dropdown -->
                    <div class="mb-3">
                        <label for="vehicle" class="form-label">Select Vehicle</label>
                        <select class="form-select" id="vehicle" name="vehicle" required>
                            <option value="">Select a Vehicle</option>
                            <?php
                            $sql_vehicles = "SELECT vehicleId, plateNumber FROM vehicle WHERE customerId='$customerId' AND deleted_flag=FALSE";
                            $result_vehicles = mysqli_query($con, $sql_vehicles);
                            while ($row = mysqli_fetch_assoc($result_vehicles)) {
                                echo '<option value="' . $row['vehicleId'] . '">' . $row['plateNumber'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Service Dropdown -->
                    <div class="mb-3">
                        <label for="service" class="form-label">Select Service</label>
                        <select class="form-select" id="service" name="service" required>
                            <option value="">Select a Service</option>
                            <?php
                            $sql_services = "SELECT serviceId, serviceName FROM service";
                            $result_services = mysqli_query($con, $sql_services);
                            while ($row = mysqli_fetch_assoc($result_services)) {
                                echo '<option value="' . $row['serviceId'] . '">' . $row['serviceName'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Mileage Input -->
                    <div class="mb-3">
                        <label for="mileage" class="form-label">Current Mileage</label>
                        <input type="number" class="form-control" id="mileage" name="mileage"
                            placeholder="Enter current mileage" required>
                    </div>

                    <!-- Time Period Dropdown -->
                    <div class="mb-3">
                        <label for="timePeriod" class="form-label">Remind Me In</label>
                        <select class="form-select" id="timePeriod" name="timePeriod" required>
                            <option value="">Select a Time Period</option>
                            <option value="2">2 Months</option>
                            <option value="3">3 Months</option>
                            <option value="4">4 Months</option>
                            <option value="6">6 Months</option>
                            <option value="12">1 Year</option>
                            <option value="24">2 Years</option>
                        </select>
                    </div>

                    <!-- Set Reminder Button -->
                    <input type="submit" id="btnsave" class="btn" name="addreminder" value="Add Reminder">
                    <input type="submit" id="btnup" class="btn" name="clear" value="Clear"
                        onclick="clearReminderForm()">
                </form>
            </div>

            <!-- Reminders Cards -->
            <div class="col-md-6">
                <h3 style="color: #fff;">Your Reminders</h3>
                <div class="row">
                    <?php
                    if (!empty($reminders)) {
                        foreach ($reminders as $reminder) {
                            echo '
                            <div class="reminder-card">
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">' . htmlspecialchars($reminder['plateNumber']) . '</h5>
                                            <p class="card-text">
                                                <strong>Service:</strong> ' . htmlspecialchars($reminder['serviceName']) . '<br>
                                                <strong>Mileage:</strong> ' . htmlspecialchars($reminder['mileage']) . '<br>
                                                <strong>Reminder Date:</strong> ' . htmlspecialchars($reminder['reminderDate']) . '
                                            </p>
                                            <button class="btn btn-danger btn-sm" onclick="removeReminder(' . $reminder['reminderId'] . ')">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<div class="col">
                    <p class="text-muted">No reminders set for any vehicle.</p>
                </div>';
                    }
                    ?>
                </div>
            </div>
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