<?php

include 'php/conf.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['btnsubmit'])) {

    $email = $_POST['txtemail'];
    $pass = $_POST['txtpass'];

    $select = mysqli_query($con, "SELECT * FROM user WHERE username = '$email' AND password = '$pass' AND deleted_flag=FALSE") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['userId'] = $row["username"];

        $sql = "SELECT COUNT(*) AS count FROM vehicle INNER JOIN customer ON customer.customerId = vehicle.customerId  WHERE customer.email = '$email'";

        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] == 0) {
            header("Location: addVehicle.php"); 
            exit(); 
        }
                
        header('location:index.php');
    } else {
        $message[] = 'Incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KAE - Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom js Validation -->
    <script src="js/validate-login.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style-login.css">
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    <!-- Font Awesome for Social Media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>

<body>

    <!--header-->
    <div id="header"></div>
    <?php
    include("header.php");
    ?>


    <!--back arrow-->
    <!-- <a href="javascript:window.history.back()" class="back-arrow">
            &larr;
        </a> -->
    <div class="container">
    <div class="form mx-auto">
        <div class="top text-center mb-4">
            <header class="h3">Login</header>

        </div>

        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo '<div class="error-message">' . $message . '</div>';
            }
        }
        ?>
        <div id="alertBox1" class="alert alert-danger mt-2 d-none" role="alert">
            Please enter a valid email address.
        </div>
        <form name="myform" onsubmit="return doValidate()" method="POST" action="">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">

                        <input type="email" name="txtemail" class="form-control input-field" placeholder="Email"
                            required value="<?php echo isset($email) ? $email : ''; ?>">

                    </div>
                </div>
            </div>
            <div class="row g-3">
                <small id="emailError" class="error-text"> Please enter a valid email address.</small>

            </div>
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">
                        <input type="password" name="txtpass" class="form-control input-field" placeholder="Password"
                            required>
                    </div>
                </div>
            </div>
            <div class="row" style="color:grey; text-align:right;">
             <small ><a href="forgotpw.php" style="text-decoration:none;">Forgot Password?</a></small>
            </div>
            <!-- <div class="row g-3">
                <small id="passwordError" class="error-text">Password must have at least 8 characters, 1
                    uppercase, 1 lowercase, 1 number, and 1 special character.</small>

            </div> -->
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">

                        <input type="submit" class="btn btn-secondary w-50  d-block mx-auto submit" name="btnsubmit" value="Login">
                    </div>
                </div>
            </div>
            <div class="row g-3" style="color:grey; ">
                <center>Don't have an account? <a href="register.php" style="text-decoration:none">Register</a></center>
            </div>
        </form>
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