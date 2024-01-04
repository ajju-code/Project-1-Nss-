<!DOCTYPE html>
<html>
<head>
    <title>Residence Student Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        label {
            font-weight: bold;
        }
        select, input[type="number"] {
            margin: 5px 0;
            padding: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div>
    <h1 style="display: inline;">Name Report</h1>
    <form action="Logout.php" method="get" style="display: inline; margin-left: 155vh;"> 
        <input type="submit" value="Logout" style="background-color: red;"id=logout >
    </form>
</div>

  
                

    <form method="post">
        <label for="username">Enter Name:</label>
        <input type="text" name="username" id="username">
        <input type="submit" value="Filter by Name">
    </form>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>department</th> 
            <th>Year</th>
            <th>Age</th>
            <th>Category</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once('config.php'); // Include your database configuration

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
            $selectedName = $_POST["username"];
         
            $sql = "SELECT id, username, gender, address,department,year ,dob, category, contact FROM users WHERE username = '$selectedName'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['contact'] . "</td>";
                    echo "<td><form method='post'>
                        <input type='hidden' name='delete_name' value='" . $row['username'] . "'>
                        <input type='submit' name='delete_submit' value='Delete' style='background-color: red; color: white;'>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["delete_submit"])) {
                $deleteName = mysqli_real_escape_string($conn, $_POST["delete_name"]);
        
                // Query to delete the record based on the provided name
                $deleteSql = "DELETE FROM users WHERE username = '$deleteName'";
                $deleteResult = mysqli_query($conn, $deleteSql);
        
                if ($deleteResult) {
                    echo "Record with name '$deleteName' has been deleted.";
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            }
        }
        
        ?>
    </tbody>
</table>




























    <h1>Category Student Report</h1>

    <form method="post">
        <label for="category">Select Category:</label>
        <select name="category" id="category">
        <option value="" disabled selected>Select Category</option>

            <option value="Open">Open</option>
            <option value="Scheduled Castes (SC)">Scheduled Castes (SC)</option>
            <option value="Scheduled Tribe (ST)">Scheduled Tribe (ST)</option>
            <option value="Vimukta Jati (VJ) / De-Notified Tribes (DT) (NT-A)">Vimukta Jati (VJ) / De-Notified Tribes (DT) (NT-A)</option>
            <option value="Nomadic Tribes 1 (NT-B)">Nomadic Tribes 1 (NT-B)</option>
            <option value="Nomadic Tribes 2 (NT-C)">Nomadic Tribes 2 (NT-C)</option>
            <option value="Nomadic Tribes 3 (NT-D)">Nomadic Tribes 3 (NT-D)</option>
            <option value="Other Backward Classes (OBC)">Other Backward Classes (OBC)</option>
            <option value="Socially and Educationally Backward Classes (SEBC)">Socially and Educationally Backward Classes (SEBC)</option>
        </select>
        <input type="submit" value="Filter">
    </form>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Department</th> 
            <th>Year</th>
            <th>Age</th>
            <th>Category</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once('config.php'); // Include your database configuration

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["category"])) {
            $selectedCategory = $_POST["category"];
            // Query the database for students in Mumbai with the selected category
            $sql = "SELECT id, username, gender, address,department,year, dob, category, contact FROM users WHERE category = '$selectedCategory'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                 
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['contact'] . "</td>";
                    echo "<td><form method='post'>
                        <input type='hidden' name='delete_name' value='" . $row['username'] . "'>
                        <input type='submit' name='delete_submit' value='Delete' style='background-color: red; color: white;'>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["delete_submit"])) {
                $deleteName = mysqli_real_escape_string($conn, $_POST["delete_name"]);
        
                // Query to delete the record based on the provided name
                $deleteSql = "DELETE FROM users WHERE username = '$deleteName'";
                $deleteResult = mysqli_query($conn, $deleteSql);
        
                if ($deleteResult) {
                    echo "Record with name '$deleteName' has been deleted.";
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            }
        }
        
        ?>
    </tbody>
</table>

    
<!DOCTYPE html>
<html>
<head>
    <title>Age Student Report</title>
</head>
<body>
    <h1>Age Student Report</h1>

    <form method="post">
        <label for="age">Enter Age:</label>
        <input type="number" name="age" min="17" id="age" style="appearance: textfield; -moz-appearance: textfield; -webkit-appearance: none;">
        <input type="submit" value="Filter by Age">
    </form>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Department</th>
            <th>Year</th>
            <th>DOB</th>
            <th>Category</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
require_once('config.php'); // Include your database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["age"])) {
    $selectedAge = $_POST["age"];
    $birthYear = date('Y') - $selectedAge;

    // Extract the last four digits (year) from the birthdate
    $yearPart = substr($birthYear, -4);

    $sql = "SELECT id, username, gender, address, department, year, dob, category, contact FROM users WHERE RIGHT(dob, 4) = '$yearPart'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['dob'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['contact'] . "</td>";
            echo "<td><form method='post'>
                <input type='hidden' name='delete_name' value='" . $row['username'] . "'>
                <input type='submit' name='delete_submit' value='Delete' style='background-color: red; color: white;'>
                </form>
            </td>";
            echo "</tr>";
        }
        mysqli_free_result($result);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete_submit"])) {
        $deleteName = mysqli_real_escape_string($conn, $_POST["delete_name"]);
        $deleteSql = "DELETE FROM users WHERE username = '$deleteName'";
        $deleteResult = mysqli_query($conn, $deleteSql);

        if ($deleteResult) {
            echo "Record with name '$deleteName' has been deleted.";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
}
?>

    </tbody>
</table>
</body>
</html>




    <h1>Gender Student Report</h1>

    <form method="post">
        <label for="gender">Select Gender:</label>
        <select name="gender" id="gender">
        <option value="" disabled selected>Gender</option>

            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
        </select>
        <input type="submit" value="Filter by Gender">
    </form>
    <table>
    <thead>
        <tr>
        <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Department</th>
            <th>Year</th>
            <th>DOB</th>
            <th>Category</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once('config.php'); // Include your database configuration

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["gender"])) {
            $selectedGender = $_POST["gender"];
            // Query the database for students in Mumbai with the selected category
            $sql = "SELECT id, username, gender, address, department, year, dob, category, contact FROM users WHERE gender = '$selectedGender'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['contact'] . "</td>";
                    echo "<td><form method='post'>
                        <input type='hidden' name='delete_name' value='" . $row['username'] . "'>
                        <input type='submit' name='delete_submit' value='Delete' style='background-color: red; color: white;'>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["delete_submit"])) {
                $deleteName = mysqli_real_escape_string($conn, $_POST["delete_name"]);
        
                // Query to delete the record based on the provided name
                $deleteSql = "DELETE FROM users WHERE username = '$deleteName'";
                $deleteResult = mysqli_query($conn, $deleteSql);
        
                if ($deleteResult) {
                    echo "Record with name '$deleteName' has been deleted.";
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            }
        }
        
        ?>
    </tbody>
</table>



</body>
</html>
