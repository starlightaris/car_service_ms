<?php
include 'php/conf.php';
if (isset($_POST['submit'])) {

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phoneNumber'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact (message,firstName,lastName,email,phone) VALUES('$message','$fname','$lname','$email','$phone')";
    $result = mysqli_query($con, $sql);

    if ($result == true) {
        $success_message[] = 'Message submitted';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KAE - Contact Us</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- Font Awesome for Social Media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style-offer.css">
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/style-contact.css">
    <!-- Custom Validation (js) -->
    <script src="js/validate-contact.js"></script>
    
    <!--timer success meassage-->
    <script>
   $(document).ready(function() {
    setTimeout(() => {
        $("#alertBox").fadeOut("slow", function() {
            $(this).remove();
        });
    }, 3000);
});

    </script>
</head>

<body>
    <div class="hero-image">
        <div id="header"></div>
        <?php
        include("header.php");
        ?>

        <div class="hero-text">
            <h1>Contact Us</h1>
            "Have a question or need assistance? Get in touch with us through our contact form, email, or phone. We're here to help!"
        </div>
    </div>

    <div class="container mt-5 p-5 shadow">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-6">
                <h1>Contact Us</h1>

                <h2>Find <span class="text-danger">Us</span></h2>

                <strong>HOTLINE:</strong> 011 2 640 640<br><br>
                <strong>SALES:</strong> 011 2 640 640<br><br>
                <strong>EMAIL:</strong> <a
                    href="mailto:info@kavindaautoengineering.lk">info@kavindaautoengineering.lk</a><br><br>
                <strong>ADDRESS:</strong>No 66,Station Road,Battaramulla, Sri Lanka 10390<br><br>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6">
                <h2>Always Be In Touch With Us</h2>


                <form name="myform" method="POST" action="" onsubmit="return doValidate()">

                    <?php
                    if (isset($success_message)) {
                        foreach ($success_message as $success_message) {
                            echo '<div id="alertBox" class="alert alert-success d-flex align-items-center p-2 small" role="alert" style="font-size: 14px; max-width: 400px; margin: auto; margin-bottom:20px ">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                     <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM12.97 5.97a.75.75 0 0 0-1.06 0L7.75 10.06 5.53 7.84a.75.75 0 1 0-1.06 1.06l2.75 2.75a.75.75 0 0 0 1.06 0l3.75-3.75a.75.75 0 0 0 0-1.06z"/>
                     </svg>
                       <div>
                        ' . $success_message . '
                     </div>
                      </div>';

                        }
                    }
                    ?>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="row g-3">
                        <small id="emailError" class="error-text"> Please enter a valid email address.</small>

                    </div>
                    <div class="mb-3">
                        <label for="phone number" class="form-label">Phone Number</label>
                        <input type="phone number" class="form-control" id="phone number" name="phoneNumber" required>
                    </div>
                    <div class="row g-3">
                        <small id="telError" class="error-text">Invalid phone number. Please enter exactly 10
                            digits</small>
                    </div>


                    <div class="mb-3">
                        <label for="message" class="form-label">Comment or Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- nav-scroll frosted glass effect -->
    <script src="js/navbar-scroll.js"></script>

    <!-- Footer -->
    <div id="footer">
        <?php include("footer.php"); ?>
    </div>

</body>

</html>