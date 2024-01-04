<?php

session_start();

if (isset($_SESSION['student_email']) && basename($_SERVER['PHP_SELF']) != 'forgot_pass.php') {
    header("Location: new_page.php");
    exit();
}

require_once "config.php";

$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "login";

$conn = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $student_email = $_POST['Student_email'];

    $sql = "SELECT * FROM users WHERE student_email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $student_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // ... (previous code remains the same)

if ($result && mysqli_num_rows($result) > 0) {
    // Student found, set session variable and send email with OTP
    $row = mysqli_fetch_assoc($result);
    $_SESSION['student_email'] = $student_email;

    // Generate a random 6-digit OTP
    $otp = mt_rand(100000, 999999);

    // Update the 'code' column in the database with the generated OTP
    $update_sql = "UPDATE users SET code = ? WHERE student_email = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "is", $otp, $student_email);
    mysqli_stmt_execute($update_stmt);

    // Send email with OTP
    $to = $student_email;
    $subject = "Your OTP for Password Reset";
    $message = "Your OTP is: " . $otp; // You may format this message as needed

    // Set additional headers if required
    $headers = "From: asjaddawre2@gmail.com"; // Change this to your email address

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        // Email sent successfully
        header("Location: enter_otp.php"); // Redirect to a page to enter OTP
        exit();
    } else {
        // Failed to send email, handle the error or notify the user
        echo "Failed to send OTP. Please try again.";
    }
} else {
    // No user found, reset the form (reload the current page)
    header("Location: forgot_pass.php");
    session_destroy();
    exit();
}
}

?>







<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome Icons  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />

    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <title>Forgot Password UI </title>
    <style>
        * {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: #ff99f5;
    background-image:
        radial-gradient(at 61% 4%, hsla(303, 91%, 61%, 1) 0px, transparent 50%),
        radial-gradient(at 75% 66%, hsla(196, 91%, 79%, 1) 0px, transparent 50%),
        radial-gradient(at 98% 88%, hsla(76, 87%, 78%, 1) 0px, transparent 50%),
        radial-gradient(at 23% 16%, hsla(238, 96%, 77%, 1) 0px, transparent 50%),
        radial-gradient(at 95% 65%, hsla(13, 91%, 75%, 1) 0px, transparent 50%),
        radial-gradient(at 10% 79%, hsla(228, 96%, 69%, 1) 0px, transparent 50%),
        radial-gradient(at 85% 58%, hsla(328, 81%, 68%, 1) 0px, transparent 50%);
    background-repeat: no-repeat;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15rem 0;
}

.card {
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    background-color: rgba(0, 0, 0, 0.75);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.125);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 30px 40px;
}

.lock-icon {
    font-size: 3rem;
}

h2 {
    font-size: 1.5rem;
    margin-top: 10px;
    text-transform: uppercase;
}

p {
    font-size: 12px;
}

.passInput {
    margin-top: 15px;
    width: 80%;
    background: transparent;
    border: none;
    border-bottom: 2px solid deepskyblue;
    font-size: 15px;
    color: white;
    outline: none;
}

.btn {
    margin-top: 15px;
    width: 80%;
    background-color: deepskyblue;
    color: white;
    padding: 10px;
    text-transform: uppercase;
}
    </style>
</head>

<body>
    <form action="forgot_pass.php" method="post">
    <div class="card">
    <p class="lock-icon"><i class="fas fa-lock"></i></p>
        <h2>Forgot Password?</h2>
        <p>You can reset your Password here</p>
        <input type="text" name='Student_email' class="passInput" placeholder="Email address">
        <input type="submit" class="btn" value="Send Email">
   </div>
   </form>

</body>

</html>