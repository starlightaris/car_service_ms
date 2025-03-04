<?php
include 'php/conf.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_email = $_SESSION['userId'];
$hasServiceHistory = false;
$hasActiveAppointments = false;

// Fetch customer ID
$sql1 = "SELECT customerId FROM customer WHERE email='$user_email'";
$result1 = mysqli_query($con, $sql1);

if ($result1 && mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
    $customerId = $row['customerId'];

    // Fetch service history
    $sql = "SELECT customer_invoice.customerInvoiceId, vehicle.plateNumber, customer_invoice.date, 
                   GROUP_CONCAT(service.serviceName SEPARATOR ', ') AS services
            FROM customer_invoice 
            INNER JOIN customerinvoice_service ON customer_invoice.customerInvoiceId = customerinvoice_service.customerInvoiceId  
            INNER JOIN service ON service.serviceId = customerinvoice_service.serviceId 
            INNER JOIN vehicle ON vehicle.vehicleId = customer_invoice.vehicleId  
            WHERE customer_invoice.customerId = '$customerId'
            GROUP BY customer_invoice.customerInvoiceId, vehicle.plateNumber, customer_invoice.date";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $hasServiceHistory = true;
    }

    // Fetch active appointments
    $sql_appointments = "SELECT appointment.appointmentId, vehicle.plateNumber, CONCAT(appointment.date, ' ', appointment.time) AS formatted_date, appointment.appointmentStatus, 
                                GROUP_CONCAT(service.serviceName SEPARATOR ', ') AS services
                         FROM appointment 
                         INNER JOIN vehicle ON vehicle.vehicleId = appointment.vehicleId 
                         INNER JOIN appointment_service ON appointment.appointmentId = appointment_service.appointmentId 
                         INNER JOIN service ON service.serviceId = appointment_service.serviceId 
                         WHERE appointment.customerId = '$customerId' 
                         AND (appointment.appointmentStatus = 'Pending' OR appointment.appointmentStatus = 'Confirmed')
                         AND CONCAT(appointment.date, ' ', appointment.time) >= NOW()
                         GROUP BY appointment.appointmentId, vehicle.plateNumber, appointment.date, appointment.time, appointment.appointmentStatus";
    $result_appointments = mysqli_query($con, $sql_appointments);

    if ($result_appointments && mysqli_num_rows($result_appointments) > 0) {
        $hasActiveAppointments = true;
    }

    // Fetch maintenance status for each vehicle
    $sql_maintenance = "SELECT vehicle.plateNumber, 
                            GROUP_CONCAT(DISTINCT maintenance.maintenanceStatus SEPARATOR ', ') AS statuses
                        FROM maintenance
                        INNER JOIN vehicle ON vehicle.vehicleId = maintenance.vehicleId 
                        WHERE vehicle.customerId = '$customerId' 
                        AND (maintenance.maintenanceStatus = 'Ongoing' OR maintenance.maintenanceStatus = 'Completed')
                        GROUP BY vehicle.plateNumber";
    $result_maintenance = mysqli_query($con, $sql_maintenance);

    if ($result_maintenance && mysqli_num_rows($result_maintenance) > 0) {
        $maintenanceStatus = [];
        while ($row = mysqli_fetch_assoc($result_maintenance)) {
            $maintenanceStatus[$row['plateNumber']] = $row['statuses'];
        }
    }

    // Fetch reminders for the logged-in user
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
    } else {
        $reminders = []; // Empty array if no reminders found
    }

    function getColorForPlateNumber($plateNumber)
    {
        // Simple hash function to generate a color
        $hash = md5($plateNumber);
        return '#' . substr($hash, 0, 6); // Use the first 6 characters of the hash as a hex color
    }
}

?>

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
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/style-vehicle-dashboard.css">
    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style-vehicle-dashboard.css">
    <!-- Custom JS -->
    <script src="js/vehicle-dashboard.js"></script>

</head>

<body>
    <div id="header">
    <?php include("header.php"); ?>
    </div>

    <!-- Maintenance Status Section -->
    <div style="margin-top: 150px;" class="container">
        <h3 style="color: #fff;">Maintenance Status</h3>
        <div class="row">
        <?php if (!empty($maintenanceStatus)): ?>
    <?php foreach ($maintenanceStatus as $plateNumber => $statuses): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($plateNumber); ?></h5>
                    <p class="card-text">
                        <?php
                        $statusArray = explode(', ', $statuses);
                        foreach ($statusArray as $status) {
                            if ($status === 'Ongoing') {
                                echo '
                                    <div class="progress mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        <i class="fas fa-car"></i>
                                    </div>';
                            } elseif ($status === 'Completed') {
                                echo '
                                    <div class="progress mb-2">
                                        <div class="progress-bar completed" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>';
                            } else {
                                echo '<span class="badge bg-secondary me-1">' . htmlspecialchars($status) . '</span>';
                            }
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="col">
        <p class="text-muted">No maintenances in progress.</p>
    </div>
<?php endif; ?>
        </div>
    </div>


    <!-- Active Appointments Section -->
    <div class="container">
        <h3 style="color: #fff;">Active Appointments</h3>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="activeAppointmentsTable">
                <thead class="table-light">
                    <tr>
                        <th data-sort="plateNumber">
                            Vehicle Plate Number <i class="fas fa-sort"></i>
                        </th>
                        <th data-sort="date">
                            Date and Time <i class="fas fa-sort"></i>
                        </th>
                        <th data-sort="status">
                            Status <i class="fas fa-sort"></i>
                        </th>
                        <th data-sort="services">
                            Description <i class="fas fa-sort"></i>
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($hasActiveAppointments): ?>
                        <?php while ($row = mysqli_fetch_assoc($result_appointments)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['plateNumber']); ?></td>
                                <td><?php echo htmlspecialchars($row['formatted_date']); ?></td>
                                <td>
                                    <span
                                        class="badge <?php echo $row['appointmentStatus'] === 'Pending' ? 'bg-warning' : 'bg-success'; ?>">
                                        <?php echo htmlspecialchars($row['appointmentStatus']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['services']); ?></td>
                                <td>
                                    <?php if ($row['appointmentStatus'] === 'Pending'): ?>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="cancelAppointment(<?php echo $row['appointmentId']; ?>)">
                                            Cancel
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            Cancel
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No Active Appointments</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reminders -->
    <div class="container">
        <h3 style="color: #fff;">Reminders</h3>
        <div class="timeline">
            <?php if (!empty($reminders)): ?>
                <?php foreach ($reminders as $reminder): ?>
                    <?php
                    $color = getColorForPlateNumber($reminder['plateNumber']);
                    ?>
                    <div class="timeline-item" style="border-left: 4px solid <?php echo $color; ?>;">
                        <h5 style="color: <?php echo $color; ?>;"><?php echo htmlspecialchars($reminder['plateNumber']); ?></h5>
                        <p><strong>Service:</strong> <?php echo htmlspecialchars($reminder['serviceName']); ?></p>
                        <p><strong>Mileage:</strong> <?php echo htmlspecialchars($reminder['mileage']); ?></p>
                        <p><strong>Reminder Date:</strong> <?php echo htmlspecialchars($reminder['reminderDate']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">No reminders set for any vehicle.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Service Histroy -->
    <div class="container">
        <h3 style="color: #fff;">Service History</h3>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="serviceHistoryTable">
                <thead class="table-light">
                    <tr>
                        <th data-sort="plateNumber">
                            Vehicle Plate Number <i class="fas fa-sort"></i>
                        </th>
                        <th data-sort="date">
                            Date <i class="fas fa-sort"></i>
                        </th>
                        <th data-sort="services">
                            Service Type <i class="fas fa-sort"></i>
                        </th>
                    </tr>
                </thead>
                <tbody id="historyTable">
                    <?php if ($hasServiceHistory): ?>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['plateNumber']); ?></td>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['services']); ?></td>
                                <td>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No Service History</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div style="margin-top: 100px;" id="footer">
        <?php include("footer.php"); ?>
    </div>

    <!-- nav-scroll frosted glass effect -->
    <script src="js/navbar-scroll.js"></script>
</body>

</html>