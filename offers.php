<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>KAE - Offers</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome for social media icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/style-offer.css">
  <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
</head>

<body>
  <div class="hero-image">
    <div id="header"></div>
    <?php
    include("header.php");
    ?>


    <div class="hero-text">
      <h1>Offers</h1>
    </div>
  </div>
  <div class="container">

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card  h-100">
          <img src="images/offer1_old.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">First-Time Customer Discounts</h5>
            <p class="card-text">10% off your first service with us</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card  h-100">
          <img src="images/offer2.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"> Bulk Service Discounts</h5>
            <p class="card-text">Save 15% when you book 2 services at the same time.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card  h-100">
          <img src="images/xmas.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Christmas Special Offer</h5>
            <p class="card-text">
              Get 25% OFF on your total bill throughout the whole month of December

            </p>
          </div>
        </div>
      </div>

      <div class="col"> </div>

      <div class="col">
        <div class="card  h-100 ">
          <img src="images/Tuesday+offers.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Tuesday Service Special</h5>
            <p class="card-text">Get 15% OFF on ALL Services every Tuesday.</p>
          </div>
        </div>
      </div>

      <div class="col"></div>
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