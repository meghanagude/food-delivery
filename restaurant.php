<?php session_start(); include('includes/db.php'); 
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$res = mysqli_query($conn, "SELECT * FROM restaurants WHERE id=$id");
$restaurant = mysqli_fetch_assoc($res);
$menu = mysqli_query($conn, "SELECT * FROM menu_items WHERE restaurant_id=$id");
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Menu - <?php echo htmlspecialchars($restaurant['name'] ?? 'Restaurant'); ?></title>
<link rel="stylesheet" href="css/style.css"></head><body>
<?php include('includes/header.php'); ?>
<main class="wrap container">
  <h2>Menu - <?php echo htmlspecialchars($restaurant['name'] ?? 'Restaurant'); ?></h2>
  <div class="menu">
<?php while($row = mysqli_fetch_assoc($menu)) { ?>
    <div class="menu-card">
        <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        <div class="menu-info">
            <h3><?php echo $row['name']; ?></h3>
            <p class="price">₹<?php echo $row['price']; ?></p>
            <form action="cart.php" method="post">
                <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="add">Add to Cart</button>
            </form>
        </div>
    </div>
<?php } ?>
</div>

</main>
<?php include('includes/footer.php'); ?></body></html>
