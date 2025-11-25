<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "contactform");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Protect page
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$student_email = $_SESSION['email'];

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM MSG WHERE id='$id' AND email='$student_email'");
    header("Location: mycomplaints.php");
    exit;
}

// Fetch student complaints
$result = mysqli_query($conn, "SELECT * FROM MSG WHERE email='$student_email'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Complaints</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #00e6ff;
            color: #000;
        }

        a.button {
            padding: 5px 12px;
            background: #00ffa6;
            color: #000;
            text-decoration: none;
            border-radius: 5px;
            margin: 2px;
        }

        a.button:hover {
            background: #00e6ff;
        }

        a {
            color: #00ffa6;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <header>
        <img src="images/logo.png" alt="BGCTUB Logo" height="80">
        <div style="float:right;">
            Logged in as: <?php echo htmlspecialchars($_SESSION['student_id']); ?> |
            <a href="contact.php">New Complaint</a>
            <a href="logout.php" >Logout</a>

        </div>
    </header>

    <h2 style="text-align:center;">My Complaints</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td>
                        <a class="button" href="update_complaint.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="button" href="mycomplaints.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">You have no complaints yet.</p>
    <?php endif; ?>
</body>

</html>