<?php

include 'php/conf.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['txtemail']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['txtpass']));

    $select = mysqli_query($conn, "SELECT * FROM user WHERE username = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['userId'] = $row[1];
        header('location: home.php');
    } else {
        $message[] = 'Incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/validate-login.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style-login.css">
</head>

<body>
    <div class="container">
        <div class="form mx-auto">
            <div class="top text-center mb-4">
                <header class="h3">Login</header>
            </div>
            <div id="alertBox1" class="alert alert-danger mt-2 d-none" role="alert">
                Please enter a valid email address.
            </div>
            <form name="myform" onsubmit="return doValidate()" method="POST" action="">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="email" name="txtemail" class="form-control input-field" placeholder="Email"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <small id="emailError" class="error-text"> Please enter a valid email address.</small>
                    <?php
                    if (isset($error_message)) {
                        foreach ($error_message as $error_message) {
                            echo '<div class="error-message">' . $error_message . '</div>';
                        }
                    }
                    ?>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="password" name="txtpass" class="form-control input-field"
                                placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <small id="passwordError" class="error-text">Password must have at least 8 characters, 1 uppercase, 1 lowercase, 1 number, and 1 special character.</small>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary w-100 submit" name="btnsubmit" value="Login">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>