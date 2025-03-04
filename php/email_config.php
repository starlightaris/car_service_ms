<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendReminderEmail($customerEmail, $reminderDetails) {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'futuretech.tips@gmail.com';
        $mail->Password   = 'kanx malnw lwbb 1fgn';  // App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email details
        $mail->setFrom('futuretech.tips@gmail.com', 'Kavinda Auto Engineering');
        $mail->addAddress($customerEmail);
        $mail->isHTML(true);
        $mail->Subject = 'Upcoming Vehicle Service Reminder';

        // Email body
        $mail->Body = "
            <html>
            <body>
                <h2>Vehicle Service Reminder</h2>
                <p>Dear Customer,</p>
                <p>This is a reminder for your upcoming vehicle service:</p>
                <ul>
                    <li><strong>Plate Number:</strong> " . htmlspecialchars($reminderDetails['plateNumber']) . "</li>
                    <li><strong>Brand:</strong> " . htmlspecialchars($reminderDetails['brand']) . "</li>
                    <li><strong>Model:</strong> " . htmlspecialchars($reminderDetails['model']) . "</li>
                    <li><strong>Service:</strong> " . htmlspecialchars($reminderDetails['serviceName']) . "</li>
                    <li><strong>Due Date:</strong> " . htmlspecialchars($reminderDetails['reminderDate']) . "</li>
                </ul>
                <p>Please schedule your service soon!</p>
            </body>
            </html>
        ";

        // Send email and log result
        if ($mail->send()) {
            logNotification($reminderDetails['reminderId'], $customerEmail, 'success');
            return true;
        } else {
            logNotification($reminderDetails['reminderId'], $customerEmail, 'failed');
            return false;
        }
    } catch (Exception $e) {
        logNotification($reminderDetails['reminderId'], $customerEmail, 'failed');
        error_log("Reminder Email Error: " . $mail->ErrorInfo);
        return false;
    }
}

function logNotification($reminderId, $email, $status) {
    global $con;
    $sql = "INSERT INTO notification_log 
            (reminderId, email_address, status) 
            VALUES (?, ?, ?)";
    
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $reminderId, $email, $status);
    mysqli_stmt_execute($stmt);
}