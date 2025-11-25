<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "contactform");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE student_id='$student_id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['email'] = $user['email'];
            header("Location: contact.php"); 
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login – BGCTUB</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f0f3d, #1a1a60, #3d3da8);
      background-size: 300% 300%;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      color: #fff;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    body { animation: gradientMove 10s infinite; }

    .login-card {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px 50px;
      border-radius: 25px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.3),
                  inset 0 0 50px rgba(255,255,255,0.05);
      backdrop-filter: blur(12px);
      width: 400px;
      text-align: center;
    }

    .login-card h1 {
      font-size: 40px;
      color: #00e6ff;
      margin-bottom: 30px;
      text-shadow: 0 0 15px #00e6ff, 0 0 30px #00e6ff;
    }

    .login-card input {
      width: 100%;
      padding: 12px;
      margin: 15px 0;
      border-radius: 15px;
      border: none;
      font-size: 16px;
      background: rgba(255,255,255,0.1);
      color: #fff;
      box-shadow: inset 0 0 10px rgba(255,255,255,0.1);
      backdrop-filter: blur(6px);
    }

    .login-card input::placeholder {
      color: #ccc;
    }

    .login-card button {
      width: 100%;
      padding: 15px;
      font-size: 20px;
      font-weight: 600;
      border: none;
      border-radius: 15px;
      background: linear-gradient(135deg, #00e6ff, #00ffa6);
      color: #000;
      cursor: pointer;
      margin-top: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      transition: 0.3s ease-in-out;
    }

    .login-card button:hover {
      transform: scale(1.05);
      box-shadow: 0 12px 30px rgba(0,0,0,0.5);
    }

    .error {
      color: #ff4c4c;
      margin-bottom: 15px;
      font-weight: 600;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h1>Login</h1>

    <?php if(isset($error)) { echo "<div class='error'>$error</div>"; } ?>

    <form method="post">
      <input type="text" name="student_id" placeholder="Student ID" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <p style="margin-top:20px;">Don't have an account? <a href="register.php" style="color:#00ffa6;">Register</a></p>
  </div>

</body>
</html>
