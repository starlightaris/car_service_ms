<?php
include 'php/conf.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$user_email = $_SESSION['userId'];

//$user_email="binithi.vihanga@gmail.com";

$sql = "SELECT firstName,lastName,email,phone FROM customer INNER JOIN user ON customer.userId=user.userId WHERE username='$user_email'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row["firstName"];
        $lname = $row["lastName"];
        $email = $row["email"];
        $phone = $row["phone"];
    }
}

if (isset($_POST['btnupdate'])) {
    $update_fname = $_POST['txtfname'];
    $update_lname = $_POST['txtlname'];
    $email = $_POST['txtemail'];
    $update_phone = $_POST['txttel'];

    $sql2 = "UPDATE customer set firstName='$update_fname',lastName='$update_lname',phone='$update_phone' WHERE email='$email'";
    $result2 = mysqli_query($con, $sql2);

    if ($result2 == true) {
        $message[] = 'Profile updated successfully';

        //refetchng the updated data

        $sql = "SELECT firstName,lastName,email,phone FROM customer INNER JOIN user ON customer.userId=user.userId WHERE username='$user_email'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $fname = $row["firstName"];
                $lname = $row["lastName"];
                $email = $row["email"];
                $phone = $row["phone"];
            }
        }



    }
}

if (isset($_POST['btncancel'])) {

    $sql = "SELECT firstName,lastName,email,phone FROM customer INNER JOIN user ON customer.userId=user.userId WHERE username='$user_email'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $fname = $row["firstName"];
            $lname = $row["lastName"];
            $email = $row["email"];
            $phone = $row["phone"];
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KAE - My Profie</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery  -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- Font Awesome for Social Media icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style-profile.css">
    <link rel="stylesheet" type="text/css" href="css/style-offer.css">
    <link rel="stylesheet" type="text/css" href="css/style-header-footer.css">
    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!--timer for profile update success meassage-->
    <script>
        $(document).ready(function () {
            setTimeout(() => {
                $("#alertBox").fadeOut("slow", function () {
                    $(this).remove();
                });
            }, 2000);
        });

    </script>

    <!--phone numberr validation-->
    <script>
        function telValidate() {

            //phone numberr validation
            var tel = document.forms["myform"]["txttel"].value;
            var regex = /^[0-9]{10}$/;
            var telError = document.getElementById("telError");

            if (!regex.test(tel)) {
                telError.style.display = "block";
                return false;
            }
            else {
                telError.style.display = "none";
            }
            return true;
        }
    </script>

</head>

<body class="profile-page">
    <!-- Header -->
    <div id="header"></div>
    <?php
    include("header.php");
    ?>

    <div class="page-header header-filter"></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto text-center">
                        <div class="profile">
                            <div class="avatar">
                                <img src="images/user.png" alt="User Image"
                                    class="img-raised rounded-circle image-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title">Hi <?php echo isset($fname) ? $fname : ''; ?> !</h3>
                            </div>
                        </div>

                        <div class="form-box">
                            <form name="myform" id="myform" onsubmit="return telValidate()" method="POST" action="">
                            <!--update successfull message-->
                                <?php
                                if (isset($message)) {
                                    foreach ($message as $message) {
                                        echo '<div id="alertBox" class="alert alert-success d-flex align-items-center p-2 small" role="alert" style="font-size: 14px; max-width: 400px; margin: auto; margin-bottom:20px ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                                                <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM12.97 5.97a.75.75 0 0 0-1.06 0L7.75 10.06 5.53 7.84a.75.75 0 1 0-1.06 1.06l2.75 2.75a.75.75 0 0 0 1.06 0l3.75-3.75a.75.75 0 0 0 0-1.06z"/>
                                            </svg>
                                            <div>
                                               ' . $message . '
                                            </div>
                                        </div>';

                                    }
                                }
                                ?>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="txtfname" id="fname" class="form-control input-field"
                                                value="<?php echo isset($fname) ? $fname : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="txtlname" id="lname" class="form-control input-field"
                                                value="<?php echo isset($lname) ? $lname : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="txtemail" id="email" class="form-control input-field"
                                                value="<?php echo isset($email) ? $email : ''; ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="tel" name="txttel" id="phone" class="form-control input-field"
                                                value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                                        </div>
                                        <div class="row g-3">
                                            <small id="telError" class="error-text">Invalid phone number. Please enter
                                                exactly 10 digits</small>
                                        </div>

                                    </div>
                                </div>

                                <!-- Button Row -->
                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-center gap-3">
                                        <input type="submit" class="btn btn-primary submit px-4" id="btnupdate"
                                            id="btnupdate" name="btnupdate" value="Update Profile" disabled>
                                        <input type="reset" class="btn btn-outline-secondary submit px-4"
                                            name="btncancel" value="Cancel">
                                    </div>
                                </div>
                            
                            <!--enabling update btn whn input field is chnged-->
                            <script>
                            const inputs = document.querySelectorAll(".input-field");
                            const updateBtn = document.getElementById("btnupdate");
                            const form = document.getElementById("myForm");

                                            
                            inputs.forEach((input) => {
                            input.addEventListener("input", () => {
                                updateBtn.disabled = false; 
                            });
                        });

                                            
                            form.addEventListener("reset", () => {
                                updateBtn.disabled = true;
                            });
                             </script>
                            </form>
                        </div>
                    </div>
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