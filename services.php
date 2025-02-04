<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
    <link rel="stylesheet" type="text/css" href="css/style-service.css">
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">

    <!-- Font Awesome for Social Media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <div class="hero-image">
        <div id="header">
            <?php include("header.php"); ?>
        </div>
        <div class="hero-text">
            <h1>Services</h1>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card  h-100">
                    <img src="images/full_service.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Full Service</h5>
                        <p class="card-text">
                            Detailed Wash<br>
                            Lubrication<br>
                            Engine Degreasing<br>
                            Exterior Waxing<br>
                            Battery Testing
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="images/under_carriage.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Under Carriage Service</h5>
                        <p class="card-text">Full under carriage maintenance without tire removal</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/oil_filter.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Oil and Filter Change</h5>
                        <p class="card-text">Full oil change and filter replacement</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/exterior.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Exterior Cleaning</h5>
                        <p class="card-text">
                            Vehicle body wash<br>
                            Cut/Polish and Wax
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100 ">
                    <img src="images/interior.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Interior Cleaning</h5>
                        <p class="card-text">
                            Seat vacuum cleaning<br>
                            Floor and dashboard cleaning<br>
                            Leather care
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/total_treatment.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Total Treatment</h5>
                        <p class="card-text">Complete vehicle interior + exterior cleaning</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/radiator.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Radiator Coolant Change</h5>
                        <p class="card-text">Full radiator coolant change</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/brake_cleaning.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Brake Cleaner</h5>
                        <p class="card-text">Full cleaning and tuning of brakes</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/brake-fluid.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Brake Fluid Change</h5>
                        <p class="card-text">Full brake fluid change</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/headlight.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Head Light Cleaning</h5>
                        <p class="card-text">Full cleaning and polishing of vehicle headlights</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/tire_alignment.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tire Alignment</h5>
                        <p class="card-text">
                            Toe alignement<br>
                            Caster alignment
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card  h-100">
                    <img src="images/hybrid_vehicle.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Hybrid Vehicle Services</h5>
                        <p class="card-text">
                            High voltage system scanning and diagnostics<br>
                            Fluid replacement<br>
                            Wire and cable check<br>
                            Battery power and energy testing
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div id="footer">
        <?php include("footer.php"); ?>
    </div>
</body>

</html>