<?php session_start(); include('includes/db.php');
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = $_POST['password'];
  $r = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if($user = mysqli_fetch_assoc($r)){
    if(password_verify($pass, $user['password'])){
      unset($user['password']);
      $_SESSION['user'] = $user;
      header('Location: index.php'); exit;
    } else $err = 'Invalid credentials';
  } else $err = 'Invalid credentials';
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login</title><link rel="stylesheet" href="css/style.css"></head><body>
<?php include('includes/header.php'); ?>
<main class="wrap container">
  <h2>Login</h2>
  <?php if(isset($err)) echo "<p class='notice'>".htmlspecialchars($err)."</p>"; ?>
  <form method="post" class="form">
    <label>Email: <input type="email" name="email" required></label>
    <label>Password: <input type="password" name="password" required></label>
    <button class='btn' type="submit">Login</button>
  </form>
</main>
<?php include('includes/footer.php'); ?></body></html>
