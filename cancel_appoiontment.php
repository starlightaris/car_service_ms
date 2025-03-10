<?php
include 'php/conf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $appointmentId = $data['appointmentId'];

    // Validate the appointment ID
if (empty($appointmentId)) {
    die(json_encode(["success" => false, "error" => "Appointment ID is required."]));
}

    // Update appointment status to "Canceled"
    $sql = "UPDATE appointment SET status = 'Canceled' WHERE appointmentId = '$appointmentId'";
    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
    }
}
?>