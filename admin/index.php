<?php session_start(); include('../includes/db.php');
// simple admin auth
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ header('Location: ../login.php'); exit; }
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin - QuickEats</title><link rel="stylesheet" href="../css/style.css"></head><body>
<?php include('../includes/header.php'); ?>
<main class="wrap container">
  <h2>Admin Dashboard</h2>
  <ul>
    <li><a class='btn' href='add_menu.php'>Add Menu Item</a></li>
    <li><a class='btn' href='view_orders.php'>View Orders</a></li>
  </ul>
</main>
<?php include('../includes/footer.php'); ?></body></html>
