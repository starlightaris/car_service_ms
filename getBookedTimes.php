<?php
include 'php/conf.php';

if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];
    $sqlBooked = "SELECT time FROM appointment WHERE date = '$selectedDate'";
    $resultBooked = mysqli_query($con, $sqlBooked);

    $bookedTimes = [];
    if ($resultBooked) {
        while ($row = mysqli_fetch_assoc($resultBooked)) {
            $bookedTimes[] = $row['time'];
        }
    }

        // Debugging: Output the booked times
        error_log("Booked Times for $selectedDate: " . print_r($bookedTimes, true));

    // Return booked times as JSON
    header('Content-Type: application/json');
    echo json_encode(['bookedTimes' => $bookedTimes]);
} else {
    echo json_encode(['bookedTimes' => []]);
}
?>