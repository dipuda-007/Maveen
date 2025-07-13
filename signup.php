<?php
$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials_dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql="INSERT INTO `signup` (`email`, `password`, `timestamp`) VALUES ('$email', '$hashedPassword', current_timestamp())";

$result = mysqli_query($conn, $sql);
    if ($result) {
        $showAlert = true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up | Maven</title>
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
      <h2>Sign Up</h2>
      <p>Welcome! Lets set up your account.</p>
      <?php
        if ($showAlert) {
            echo "<div class='alert alert-success' role='alert'>
            Registration successful!
          </div>";
            }
        ?>
      <form action="signup.php" method="POST" enctype="multipart/form-data">
        <input type="email" class="form-control" id="email" name="email" placeholder="Personal email*" required>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password*" required>

        <div class="policy-text">
          By registering with Maven, I acknowledge Mavens
          <a href="#">Privacy Policy</a> and have read and agree to Mavens 
          <a href="#">Terms of Use</a> and 
          <a href="#">Consent to Services</a>
        </div>
        <button type="submit">Register now</button>
      </form>

      <p class="signin-link">Already have an account? <a href="login.php">Sign in</a></p>
    </div>
  </div>
      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
