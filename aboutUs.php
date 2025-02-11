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
</head>

<body>
  <div class="hero-image">
    <div id="header"></div>
    <?php
    include("header.php");
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
  </div>

  <!-- nav-scroll frosted glass effect -->
  <script src="js/navbar-scroll.js"></script>

  <!-- Footer -->
  <div id="footer">
    <?php include("footer.php"); ?>
  </div>

</body>

</html>