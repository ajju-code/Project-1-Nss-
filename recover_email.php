<?php 
include 'config.php';
if(isset($_POST['submit'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $emailquery="SELECT * FROM users WHERE student_email='$email'";
    $query=mysqli_num_rows($conn,$emailquery);

    $emailcount=mysqli_num_rows($query);

    if($emailcount){
        $user_data=mysqli_fetch_array($query);
        $username=$user_data['username'];
        $token=$user_data['token'];

        $subject="Password reset";
        $body="Hi, $username. Click here to reset your password http://localhost/lemailverifregister/reset_password.php?token=$token"
        $sender_email="From:dawreasjad72@gmail.com";

        if(mail($email,$subject,$body,$sender_email)){
            $_SESSION['msg']="Check your  mail to reset your password $email";
            header('location:login.php');
        }
        else{
            echo "failed to send mail";
        }

    }
    else{
        echo "no email found! SignUp";
        header('login.php');
    }
}



?>



<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap 5 Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container d-flex flex-column">
      <div class="row align-items-center justify-content-center
          min-vh-100">
        <div class="col-12 col-md-8 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h5>Forgot Password?</h5>
                <p class="mb-2">Enter your registered email ID to reset the password
                </p>
              </div>
              <form>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email"
                    required="">
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" class="btn btn-primary">
                    Reset Password
                  </button>
                </div>
                <span>Don't have an account? <a href="sign-in.html">sign in</a></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>