<?php session_start(); include('includes/db.php');
if(empty($_SESSION['cart'])){ echo "<p>Cart is empty. <a href='index.php'>Go back</a></p>"; exit; }
$ids = implode(',', array_keys($_SESSION['cart']));
$result = mysqli_query($conn, "SELECT * FROM menu_items WHERE id IN ($ids)");
$total = 0; $items = [];
while($row = mysqli_fetch_assoc($result)){
  $qty = $_SESSION['cart'][$row['id']];
  $sub = $row['price'] * $qty; $total += $sub;
  $items[] = ['id'=>$row['id'],'qty'=>$qty,'price'=>$row['price']];
}
$user_id = isset($_SESSION['user']['id']) ? intval($_SESSION['user']['id']) : 1; // demo default
$restaurant_id = null;
$first = mysqli_query($conn, "SELECT restaurant_id FROM menu_items WHERE id=".intval($items[0]['id']));
if($fr = mysqli_fetch_assoc($first)) $restaurant_id = intval($fr['restaurant_id']);
mysqli_query($conn, "INSERT INTO orders(user_id, restaurant_id, total, status) VALUES($user_id, $restaurant_id, $total, 'Placed')");
$order_id = mysqli_insert_id($conn);
foreach($items as $it){
  mysqli_query($conn, "INSERT INTO order_items(order_id, menu_item_id, qty, price) VALUES($order_id, {$it['id']}, {$it['qty']}, {$it['price']})");
}
$_SESSION['cart'] = [];
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Order Placed</title>
<link rel="stylesheet" href="css/style.css"></head><body>
<?php include('includes/header.php'); ?>
<main class="wrap container">
  <h2>Order placed successfully!</h2>
  <p>Your order id is <strong><?php echo $order_id; ?></strong>. Total: ₹<?php echo number_format($total,2); ?></p>
  <a class="btn" href="index.php">Back to Home</a>
</main>
<?php include('includes/footer.php'); ?></body></html>
