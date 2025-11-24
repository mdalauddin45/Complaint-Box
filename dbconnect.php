<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ICT CELL</title>
	 <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "contactform");

// Check connection
if ($conn === false) {
    echo "<div class='card'><h1 class='glow'>ERROR: Cannot connect to database.</h1></div>";
    exit;
}

// Collect form data
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];

// Insert query
$sql = "INSERT INTO MSG VALUES ('$name', '$phone', '$email', '$message')";

echo "<div class='card'>";

if (mysqli_query($conn, $sql)) {
    echo "<div class='success-icon'>✔</div>";
    echo "<h1 class='glow'>Complaint Received</h1>";
    echo "<h2>Necessary steps are going to be taken as soon as possible.</h2>";
} else {
    echo "<h1 class='glow'>ERROR: Unable to save your complaint.</h1>";
}

echo "</div>";

$conn->close();
?>

</body>
</html>
