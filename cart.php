<?php session_start(); include('includes/db.php');
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if(isset($_POST['add'])){
    $id = intval($_POST['item_id']);
    $qty = intval($_POST['qty']) ?: 1;
    if(isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id] += $qty;
    else $_SESSION['cart'][$id] = $qty;
    header('Location: cart.php'); exit;
}
if(isset($_GET['remove'])){ $rid = intval($_GET['remove']); unset($_SESSION['cart'][$rid]); header('Location: cart.php'); exit; }
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Your Cart</title><link rel="stylesheet" href="css/style.css"></head><body>
<?php include('includes/header.php'); ?>
<main class="wrap container">
  <h2>Your Cart</h2>
  <?php if(empty($_SESSION['cart'])){ echo "<p>Your cart is empty.</p>"; } else {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $result = mysqli_query($conn, "SELECT * FROM menu_items WHERE id IN ($ids)");
    $total = 0;
    echo "<table class='cart'><tr><th>Item</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr>";
    while($row = mysqli_fetch_assoc($result)){
      $qty = $_SESSION['cart'][$row['id']];
      $sub = $row['price'] * $qty;
      $total += $sub;
      echo "<tr><td>".htmlspecialchars($row['name'])."</td><td>₹".number_format($row['price'],2)."</td><td>".$qty."</td><td>₹".number_format($sub,2)."</td><td><a class='btn small' href='cart.php?remove={$row['id']}'>Remove</a></td></tr>";
    }
    echo "</table>";
    echo "<h3>Total: ₹".number_format($total,2)."</h3>";
    echo "<a class='btn' href='checkout.php'>Proceed to Checkout</a>";
  } ?>
</main>
<?php include('includes/footer.php'); ?></body></html>
