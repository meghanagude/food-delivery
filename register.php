<?php session_start(); include('includes/db.php');
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = $_POST['password'];
  $hash = password_hash($pass, PASSWORD_DEFAULT);
  $exists = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
  if(mysqli_num_rows($exists)>0){ $err = 'Email already registered'; }
  else {
    mysqli_query($conn, "INSERT INTO users(name,email,password,role) VALUES('$name','$email','$hash','customer')");
    header('Location: login.php'); exit;
  }
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Register</title><link rel="stylesheet" href="css/style.css"></head><body>
<?php include('includes/header.php'); ?>
<main class="wrap container">
  <h2>Create an account</h2>
  <?php if(isset($err)) echo "<p class='notice'>".htmlspecialchars($err)."</p>"; ?>
  <form method="post" class="form">
    <label>Name: <input type="text" name="name" required></label>
    <label>Email: <input type="email" name="email" required></label>
    <label>Password: <input type="password" name="password" required></label>
    <button class='btn' type="submit">Register</button>
  </form>
</main>
<?php include('includes/footer.php'); ?></body></html>
