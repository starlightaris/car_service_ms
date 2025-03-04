<?php
include 'php/conf.php'; // Include your database configuration

// Get the raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Extract the reminder ID
$reminderId = $data['reminderId'];

// Validate the reminder ID
if (empty($reminderId)) {
    die(json_encode(["success" => false, "error" => "Reminder ID is required."]));
}

// Delete the reminder from the database
$sql = "DELETE FROM reminder WHERE reminderId = '$reminderId'";
if (mysqli_query($con, $sql)) {
    echo json_encode(["success" => true]); // Success response
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($con)]); // Error response
}
?>