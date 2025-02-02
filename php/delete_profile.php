<?php

include 'conf.php';

session_start();
// $email = $_SESSION['txtemail'];
$user_email="shaini@gmail.com";


if(isset($_POST['btndlt'])){



    $sql="DELETE FROM customer WHERE email='$user_email'";
    $result=mysqli_query($con,$sql);
    $sql2="DELETE FROM user WHERE username='$user_email'";
    $result2=mysqli_query($con,$sql2);

    if ($result && $result2) {
        $message[] = 'Account deleted successfully.';
        
    } 


}
?>

<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function confirmDelete() {
                var cofirm= confirm("Are you sure you want to delete your account?");

                if(confirm){
                    document.getElementById('dltform').submit(); 
                }
            }
        </script>
                
            <script src="jquery-3.7.1.min.js"></script>
        


            <script>
            $(document).ready(function() {
                setTimeout(() => {
                $('#alertBox').each(function() {
                    bootstrap.Alert.getOrCreateInstance(this).close();
                });
                }, 3000);
            });
            </script>

    </head>
    <body>
        <form method="POST" id="dltform">
        <?php 
                if (isset($message) ) {
                foreach($message as $message){
                 echo '<div id="alertBox" class="alert alert-success d-flex align-items-center p-2 small" role="alert" style="font-size: 14px; max-width: 400px; margin: auto; margin-bottom:20px ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
                 <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM12.97 5.97a.75.75 0 0 0-1.06 0L7.75 10.06 5.53 7.84a.75.75 0 1 0-1.06 1.06l2.75 2.75a.75.75 0 0 0 1.06 0l3.75-3.75a.75.75 0 0 0 0-1.06z"/>
                 </svg>
                 <div>
                   '.$message.'
                 </div>
                 </div>';
                                        
                 }
                 }
                  ?>

        <input type="submit" id="btndlt" name="btndlt" value="Delete Account" onclick=confirmDelete()>
        </form>
    </body>
</html>