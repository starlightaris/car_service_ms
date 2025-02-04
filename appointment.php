<?php
include 'php/conf.php';
$error_message = [];
if (isset($_POST['submit'])) {
    $vehicleNumber = $_POST['vehicleNumber'];
    $vehicleType = $_POST['vehicleType'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $serviceStation = $_POST['serviceStation'];
    $service = $_POST['service'];

    $sql = "INSERT INTO appointments (vehicle_number, vehicle_type, date, time, service_station, services)
                  VALUES ('$vehicleNumber', '$vehicleType', '$date', '$time', '$serviceStation', '$service')";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Appointment booked successfully!');</script>";
    } else {
        $errors[] = "Error: " . mysqli_error($con);
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>

<!DOCTYPE html>
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
    <link rel="stylesheet" href="css/style-appointment.css">
</head>

<body>
    <div class="container">
        <h1>Make A Reservation</h1>
        <form id="appointmentForm" name="appointmentForm" onsubmit="return doValidate()" method="POST">
            <div class="form-group">
                <label>Vehicle Number</label>
                <input type="text" id="txtboxes" name="vehicleNumber" placeholder="ABC-1234" required>
            </div>
            <div class="form-group">
                <label>Vehicle Type</label>
                <select id="txtboxes" name="vehicleType" required>
                    <option value="">Select Vehicle Type</option>
                    <option value="car">Car</option>
                    <option value="suv">SUV</option>
                    <option value="truck">Truck</option>
                    <option value="motorcycle">Motorcycle</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" id="txtboxes" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" id="txtboxes" name="time" required>
            </div>
            <div class="form-group">
                <label for="serviceStation">Service Station</label>
                <select id="txtboxes" name="serviceStation" required>
                    <option value="">Choose Station</option>
                    <option value="kottawa">Kottawa</option>
                    <option value="koswatta">Koswatta</option>
                    <option value="battaramulla">Battaramulla</option>
                </select>
            </div>
            <div class="form-group">
                <label>Select Services</label>
                <div class="checkbox-group">
                    <input type="checkbox" name="service" id="service" value="fullService"> Full Service<br>
                    <input type="checkbox" name="service" id="service" value="underCarriageWithoutTyre"> Under Carriage
                    Service without Tyre Remove<br>
                    <input type="checkbox" name="service" id="service" value="oilFilterChange"> Oil & Filter Change<br>
                    <input type="checkbox" name="service" id="service" value="exteriorCutPolish"> Exterior cleaning -
                    Cut & Polish<br>
                    <input type="checkbox" name="service" id="service" value="interiorCleaning"> Interior cleaning<br>
                    <input type="checkbox" name="service" id="service" value="totalTreatment"> Total treatment (Interior
                    + Exterior cleaning)<br>
                    <input type="checkbox" name="service" id="service" value="radiatorCoolantChange"> Radiator coolant
                    change<br>
                    <input type="checkbox" name="service" id="service" value="brakeCleaner"> Brake cleaner<br>
                    <input type="checkbox" name="service" id="service" value="brakeOilChange"> Brake oil change<br>
                    <input type="checkbox" name="service" id="service" value="headLampsCleaner"> Head lamps cleaner<br>
                    <input type="checkbox" name="service" id="service" value="wheelAlignment"> Wheel Alignment<br>
                    <input type="checkbox" name="service" id="service" value="hybridServices"> Hybrid Services<br>
                </div>
            </div>
            <button type="submit">Book Appointment</button>
        </form>
    </div>

    <!-- Validation -->
    <script src="js/validate(appointment).js"></script>

    <!-- nav-scroll frosted glass effect -->
    <script src="js/navbar-scroll.js"></script>

    <!-- Footer -->
    <div id="footer">
        <?php include("footer.php"); ?>
    </div>

</body>

</html>