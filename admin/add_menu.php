<?php session_start(); include('../includes/db.php');
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ header('Location: ../login.php'); exit; }
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $rest = intval($_POST['restaurant_id']);
    $img = '';
    if(!empty($_FILES['image']['name'])){
        $imgname = time().'_'.basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$imgname);
        $img = $imgname;
    }
    mysqli_query($conn, "INSERT INTO menu_items(restaurant_id, name, price, image) VALUES($rest, '$name', $price, '$img')");
    $msg = "Menu item added.";
}
$restaurants = mysqli_query($conn, "SELECT * FROM restaurants");
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Add Menu</title><link rel="stylesheet" href="../css/style.css"></head><body>
<?php include('../includes/header.php'); ?>
<main class="wrap container">
  <h2>Add Menu Item</h2>
  <?php if(isset($msg)) echo "<p class='notice'>".htmlspecialchars($msg)."</p>"; ?>
  <form method="post" enctype="multipart/form-data" class="form">
    <label>Restaurant:
      <select name="restaurant_id"><?php while($r = mysqli_fetch_assoc($restaurants)) echo "<option value='{$r['id']}'>".htmlspecialchars($r['name'])."</option>"; ?></select>
    </label>
    <label>Name: <input type="text" name="name" required></label>
    <label>Price: <input type="number" step="0.01" name="price" required></label>
    <label>Image: <input type="file" name="image" accept="image/*"></label>
    <button class='btn' type="submit">Add Item</button>
  </form>
</main>
<?php include('../includes/footer.php'); ?></body></html>
