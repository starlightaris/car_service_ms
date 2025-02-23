<?php
    // Connect to database
    include  'php/conf.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    
     $user_email = $_SESSION['userId'];
     $sql1="SELECT customerId FROM customer WHERE email='$user_email'";
     $result1=mysqli_query($con,$sql1);
 
     if ($result1 && mysqli_num_rows($result1) > 0) {
         $row = mysqli_fetch_assoc($result1);
         $customerId = $row['customerId'];

        if(isset($_POST['submit'])){
         $feedback=$_POST['txtfeedback'];

        $sql="INSERT INTO feedback (customerId,feedbackDescription) VALUES ('$customerId','$feedback')";
        $result=mysqli_query($con,$sql);
        if ($result == true) {
          $success_message[] = 'Thank you for your feedback!';
      }

        }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>KAE - About Us</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <!-- Font Awesome for Social Media icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/style-offer.css">
  <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
  <link rel="stylesheet" type="text/css" href="css/style-aboutUs.css">
  <!-- Custom Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
      <!-- jQuery -->
      <script src="js/jquery-3.7.1.min.js"></script>
  <!--validations-->
  <script src="js/validate-feedback.js"></script>
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
    


    <div class="hero-text">
      <h1>About Us</h1>
      "To be the most trusted and customer-centric car service provider, delivering exceptional vehicle care with
      innovation, reliability, and integrity, ensuring every ride is safe and smooth."
    </div>
  </div>

  <div class="container">

    <h2 class="title">Why Choose Us?</h2>

    <div class="grid">
      <div class="grid-item">
        <i class="bi bi-tools"></i>
        <h3>Experienced Technicians</h3>
        Our experts bring years of experience to every service.
      </div>

      <div class="grid-item">
        <i class="bi bi-gear-wide-connected"></i>
        <h3>Comprehensive Services</h3>
        From routine maintenance to complex repairs, we've got you covered.
      </div>

      <div class="grid-item">
        <i class="bi bi-hand-thumbs-up-fill"></i>
        <h3>Customer-Centric Approach</h3>
        Your satisfaction is our priority.
      </div>

      <div class="grid-item">
        <i class="bi bi-cash-coin"></i>
        <h3>Affordable & Transparent Pricing</h3>
        No hidden costs, just honest service.
      </div>
    </div>
    <?php
            if (isset($_SESSION['userId'])) {
              ?>
     <!-- Feedback Icon -->
     <div class="feedback-icon" onclick="openFeedbackForm()">
        <img src="images/feedback-icon.png" alt="Feedback">
    </div>

    <!-- Feedback Form -->
    <div class="feedback-form" id="feedbackForm" >
      <form method="POST">
        <span class="close-btn" onclick="closeFeedbackForm()">✖</span>
        <h3>Give Us Your Feedback</h3>
        <textarea id="feedbackText"name="txtfeedback" placeholder="Write your feedback here..."></textarea>
        <!-- <button onclick="submitFeedback()" name="submit">Submit</button> -->
        <button type="submit" name="submit" >Submit</button>

            </form>
    </div>
            <?php } ?>

  </div>

  <!-- nav-scroll frosted glass effect -->
  <script src="js/navbar-scroll.js"></script>


  <!-- Footer -->
  <div id="footer">
    <?php include("footer.php"); ?>
  </div>

</body>

</html>