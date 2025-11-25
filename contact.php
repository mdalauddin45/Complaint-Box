<?php
session_start();

// Protect page: only logged-in users can access
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

// Get logged-in user's info
$student_id = $_SESSION['student_id'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BGCTUB – Emergency Complaint Service</title>
  <link rel="icon" sizes="32x32" href="images/linklogo.png">
  <link rel="stylesheet" href="style.css">
  <style>
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      background: rgba(255,255,255,0.1);
      backdrop-filter: blur(12px);
      border-radius: 0 0 25px 25px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.3);
      margin-bottom: 40px;
    }

    header img {
      height: 100px;
      width: auto;
    }

    header .nav-left {
      font-weight: 600;
      font-size: 20px;
      color: #00e6ff;
    }

    header .nav-right {
      font-weight: 500;
      font-size: 16px;
      color: #fff;
    }

    header .nav-right a {
      color: #00ffa6;
      text-decoration: none;
      margin-left: 10px;
    }

    header .nav-right a:hover {
      text-decoration: underline;
    }

    input[readonly] {
      background: rgba(255,255,255,0.2);
      cursor: not-allowed;
    }
  </style>
</head>
<body>
  <header>
    <div class="nav-left">
      <img src="images/logo.png" alt="BGCTUB Logo">
      Proctor Office, BGC Trust University Bangladesh
    </div>
    <div class="nav-right">
      Student ID: <?php echo htmlspecialchars($student_id); ?> |
      <a href="mycomplaints.php">My Complaints</a> |
      <a href="logout.php">Logout</a>
    </div>
  </header>

  <section class="main">
    <div class="left">
      <h1>Emergency Complaint Service</h1>

      <form action="dbconnect.php" method="post">
        <label for="name">Name :</label>
        <input type="text" name="name" placeholder="Write your name here" required>

        <label for="phone">Phone Number :</label>
        <input type="text" name="phone" placeholder="Write your phone number here" required>

        <label for="email">Email :</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>

        <label for="message">Write Your Complaint Here:</label>
        <textarea name="message" rows="8" placeholder="Write your Message or Review here..." required></textarea>

        <button type="submit"><strong>Submit Complaint</strong></button>
      </form>
    </div>

    <div class="right">
      <img src="images/combox.png" alt="BGCTUB Image">
    </div>
  </section>

  <footer>
    BGC Biddyanagar, Chandanaish, Chattogram, Bangladesh
  </footer>
</body>
</html>
