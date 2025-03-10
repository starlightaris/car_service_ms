<?php

include 'php/conf.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_email = $_SESSION['userId'];
$vehicleId = $date = $time = $description = '';
$service = [];
$errors = [];
$success_message = [];
$bookedTimes = [];

//Fetching customer vehicles from db
$customerVehicles = [];
if (isset($user_email)) {
    $sql1 = "SELECT customerId FROM customer WHERE email='$user_email'";
    $result1 = mysqli_query($con, $sql1);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $customerId = $row['customerId'];

        // Fetch vehicles for the logged-in customer
        $sql2 = "SELECT vehicleId, plateNumber FROM vehicle WHERE customerId='$customerId' AND deleted_flag = FALSE";
        $result2 = mysqli_query($con, $sql2);

        if (!$result2) {
            die("Database query failed: " . mysqli_error($con));
        }

        $customerVehicles = [];
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $customerVehicles[] = $row2;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicleId = $_POST['vehicleId'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $description = $_POST['description'] ?? '';

    // Fetch booked time slots if a date is selected
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date'])) {
        $selectedDate = $_POST['date'];
        $sqlBooked = "SELECT time FROM appointment WHERE date = '$selectedDate'";
        $resultBooked = mysqli_query($con, $sqlBooked);

        if ($resultBooked) {
            while ($row = mysqli_fetch_assoc($resultBooked)) {
                $bookedTimes[] = $row['time'];
            }
        }
    } else {
        $bookedTimes = []; // Initialize as empty array if no date is selected
    }

    // Validate service checkboxes
    if (isset($_POST['service']) && is_array($_POST['service'])) {
        $service = $_POST['service']; // Get the array of selected services
    } else {
        $errors[] = "Please select at least one service.";
    }

    if (empty($errors)) {

        // Validate that the vehicleId exists in the vehicle table
        $sqlValidateVehicle = "SELECT vehicleId FROM vehicle WHERE vehicleId = ? AND customerId = ?";
        $stmtValidate = $con->prepare($sqlValidateVehicle);
        $stmtValidate->bind_param("ii", $vehicleId, $customerId);
        $stmtValidate->execute();
        $stmtValidate->store_result();

        if ($stmtValidate->num_rows === 0) {
            $errors[] = "Invalid vehicle selected. Please choose a valid vehicle.";
        } else {
            $query = "INSERT INTO appointment (date, time, appointmentStatus, description, vehicleId, customerId)
                  VALUES (?, ?, 'Pending', ?, ?, ?)";
            $stmt = $con->prepare($query);

            if ($stmt) {
                // Bind parameters
                $stmt->bind_param("sssii", $date, $time, $description, $vehicleId, $customerId);

                // Execute the statement
                if ($stmt->execute()) {
                    $appointmentId = $stmt->insert_id; // Get the ID of the newly inserted appointment

                    // Insert selected services into the appointment_service table
                    foreach ($service as $serviceId) {
                        $query2 = "INSERT INTO appointment_service (appointmentId, serviceId) VALUES (?, ?)";
                        $stmt2 = $con->prepare($query2);
                        $stmt2->bind_param("ii", $appointmentId, $serviceId);
                        $stmt2->execute();
                        $stmt2->close();
                    }

                    $success_message[] = "Appointment booked successfully!";
                    echo "<script>
                      document.addEventListener('DOMContentLoaded', function() {
                          var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                          confirmationModal.show();
                      });
                      </script>";
                } else {
                    $errors[] = "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                $errors[] = "Error: " . $con->error;
            }
        }
        $stmtValidate->close();
    }
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KAE - Make Reservation</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Social Media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custome CSS -->
    <link rel="stylesheet" href="css/style-register-appointment.css">
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <div id="header"></div>
    <?php
    include("header.php");
    ?>

    <div class="container">
        <div class="form mx-auto">
            <div class="top text-center mb-4">
                <header class="h3 text-dark">Book an Appointment</header>
            </div>
            <form id="appointmentForm" name="appointmentForm" onsubmit="return doValidate()" method="POST" novalidate>
                <!-- Select Vehicle (Dropdown) -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Vehicle</label>
                        <select id="txtboxes" name="vehicleId" required>
                            <option value="">Select Vehicle</option>
                            <?php
                            if (!empty($customerVehicles)) {
                                foreach ($customerVehicles as $vehicle) {
                                    echo "<option value='{$vehicle['vehicleId']}' " . ($vehicleId == $vehicle['vehicleId'] ? 'selected' : '') .
                                        ">{$vehicle['plateNumber']}</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No vehicles found. Please add a vehicle first.</option>";
                            }
                            ?>
                        </select>
                        <small id="vehicleError" class="error-text">Please select a vehicle.</small>
                    </div>
                </div>

                <!-- Date -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Date</label>
                        <input type="date" id="txtboxes" name="date" value="<?php echo htmlspecialchars($date); ?>"
                            min="<?php echo date('Y-m-d'); ?>" required>
                        <small id="dateError" class="error-text">Please select a date that is today or in the
                            future.</small>
                    </div>
                </div>

                <!-- Time (Buttons) DYNAMIC -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Time</label>
                        <div class="time-slot-container">
                            <?php
                            $validTimeSlots = ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
                            foreach ($validTimeSlots as $slot) {
                                $isBooked = in_array($slot, $bookedTimes);
                                echo "<button type='button' name='time' class='timeSelect" . ($isBooked ? ' disabled' : '') . "'"
                                    . ($isBooked ? ' disabled' : '') . ">$slot</button>";
                            }
                            ?>
                        </div>
                        <input type="hidden" name="time" id="selectedTime">
                        <small id="timeError" class="error-text">Please select a valid time slot.</small>
                    </div>
                </div>

                <!-- Services (Checkboxes) -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Select Services</label>
                        <div class="checkbox-group">
                            <?php
                            // Fetch services from the database
                            $sql3 = "SELECT serviceId, serviceName FROM service";
                            $result3 = mysqli_query($con, $sql3);

                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                echo "<input type='checkbox' name='service[]' value='{$row3['serviceId']}' "
                                    . (in_array($row3['serviceId'], $service) ? 'checked' : '')
                                    . "> {$row3['serviceName']}<br>";
                            }
                            ?>
                        </div>
                        <small id="servicesError" class="error-text">Please select at least one service.</small>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Description</label>
                        <textarea id="txtboxes" name="description" rows="4"
                            placeholder="Enter any additional details"><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                </div>

                <!-- Confirm Button -->
                <div class="row">
                    <input type="submit" id="confirmBtn" class="btn btn-light mx-auto submit" name="submit"
                        value="Confirm Appointment">
                </div>
            </form>
        </div>
    </div>

    <!-- Appointment Confirmed Message -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Appointment Confirmed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your appointment has been successfully placed! We'll get back to you shortly.
                </div>
                <div class="modal-footer">
                    <a href="index.php" class="btn btn-primary">Return Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation -->
    <script src="js/validate-appointment.js"></script>

    <!-- Pass bookedTimes from PHP to JavaScript -->
    <script>
        const bookedTimes = <?php echo json_encode($bookedTimes); ?>;
        console.log("Booked Times:", bookedTimes); // Debugging: Check the booked times
    </script>

    <!-- nav-scroll frosted glass effect -->
    <script src="js/navbar-scroll.js"></script>

    <!-- Footer -->
    <div id="footer">
        <?php include("footer.php"); ?>
    </div>
</body>

</html>