<?php
session_start();
require_once('config.php'); 
require('fpdf/fpdf.php');


$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login';


$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// Access the username
$student = $_SESSION['username'];
    // print $student ;




    if(isset($_SESSION['news'])) {
        $news = $_SESSION['news'];
    } else {
        $sql = "SELECT news FROM content_text";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $news = isset($row["news"]) ? $row["news"] : "";
        }
    }
    
    if(isset($_SESSION['notification'])) {
        $notification = $_SESSION['notification'];
    } else {
        $sql = "SELECT notification FROM content_text";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $notification = isset($row["notification"]) ? $row["notification"] : "";
        }
    }
   
 
    $sql = "SELECT * FROM users WHERE student_email = '$student'"; // Modify this query to suit your needs
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    
  
   
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
          <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <title>Nss login system!</title>
    <style>
                body {
    margin: 0;
    padding: 0;

}
        /* Define the default styles for .navbar and .box1 */
        .navbar {
            width: 100%; /* Adjust this width as needed */
        }

        .box1 {
            margin-top: 15px;
            width: 100%; 
            position: sticky;
            left: 0;
        }

        /* Media query for smaller screens */
        @media screen and (min-width: 320px) and (max-width: 425px) {
   .box1{
     width:75%;
   }
   .logo{
     margin-top:-24vh;
   }
}

@media screen and (max-width: 765px) {
    .box1 {
        width: 200px; 
        font-size:13px;
    }
    .logo{
      margin-top:-9vh;

    }
}



        @media screen and (max-width: 767px) {
            .navbar, .box1 {
                width: 100%; /* Adjust the width for smaller screens */
            }
        }






        .header {
            display: flex;
            align-items: center;
            flex-wrap: wrap; 
        }

        .logo {
            width: 50px; /* Adjust the size of the logo as needed */
            height: auto;
            margin-right: 10px;
            margin-top:-1vh;
         
        }

        .subtitle {
    display: block; /* Ensure the subtitle is on a new line */
    text-align: center; /* Center the text */
    font-size: smaller; /* Adjust the font size as needed */
    margin-top: 5px; /* Add space between the sentences */
    color: #777; /* Adjust the color as needed */
}

        .box-text {
            margin-top: 5px;
            text-align: center;
        }
        .box2{
            height:100vh;
            width:100%;
            display:flex;
            justify-content:center;
            
        }


.scrolling-text {
    width: 100%;
    height: 50px; /* Set the height of the scrolling area */
    overflow: hidden; /* Hide overflowing content */
    position: relative;
    background-color: #f0f0f0;
    margin-top:80px;
}

.scrolling-text p {
    white-space: nowrap; /* Prevent text from wrapping */
    position: absolute;
    padding:12px 5px 4px;
    animation: scrolling 11s linear infinite; 
    right:0;
    transform: translateX(100%); 
}

@keyframes scrolling {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-350%);
    }
}
.hidden-content {
            display: none;
        }
        .close-button {
            top: 10px;
            right: 10px;
            color: red;
            cursor: pointer;
        }
      .close-button{
        color:red;
      }

      .input-btn:hover{
        color:white;
        font-family: Serif;
        background-color:green;
      }
      .close-button:hover{
          background-color:red;
          color:white;

      }

/* Basic styling for the card */
.card {
    border: 2px solid #003355;
    border-radius: 10px;
    padding: 20px;
    margin: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    background-color: #f9f9f9;
    width: 400px; /* Fixed width */
    height: 400px; /* Fixed height */
    /* overflow: auto; Allow scrollbars when content overflows */
}

/* Styling for the card header */
.card-header1 {
    background-color: #003355;
    padding: 15px;
    border-radius: 8px 8px 0 0;
    color: #fff;
    text-align: center;
}

/* Styling for the news text */
.card-body p {
    margin: 0;
    font-size: 18px;
    line-height: 1.6;
    color: #333;
    overflow: auto;
    max-height: 100%; /* Allow text to expand within the container */
    word-wrap: break-word; /* Wrap long words */
}

.parent_card {
    display: flex;
    justify-content: space-between; /* Aligns items with space between */
    gap: 150px; /* Sets the gap between items */
}

#news_inp {
    border: 2.5px solid #003355;
    width: 600px;
    padding: 10px; /* Reduce padding */
    border-radius: 18px;
    margin-left: 50px;
}
#news_inp h2 {
    margin-left: 0; /* Reset margin-left */
    margin-top: 0; /* Reset margin-top */
    padding-left: 65px; /* Adjust padding to position text */
}

#notification_inp {
    border: 2.5px solid #003355;
    width: 600px;
    padding: 10px; /* Reduce padding */
    border-radius: 18px;
    margin-left: 50px;
}
.table_data{
    height: auto;
    width: auto;
    margin-left: 100px;
    margin-top: 10vh;
}

table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #003355; /* Adding border to the table */
        }

        th, td {
            border: 1px solid #003355; /* Adding borders to table cells */
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #003355; /* Setting background color for table heading */
            color: white;
        }

        input[type="submit"] {
            background-color:#0256bd ; /* Setting button color */
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            margin-left: 15vh;

            border-radius: 12px;

        }
        .Buttons{
            margin:20px 5px 5px;
        }

        .pdf-link {
            display: inline-block;
            padding: 8px 12px;
            background-color: #003355;
            border-radius: 14px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            margin-left:8px;
            width:auto;
            height:auto;
        }

        .pdf-link:hover {
            background-color: #005d91;
            color:white;
            text-decoration: none;

        }
        #heading{
            font-family:emoji,serif;
            width:auto;
            height:auto;
            background-color: #003355;
            text-align: center;
         color: white;
         border-radius: 10px;
        }
        label{
            margin-top: 35px;
    padding: 5px 6px;
    background-color: #003355;
    color: white;
    width: auto;
    margin-left: 15px;
    border-radius: 5px;
    height: auto;
        }
select{
    color: white;
    background-color: #054773;
}
      .sub-menue-wrap{
          position: absolute;
          top:100%;
          right:10%;
          width:320px;
      }
      .sub-menue{
          background: #fff;
          padding:20px;
          margin:10px;
      }
      /* CSS Styles for the animated window */
.animated-window {
    display: none;
    position: absolute;
    top: 60px; /* Adjust this value to position the window */
    right: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.animated-window a {
    display: block;
    padding: 6px 9px;
    text-decoration: none;
    color: #333;
    transition: background-color 0.3s ease;
}

.animated-window a:hover  {
    background-color: #003355db;
    color:white;
}

.animated-window a:hover img {
    filter: brightness(30);
}


    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#042d41; color:white;">
    <a class="navbar-brand" href="#">Nss Login System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <!-- <a class="nav-link" href="#" ></a> -->
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="Logout.php" >Logout</a>
            </li>
        </ul>
        <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <img src="https://img.icons8.com/metro/26/000000/guest-male.png" id="menuIcon">
            <?php echo "Welcome"." ".$row['username'] ?>
        </a>
        <div class="animated-window" id="menuOptions">
            <a href="edit_profile_page.php">
                <img src="setting.png" style="width:20px;height:auto;" alt="Edit Profile"> Edit Profile
            </a>
            <a href="edit_profile_page.html">
                <img src="support.png" style="width:20px;height:auto;" alt="Help Support"> Help &  Support
            </a>
            <a href="Logout.php">
                <img src="logout.png" style="width:20px;height:auto;" alt="Logout"> Logout
            </a>
        </div>
    </li>
</ul>

</div>

    </div>
</nav>

<div class="box1 col-sm-8">
    <div class="header">
        <img src="gmvit_logo-removebg-preview.png" alt="Logo" class="logo">
        <div>
            <h6>Sant Gajanant Maharaj Vedak Institute of Technology (GMVIT)
                <span class="subtitle">Admissions A.Y. 2023-24 Tala Nss Dashboard</span>
            </h6>
            <div class="box-text">
                Undergraduate Programs in Engineering and Technology (4 Years)
            </div>
        </div>
    </div>
</div>


</form>


<form id="textInputForm" method="post" action="">

<div class="scrolling-txt" id="scrollingText">
    <div class="scrolling-text">
        <?php
        // Establish database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve scrolling text from the database
        $sql = "SELECT scrolling_text FROM content_text";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data
            while ($row = $result->fetch_assoc()) {
                echo '<p>' . $row["scrolling_text"] . '</p>';
            }
        } else {
            // If no data found, display default text
            echo '<p>Error Loating the Scrolling Text .</p>';
        }

        $conn->close();
        ?>
    </div>
</div>


    </div>
    <div class="parent_card">

    <div class="card homepage aos-init aos-animate"   data-aos="fade-down" data-aos-easing="linear" data-aos-duration="2000">
        <div class="card-header1">
            <span id="rightContainer_ContentTable2_lblPanel2" class="news"><img src="news.gif" alt="" style="height:auto; width:45px; filter:invert(100%) brightness(200%); ">  News</span>
        </div>
        <div class="card-body">
            <marquee id="rightContainer_ContentTable2_panel2" align="justify" direction="up" onmouseout="this.start()" height="230px" onmouseover="this.stop()" scrollamount="2" scrolldelay="60">
                <p align="justify"><?php echo $news; ?>
                </p>
            </marquee>
        </div>
    </div>



    <div class="card homepage aos-init aos-animate"  data-aos="fade-down" data-aos-easing="linear" data-aos-duration="2000">
        <div class="card-header1">
            <span id="rightContainer_ContentTable2_lblPanel2" class="news"><img src="notification-bell.gif" alt="" style="height:auto; width:30px;filter:brightness(100%); ">  Notifications</span>
        </div>
        <div class="card-body">
            <marquee id="rightContainer_ContentTable2_panel2" align="justify" direction="up" onmouseout="this.start()" height="230px" onmouseover="this.stop()" scrollamount="2" scrolldelay="60">
                <p align="justify"><?php echo $notification; ?>
                </p>
            </marquee>
        </div>
    </div>
</div>



    </div>
 
</form>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <script>       

document.addEventListener('DOMContentLoaded', function () {
    const menuIcon = document.getElementById('menuIcon');
    const menuOptions = document.getElementById('menuOptions');

    menuIcon.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevent the click from propagating to document
        menuOptions.style.display = (menuOptions.style.display === 'block') ? 'none' : 'block';
    });

    // Close the menu when clicking outside the menu
    document.addEventListener('click', function (e) {
        if (!menuOptions.contains(e.target) && e.target !== menuIcon) {
            menuOptions.style.display = 'none';
        }
    });
});


    </script>
</body>
</html>