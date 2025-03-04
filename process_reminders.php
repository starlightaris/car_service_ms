<?php
include('php/conf.php');
include('php/email_config.php');

function processUpcomingReminders($con) {
    // Query to find reminders due in 7 days and not yet notified
    $sql = "SELECT 
                r.reminderId, 
                v.plateNumber, 
                v.brand,
                v.model,
                s.serviceName, 
                r.reminderDate, 
                c.email
            FROM reminder r
            JOIN vehicle v ON r.vehicleId = v.vehicleId
            JOIN customer c ON r.customerId = c.customerId
            JOIN service s ON r.serviceId = s.serviceId
            WHERE r.reminderDate = DATE_ADD(CURDATE(), INTERVAL 7 DAY)
            AND r.notification_sent = 0";

    $result = mysqli_query($con, $sql);

    while ($reminder = mysqli_fetch_assoc($result)) {
        // Send email
        if (sendReminderEmail($reminder['email'], $reminder)) {
            // Mark reminder as notified
            $updateSql = "UPDATE reminder 
                          SET notification_sent = 1 
                          WHERE reminderId = " . $reminder['reminderId'];
            mysqli_query($con, $updateSql);
        }
    }
}

// This can be called via cron job or manually
processUpcomingReminders($con);