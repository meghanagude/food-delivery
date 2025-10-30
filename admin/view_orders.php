<?php session_start(); include('../includes/db.php');
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ header('Location: ../login.php'); exit; }
$message = '';
if(isset($_POST['update_status'])){
  $oid = intval($_POST['order_id']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);
  if(mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id=$oid")) {
    $message = "Order #$oid status updated successfully to $status";
  } else {
    $message = "Error updating order status: " . mysqli_error($conn);
  }
}
$res = mysqli_query($conn, "SELECT o.*, u.name as customer, r.name as restaurant FROM orders o LEFT JOIN users u ON o.user_id=u.id LEFT JOIN restaurants r ON o.restaurant_id=r.id ORDER BY o.order_date DESC");
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Orders - Admin</title><link rel="stylesheet" href="../css/style.css"></head><body>
<?php include('../includes/header.php'); ?>
<main class="wrap container">
  <h2>Orders</h2>
  <?php if($message): ?>
    <div class="message"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>
  <table class='orders'><tr><th>ID</th><th>Customer</th><th>Restaurant</th><th>Total</th><th>Status</th><th>Date</th><th>Action</th></tr>
  <?php while($row = mysqli_fetch_assoc($res)){ ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo htmlspecialchars($row['customer']); ?></td>
      <td><?php echo htmlspecialchars($row['restaurant']); ?></td>
      <td>₹<?php echo number_format($row['total'],2); ?></td>
      <td><?php echo htmlspecialchars($row['status']); ?></td>
      <td><?php echo htmlspecialchars($row['order_date']); ?></td>
      <td>
        <form method="post" style="display:inline">
          <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
          <select name="status">
            <?php 
              $opts = ['Placed','Preparing','Out for Delivery','Delivered','Cancelled']; 
              foreach($opts as $o) {
                $selected = ($o == $row['status']) ? 'selected' : '';
                echo "<option value='".htmlspecialchars($o)."' $selected>".htmlspecialchars($o)."</option>";
              }
            ?>
          </select>
          <button class="btn small" name="update_status">Update</button>
        </form>
      </td>
    </tr>
  <?php } ?>
  </table>
</main>
<?php include('../includes/footer.php'); ?></body></html>
