<!-- Footer -->
<footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-between p-4" style="background-color:rgba(255, 0, 0, 0.67)">
    <!-- Left -->
    <div class="me-5">
      <span>Get connected with us on social networks:</span>
    </div>

    <!-- Right -->
    <div>
      <a href="https://www.facebook.com" class="text-white me-3 me-md-4" target="_blank">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://www.twitter.com" class="text-white me-3 me-md-4" target="_blank">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="https://www.google.com" class="text-white me-3 me-md-4" target="_blank">
        <i class="fab fa-google"></i>
      </a>
      <a href="https://www.instagram.com" class="text-white me-3 me-md-4" target="_blank">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://www.linkedin.com" class="text-white me-3 me-md-4" target="_blank">
        <i class="fab fa-linkedin"></i>
      </a>
    </div>
  </section>

  <!-- Section: Links  -->
  <section class="pt-4">
    <div class="container text-center text-md-start">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column 1 -->
        <div class="col-md-6 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold">Kavinda Auto Engineering</h6>
          <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
          <label class="text-white">
            Your trusted partner for car repairs and maintenance. We specialize in engine repairs, brake servicing,
            and more. Drive safely with us!
</label>
        </div>

        <!-- Grid column 2 -->
        <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold">Our Services</h6>
          <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" /><br>
          <label>
            <a href="services.php" class="text-white">Engine Repairs</a>
          </label><br>
          <label>
            <a href="services.php" class="text-white">Brake Servicing</a>
          </label><br>
          <label>
            <a href="services.php" class="text-white">Oil Changes</a>
          </label><br>
          <label>
            <a href="services.php" class="text-white">Car Diagnostics</a>
          </label>
        </div>

        <!-- Grid column 3 -->
        <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold">Useful Links</h6>
          <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" /><br>
          <label>
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['userId'])) {
              echo '<a href="appointment.php" class="text-white">Book an Appointment</a>';
            } else {
              echo '<a href="login.php" class="text-white">Book an Appointment</a>';
            }
            ?>
          </label><br>
          <label>
            <a href="services.php" class="text-white">Service Packages</a>
          </label><br>
          <label>
            <a href="Branches.php" class="text-white">Branches</a>
          </label><br>
          <label>
            <a href="contact.php" class="text-white">Customer Reviews</a>
          </label>
        </div>

        <!-- Grid column 4-->
        <div class="col-md-6 col-lg-4 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold">Contact</h6>
          <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" /><br>
          <label><i class="fas fa-home mr-3"></i> Battaramulla, Sri Lanka</label><br>
          <label><i class="fas fa-envelope mr-3"></i> <a href="mailto:info@kavindaauto.com" class="text-white">info@kavindaauto.com</a></label><br>
          <label><i class="fas fa-phone mr-3"></i> <a href="tel:+94112345678" class="text-white">+94 112 345 678</a></label><br>
          <label><i class="fas fa-print mr-3"></i> <a href="tel:+94112345679" class="text-white">+94 112 345 679</a></label>
        </div>
      </div>
    </div>
  </section>

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2023 Copyright:
    <a class="text-white" href="#">Kavinda Auto Engineering</a>
  </div>
</footer>
