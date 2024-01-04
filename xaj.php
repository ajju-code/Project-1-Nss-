<?php
require_once('config.php'); // Include your database configuration
require('fpdf/fpdf.php');

// Default or initial data when the page loads
$tableData = [];
$tableData1=[];

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["category"])) {
        $selectedCategory = $_POST["category"];
        // Query the database for students in the selected category
        $query = "SELECT username, gender, address, department, year, dob, category, contact 
        FROM users 
        WHERE category = '$selectedCategory' 
        ORDER BY 
          CASE 
            WHEN year = 'FE' THEN 1 
            WHEN year = 'SE' THEN 2 
            WHEN year = 'TE' THEN 3 
            WHEN year = 'BE' THEN 4 
            ELSE 5 
          END ASC,
          CASE 
            WHEN department = 'Computer' THEN 1 
            WHEN department = 'Mechanical' THEN 2 
            WHEN department = 'Civil' THEN 3 
            ELSE 4 
          END ASC,
          year ASC";
    


      $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Build the table data
            while ($row = mysqli_fetch_assoc($result)) {
                $tableData[] = $row;
            }
            mysqli_free_result($result); // Free the result set
        }
    }

   
}

    if (isset($_POST["year"])) {
        $year = $_POST["year"];
        // Query the database for students in the selected category
        $query = "SELECT username, gender, address, department, year, dob, category, contact 
        FROM users 
        WHERE year = '$year' 
        ORDER BY 
          CASE 
            WHEN year = 'FE' THEN 1 
            WHEN year = 'SE' THEN 2 
            WHEN year = 'TE' THEN 3 
            WHEN year = 'BE' THEN 4 
            ELSE 5 
          END ASC,
          CASE 
            WHEN department = 'Computer' THEN 1 
            WHEN department = 'Mechanical' THEN 2 
            WHEN department = 'Civil' THEN 3 
            ELSE 4 
          END ASC,
          year ASC";
    


      $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Build the table data
            while ($row = mysqli_fetch_assoc($result)) {
                $tableData1[] = $row;
            }
            mysqli_free_result($result); // Free the result set
        }
    }

   
    
        

    if (isset($_POST["delete_submit"])) {
        $deleteName = mysqli_real_escape_string($conn, $_POST["delete_name"]);

        // Query to delete the record based on the provided name
        $deleteSql = "DELETE FROM users WHERE username = '$deleteName'";
        $deleteResult = mysqli_query($conn, $deleteSql);

        if ($deleteResult) {
            echo '<div id="successAlert" class="alert alert-success" role="alert">
                    Record of ' . $deleteName . ' has been deleted successfully.
                  </div>';
                  header("Location:xaj.php".$_SERVER['PHP_SELF']); // Redirect to the same page

        
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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

    </style>
</head>
<body><div id="heading">
    <h1>Students Report </h1></div>
    <form method="post" action='xaj.php'>
        <label for="category">Select Category:</label>
        <select name="category" id="category">
            <option value="" disabled selected>Select Category</option>
            <!-- Options for categories -->
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
        <input type="submit" value="Filter" class="Buttons">
        <a href="gdata.php?category=<?php echo urlencode($selectedCategory); ?>"class="pdf-link">Generate PDF</a>
    </form>

    <!-- Display table -->
    <?php if (!empty($tableData)): ?>
        <table>
            <thead>
                <tr>
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
                <?php foreach ($tableData as $row): ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['dob']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td>
                            <form method='post'>
                                <input type='hidden' name='delete_name' value='<?php echo $row['username']; ?>'>
                                <input type='submit' name='delete_submit' value='Delete' style='background-color: red; color: white;'>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <form action="xaj.php" method="post"> 

        
    <label for="year">Select Year:</label>
        <select name="year" id="year">
            <option value="" disabled selected>Select Year</option>
            <!-- Options for categories -->
            <option value="FE">FE</option>
            <option value="SE">SE</option>
            <option value="TE">TE</option>
            <option value="BE">BE</option>
            </select>
        <input type="submit" value="Filter" class="Buttons">
        <a href="gdata.php?year=<?php echo urlencode($year); ?>"class="pdf-link">Generate PDF</a>


    <?php if (!empty($tableData1)): ?>
        <table>
            <thead>
                <tr>
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
                <?php foreach ($tableData1 as $row): ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['dob']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td>
                            <form method='post'>
                                <input type='hidden' name='delete_name' value='<?php echo $row['username']; ?>'>
                                <input type='submit' name='delete_submit' value='Delete' style='background-color: red; color: white;'>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    



    </form>

    <script>
           document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alert = document.getElementById('successAlert');
                if (alert) {
                    alert.style.display = 'none'; // Hide the alert after 3 seconds
                }
            }, 3000); // 3000 milliseconds = 3 seconds
        });
        </script>
</body>
</html>