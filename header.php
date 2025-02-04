<?php

include 'php/conf.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


$currentPage = basename($_SERVER['REQUEST_URI']);

?>


<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top">
  <div class="container d-flex align-items-center">
    <!--logo-->

    <a class="navbar-brand fs-4 ms-auto mt-n1" href="index.php">Offcanvas navbar</a>
    <!--toggle btn-->
    <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!--side bar-->
    <div class="offcanvas offcanvas-start w-100 sidebar" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <!--sidebar Header -->
      <div class="offcanvas-header text-white border-bottom">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <!--sidebar body-->
      <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0 w-100 mt-1">
        <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link <?php echo ($currentPage == 'aboutUs.php') ? 'active' : ''; ?>" href="aboutUs.php">About Us </a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link <?php echo ($currentPage == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link <?php echo ($currentPage == 'services.php') ? 'active' : ''; ?>" href="services.php">Services</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link <?php echo ($currentPage == 'offers.php') ? 'active' : ''; ?>" href="offers.php">Offers</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link <?php echo ($currentPage == 'branches.php') ? 'active' : ''; ?>" href="branches.php">Branches</a>
          </li>

          <div class="d-flex flex-column align-items-center">
          <?php
            if (isset($_SESSION['userId'])) {
              echo '<a href="appointment.php" class="text-white text-decoration-none px-4 py-2 bg-primary rounded-2 w-100 w-md-auto" style="background-color:blue;">Book Now</a>';
            }
            else{
              echo '<a href="login.php" class="text-white text-decoration-none px-4 py-2 bg-primary rounded-2" style="background-color:blue;">Book Now</a>';
            }
            ?>
        
          </div>
          <div class="d-flex align-items-center ms-auto">
            <?php
            if (isset($_SESSION['userId'])) {
            ?>
              <!-- Profile Dropdown -->
              <li class="nav-item dropdown ">

                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="images/user.png" alt="Profile" width="30" height="30" class="rounded-circle">
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>

                  <form id="dltform" action="delete_profile.php" method="POST" style="display: none;">
                  </form>

                  <li><a class="dropdown-item text-danger" href="javascript:void(0);" onclick="confirmDelete()">Delete Profile</a></li>
                  <script>
                    function confirmDelete() {
                      var confirmAction = confirm("Are you sure you want to delete your account?");
                      if (confirmAction) {

                        document.getElementById('dltform').submit();
                      }
                    }
                  </script>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                </ul>
              </li>
            <?php } else { ?>
              <!-- Login / Sign Up -->
              <div class="d-flex justify-content-center gap-2 mt-2">
                <a href="login.php" class="text-white">Login</a>
                <a href="register.php" class="text-white text-decoration-none px-2 py-2 rounded-2 bg-danger register-btn" style="background-color:red;">Register</a>
              </div>
            <?php } ?>
          </div>
      </div>
    </div>
  </div>
</nav>

<script>
  window.addEventListener('scroll', () => {
    navEl.classList.toggle('navbar-scrolled', window.scrollY >= 30);
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>