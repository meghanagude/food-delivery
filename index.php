<?php session_start(); include('includes/db.php'); ?>
<!DOCTYPE html><html><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>QuickEats - Food Delivery</title>
<link rel="stylesheet" href="css/style.css">
</head><body>
<?php include('includes/header.php'); ?>
<main class="container wrap">
  <h1 class="hero">🍽️ Welcome to QuickEats</h1>
  <h2 class="section-title">Available Restaurants</h2>
  <div class="restaurants">
  <?php
  $result = mysqli_query($conn, "SELECT * FROM restaurants");
  while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='card'>
              <h3>".htmlspecialchars($row['name'])."</h3>
              <p class='muted'>".htmlspecialchars($row['description'])."</p>
              <a class='btn' href='restaurant.php?id={$row['id']}'>View Menu</a>
            </div>";
  }
  ?>
  </div>
</main>
<?php include('includes/footer.php'); ?>
</body></html>
