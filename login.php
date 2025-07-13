<?php
session_start();
include 'partials_dbconnect.php';

$loginError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists and is approved
    $sql = "SELECT * FROM signup WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            // Login success, set session
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $row['email'];
            header("location: login_success.php");
            exit();
        } else {
            $loginError = "Invalid credentials.";
        }
    } else {
        $loginError = "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Maven</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

  <link rel="stylesheet" href="signup.css" />
</head>
<body>
  <div class="container">
    <div class="form-box">
      <div class="logo"> 
      </div>
      <div class="containerpic">
      <img src="logo.png" alt="image" id="pic">
      </div>
      <h2>Login Now</h2>
      <p>Welcome back !</p>
      <?php if ($loginError): ?>
        <div class="error-msg"><?php echo $loginError; ?></div>
      <?php endif; ?>
      <form action="login.php" method="POST" enctype="multipart/form-data">
        <input type="email" class="form-control" id="email" name="email" placeholder="Personal email*" required>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password*" required>

        <div class="policy-text">
          By logging in to Maven, I acknowledge Mavens
          <a href="#">Privacy Policy</a> and have read and agree to Mavens
          <a href="#">Terms of Use</a> and
          <a href="#">Consent to Services</a>
        </div>
        <button type="submit">Login now</button>
      </form>

      <p class="signin-link">Didn't have an account? <a href="signup.php">Sign up</a></p>
    </div>
  </div>
      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
