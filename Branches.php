<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KAE - Our Branches</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Social Media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style-aboutUs.css">
    <link rel="stylesheet" type="text/css" href="css/style-branch.css">
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
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
            <h1>Branches</h1>
            "Find our branches conveniently located in various areas. Visit us to experience our services firsthand and
            speak with our friendly staff."
        </div>
    </div>

    <div class="container">
        <!-- <h2 class="text-center mb-4">Our Branches</h2> -->
        <div class="row">

            <div class="col-md-6 ">
                <div class="branch-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>One Galle Face</h3>
                    <p>LK 1A, Central Road, Colombo 00200</p>
                    <p>📞 +94 716 880 880</p>
                    <p>✉ info@kavindaauto.lk</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="branch-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Gampola</h3>
                    <p>No.279, Kahatapitiya, Gampola</p>
                    <p>📞 +94 714 567 890</p>
                    <p>✉ gampola@kavindaauto.lk</p>
                </div>

            </div>

            <div class="col-md-6">
                <div class="branch-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Panadura</h3>
                    <p>No.04, Jayathilake Road, Panadura</p>
                    <p>📞 +94 716 330 640</p>
                    <p>✉ panadura@kavindaauto.lk</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="branch-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Kandy</h3>
                    <p>NO .55, Ranaviru Lane, Kandy</p>
                    <p>📞 +94 713 324 566</p>
                    <p>✉ kandy@Kavindaauto.lk</p>
                </div>
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