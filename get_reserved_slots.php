<?php
include 'php/conf.php';

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Query to get booked time slots for the selected date
    $query = "SELECT time FROM appointment WHERE date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookedTimes = [];
    while ($row = $result->fetch_assoc()) {
        $bookedTimes[] = $row['time'];
    }

    echo json_encode($bookedTimes); // Return booked time slots as JSON
}
?>
