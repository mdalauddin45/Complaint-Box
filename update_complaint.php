<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "contactform");

if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
if (!isset($_SESSION['student_id'])) { header("Location: login.php"); exit; }

$student_email = $_SESSION['email'];
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    mysqli_query($conn, "UPDATE MSG SET message='$message' WHERE id='$id' AND email='$student_email'");
    header("Location: mycomplaints.php");
    exit;
}
$result = mysqli_query($conn, "SELECT * FROM MSG WHERE id='$id' AND email='$student_email'");
$complaint = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Complaint</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2 style="text-align:center;">Edit Complaint</h2>

<form method="post" style="width:50%; margin:auto;">
    <label>Message:</label><br>
    <textarea name="message" rows="8" style="width:100%;"><?php echo htmlspecialchars($complaint['message']); ?></textarea><br><br>
    <button type="submit">Update Complaint</button>
</form>
</body>
</html>
