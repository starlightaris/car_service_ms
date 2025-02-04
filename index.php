<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Kavinda Auto Engineering - Home</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome for Social Media icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style-index.css">
  <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
  <!-- Custom js -->
  <script src="js/carousel-index.js"></script>

</head>

<body>
  <!-- Header -->
  <div id="header">
    <?php include("header.php"); ?>
  </div>

  <!-- Full-screen Carousel -->
  <div id="myCarousel" class="carousel slide full-screen-carousel" data-bs-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
      <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
      <li data-bs-target="#myCarousel" data-bs-slide-to="3"></li>
    </ol>

    <!-- Slides -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/car-servicing-hero.jpg" class="d-block w-100" alt="Car Service">
        <div class="carousel-caption">
          <h3>Engine Repair</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolorae.</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="images/brake-hero.jpg" class="d-block w-100"  alt="Brake Pads Service">
        <div class="carousel-caption">
          <h3>Brake Service</h3>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="images/oil-change-hero.jpg" class="d-block w-100" alt="Oil Change Service">
        <div class="carousel-caption">
          <h3>Oil Changes</h3>
          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="images/wheel-alignment-hero.png" class="d-block w-100" alt="Wheel Alignment Service">
        <div class="carousel-caption">
          <h3>Wheel Alignment</h3>
          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
            laborum.</p>
        </div>
      </div>
    </div>
    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Why Choose Us -->
  <section class="why-choose-us py-5">
    <div class="container">
      <h2 class="text-center mb-5">Why Choose Us?</h2>
      <div class="row">
        <div class="col-md-4 text-center">
          <div class="card why-card shadow-sm">
            <div class="card-body">
              <i class="fas fa-certificate fa-3x mb-3 icon-hover"></i>
              <h4>Certified Technicians</h4>
              <p>Our team is highly trained and certified to handle all your car needs.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card why-card shadow-sm">
            <div class="card-body">
              <i class="fas fa-clock fa-3x mb-3 icon-hover"></i>
              <h4>Quick Service</h4>
              <p>We value your time and ensure fast, efficient service.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card why-card shadow-sm">
            <div class="card-body">
              <i class="fas fa-dollar-sign fa-3x mb-3 icon-hover"></i>
              <h4>Affordable Prices</h4>
              <p>Quality service at competitive prices.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- What We Offer -->
  <section class="featured-services py-5">
    <div class="container">
      <h2 class="text-center mb-5">What We Offer</h2>
      <div class="row">
        <div class="col-md-4 text-center">
          <div class="card service-card shadow-sm">
            <div class="card-body">
              <i class="fas fa-car fa-3x mb-3"></i>
              <h4>Engine Repairs</h4>
              <p>Expert engine diagnostics and repairs to keep your vehicle running smoothly.</p>
              <a href="services.php" class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card service-card shadow-sm">
            <div class="card-body">
              <i class="fas fa-tools fa-3x mb-3"></i>
              <h4>Brake Servicing</h4>
              <p>Ensure your safety with our professional brake inspection and servicing.</p>
              <a href="services.php" class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card service-card shadow-sm">
            <div class="card-body">
              <i class="fas fa-oil-can fa-3x mb-3"></i>
              <h4>Oil Changes</h4>
              <p>Regular oil changes to keep your engine in top condition.</p>
              <a href="services.php" class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Testimonials -->
  <section class="testimonials py-5" style="background-color: #f8f9fa;">
    <div class="container">
      <h2 class="text-center mb-5">What Our Customers Say</h2>
      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="card testimonial-card mx-auto">
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <p>"Great service! My car runs like new after their engine repair."</p>
                  <footer class="blockquote-footer">John Doe</footer>
                </blockquote>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="card testimonial-card mx-auto">
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <p>"Friendly staff and quick turnaround. Highly recommended!"</p>
                  <footer class="blockquote-footer">Jane Smith</footer>
                </blockquote>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="card testimonial-card mx-auto">
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <p>"Affordable prices and excellent service. Will definitely return."</p>
                  <footer class="blockquote-footer">Mike Johnson</footer>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-section text-center py-5" style="background-color: #f8f9fa;">
    <div class="container">
      <h2>Ready to Get Started?</h2>
      <p>Book an appointment today and experience top-notch car service.</p>
      <a href="appointment.php" class="btn btn-primary btn-lg cta-button">Book Now</a>
    </div>
  </section>

  <!-- Get in touch -->
  <section class="contact-info py-5" style="background-color: #343a40; color: #fff;">
    <div class="container text-center">
      <h2>Get in Touch</h2>
      <p>We're here to assist you with all your car service needs.</p>
      <a href="contact.php" class="btn btn-light contact-button">Contact Us</a>
    </div>
  </section>


  <!-- Blog -->
  <section class="blog-section py-5">
    <div class="container">
      <h2 class="text-center mb-5">Car Care Tips</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card blog-card shadow-sm">
            <img src="images/car-maintenance-tips.jpg" class="card-img-top" alt="Car Maintenance Tips">
            <div class="card-body">
              <h5 class="card-title">5 Tips for Maintaining Your Car</h5>
              <p class="card-text">Learn how to keep your car in top condition with these simple tips.</p>
              <a href="#" class="btn btn-outline-primary">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card blog-card shadow-sm">
            <img src="images/winter-car-care.jpg" class="card-img-top" alt="Winter Car Care">
            <div class="card-body">
              <h5 class="card-title">Preparing Your Car for Winter</h5>
              <p class="card-text">Get your car ready for the cold season with these essential tips.</p>
              <a href="#" class="btn btn-outline-primary">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card blog-card shadow-sm">
            <img src="images/fuel-efficiency.jpg" class="card-img-top" alt="Fuel Efficiency">
            <div class="card-body">
              <h5 class="card-title">How to Improve Fuel Efficiency</h5>
              <p class="card-text">Save money on fuel with these easy-to-follow tips.</p>
              <a href="#" class="btn btn-outline-primary">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- nav-scroll frosted glass effect -->
  <script src="js/navbar-scroll.js"></script>
  <!-- Footer -->
  <div id="footer">
    <?php include("footer.php"); ?>
  </div>

</body>

</html>