<?php

include 'php/conf.php';

$vehicleNumber = $vehicleType = $date = $time = $serviceStation = '';
$services = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $vehicleNumber = $_POST['vehicleNumber'];
    $vehicleType = $_POST['vehicleType'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $serviceStation = $_POST['serviceStation'];

    // Validate service checkboxes
    if (isset($_POST['service']) && is_array($_POST['service'])) {
        $services = $_POST['service']; // Get the array of selected services
        $servicesString = implode(', ', $services); // Convert array to a comma-separated string
    } else {
        $errors[] = "Please select at least one service.";
    }

    if (empty($errors)) {
        $query = "INSERT INTO appointments (vehicleNumber, vehicleType, date, time, serviceStation, servicesString)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query);

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ssssss", $vehicleNumber, $vehicleType, $date, $time, $serviceStation, $servicesString);

            // Execute the statement
            if ($stmt->execute()) {
                // echo "<script>alert('Appointment booked successfully!');</script>";
                // header('location:login.php');

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

    // Display errors (if any)
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
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
            <form id="appointmentForm" name="appointmentForm" onsubmit="return doValidate()" method="POST">
                <!-- Vehicle Number -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Vehicle Number</label>
                        <input type="text" id="txtboxes" name="vehicleNumber" placeholder="ABC-1234"
                            value="<?php echo htmlspecialchars($vehicleNumber); ?>" required>
                    </div>
                </div>

                <!-- Vehicle Type -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Vehicle Type</label>
                        <select id="txtboxes" name="vehicleType" required>
                            <option value="">Select Vehicle Type</option>
                            <option value="car" <?php echo ($vehicleType === 'car') ? 'selected' : ''; ?>>Car</option>
                            <option value="suv" <?php echo ($vehicleType === 'suv') ? 'selected' : ''; ?>>SUV</option>
                            <option value="truck" <?php echo ($vehicleType === 'truck') ? 'selected' : ''; ?>>Truck
                            </option>
                            <option value="motorcycle" <?php echo ($vehicleType === 'motorcycle') ? 'selected' : ''; ?>>
                                Motorcycle
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Date -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Date</label>
                        <input type="date" id="txtboxes" name="date" value="<?php echo htmlspecialchars($date); ?>"
                            required>
                    </div>
                </div>

                <!-- Appointment Time -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label for="time">Time</label>
                        <input type="time" id="txtboxes" name="time" value="<?php echo htmlspecialchars($time); ?>"
                            required>
                    </div>
                </div>

                <!-- Service Station -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label for="serviceStation">Service Station</label>
                        <select id="txtboxes" name="serviceStation" required>
                            <option value="">Choose Station</option>
                            <option value="Gampola" <?php echo ($serviceStation === 'Gampola') ? 'selected' : ''; ?>>
                                Gampola
                            </option>
                            <option value="Panadura" <?php echo ($serviceStation === 'Panadura') ? 'selected' : ''; ?>>
                                Panadura
                            </option>
                            <option value="Kandy" <?php echo ($serviceStation === 'Kandy') ? 'selected' : ''; ?>>
                                Kandy</option>
                        </select>
                    </div>
                </div>

                <!-- Services (Checkboxes) -->
                <div class="form-group">
                    <div class="row mb-3">
                        <label>Select Services</label>
                        <div class="checkbox-group">
                            <input type="checkbox" name="service[]" value="fullService" <?php echo (in_array('fullService', $services)) ? 'checked' : ''; ?>> Full Service<br>
                            <input type="checkbox" name="service[]" value="underCarriageWithoutTyre" <?php echo (in_array('underCarriageWithoutTyre', $services)) ? 'checked' : ''; ?>> Under
                            Carriage
                            Service
                            without Tyre Remove<br>
                            <input type="checkbox" name="service[]" value="oilFilterChange" <?php echo (in_array('oilFilterChange', $services)) ? 'checked' : ''; ?>> Oil & Filter
                            Change<br>
                            <input type="checkbox" name="service[]" value="exteriorCutPolish" <?php echo (in_array('exteriorCutPolish', $services)) ? 'checked' : ''; ?>> Exterior cleaning -
                            Cut &
                            Polish<br>
                            <input type="checkbox" name="service[]" value="interiorCleaning" <?php echo (in_array('interiorCleaning', $services)) ? 'checked' : ''; ?>> Interior
                            cleaning<br>
                            <input type="checkbox" name="service[]" value="totalTreatment" <?php echo (in_array('totalTreatment', $services)) ? 'checked' : ''; ?>> Total treatment
                            (Interior +
                            Exterior cleaning)<br>
                            <input type="checkbox" name="service[]" value="radiatorCoolantChange" <?php echo (in_array('radiatorCoolantChange', $services)) ? 'checked' : ''; ?>> Radiator
                            coolant
                            change<br>
                            <input type="checkbox" name="service[]" value="brakeCleaner" <?php echo (in_array('brakeCleaner', $services)) ? 'checked' : ''; ?>> Brake cleaner<br>
                            <input type="checkbox" name="service[]" value="brakeOilChange" <?php echo (in_array('brakeOilChange', $services)) ? 'checked' : ''; ?>> Brake oil change<br>
                            <input type="checkbox" name="service[]" value="headLampsCleaner" <?php echo (in_array('headLampsCleaner', $services)) ? 'checked' : ''; ?>> Head lamps
                            cleaner<br>
                            <input type="checkbox" name="service[]" value="wheelAlignment" <?php echo (in_array('wheelAlignment', $services)) ? 'checked' : ''; ?>> Wheel Alignment<br>
                            <input type="checkbox" name="service[]" value="hybridServices" <?php echo (in_array('hybridServices', $services)) ? 'checked' : ''; ?>> Hybrid Services<br>
                        </div>
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

    <!-- nav-scroll frosted glass effect -->
    <script src="js/navbar-scroll.js"></script>

    <!-- Footer -->
    <div id="footer">
        <?php include("footer.php"); ?>
    </div>

</body>

</html>