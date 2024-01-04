<?php
// Include the FPDF library
require('fpdf.php');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming category ID is received via a GET parameter
$categoryID = $_GET['categoryID']; // Make sure to validate and sanitize this input

// Fetch users based on the category ID
$sql = "SELECT ID, Name, Gender, Address, Department, Year, Age, Category, Contact FROM users WHERE Category = $categoryID";
$result = $conn->query($sql);

// Initialize PDF
$pdf = new FPDF();
$pdf->AddPage();

// Set font and cell padding
$pdf->SetFont('Arial', 'B', 12);
$cellPadding = 5;

// Create table header
$pdf->Cell(20, $cellPadding, 'ID', 1, 0, 'C');
$pdf->Cell(30, $cellPadding, 'Name', 1, 0, 'C');
$pdf->Cell(20, $cellPadding, 'Gender', 1, 0, 'C');
$pdf->Cell(50, $cellPadding, 'Address', 1, 0, 'C');
$pdf->Cell(30, $cellPadding, 'Department', 1, 0, 'C');
$pdf->Cell(20, $cellPadding, 'Year', 1, 0, 'C');
$pdf->Cell(15, $cellPadding, 'Age', 1, 0, 'C');
$pdf->Cell(30, $cellPadding, 'Category', 1, 0, 'C');
$pdf->Cell(30, $cellPadding, 'Contact', 1, 1, 'C'); // 1, 1 for a new line after this cell

// Populate table with fetched data
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(20, $cellPadding, $row['ID'], 1, 0, 'C');
    $pdf->Cell(30, $cellPadding, $row['Name'], 1, 0, 'C');
    $pdf->Cell(20, $cellPadding, $row['Gender'], 1, 0, 'C');
    $pdf->Cell(50, $cellPadding, $row['Address'], 1, 0, 'C');
    $pdf->Cell(30, $cellPadding, $row['Department'], 1, 0, 'C');
    $pdf->Cell(20, $cellPadding, $row['Year'], 1, 0, 'C');
    $pdf->Cell(15, $cellPadding, $row['Age'], 1, 0, 'C');
    $pdf->Cell(30, $cellPadding, $row['Category'], 1, 0, 'C');
    $pdf->Cell(30, $cellPadding, $row['Contact'], 1, 1, 'C');
}

// Output PDF to the browser
$pdf->Output();
$conn->close();
?>
